<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Jobs\SendAppointmentNotification;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Animal;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::query()->with(['animal', 'service']);
        //filtre by date

        if ($request->has('date')) {
            $query->whereDate('date_heure', $request->date);
        }

        if ($request->has('client_id')) {
            $query->whereHas('animal', function($q) use ($request) {
                $q->where('client_id', $request->client_id);
            });
        }

        if ($request->has('service_id')) {
            $query->where('service_id', $request->service_id);
        }

        return AppointmentResource::collection($query->paginate(10));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $client = Client::firstOrCreate(
            ['email' => $request->client_email],
            ['nom' => $request->client_nom, 'telephone' => $request->client_telephone]
        );

        $animal = Animal::firstOrCreate(
            ['nom' => $request->animal_nom, 'client_id' => $client->id],
            ['espece' => $request->animal_espece, 'date_naissance' => $request->animal_date_naissance]
        );

        $existingAppointment = Appointment::where('animal_id', $animal->id)
            ->where('date_heure', $request->date_heure)
            ->exists();

        if ($existingAppointment) {
            return response()->json(['message' => 'Cet animal a déjà un rendez-vous à cette heure'], 400);
        }

        $appointment = Appointment::create([
            'animal_id' => $animal->id,
            'service_id' => $request->service_id,
            'date_heure' => $request->date_heure,
            'statut' => 'en_attente',
            'commentaire' => $request->commentaire,
        ]);

        SendAppointmentNotification::dispatch($appointment);

        return new AppointmentResource($appointment);
    }
    public function show(Appointment $appointment)
    {
        return new AppointmentResource($appointment->load(['animal', 'service']));
    }
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update(['statut' => $request->statut]);
        return new AppointmentResource($appointment);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return response()->json(null, 204);
    }
}
