<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        $appointments = [
            [
                'animal_id' => 1,
                'service_id' => 1,
                'date_heure' => Carbon::now()->addDays(1)->format('Y-m-d H:i:s'),
                'statut' => 'en_attente',
                'commentaire' => 'Première consultation'
            ],
            [
                'animal_id' => 2,
                'service_id' => 2,
                'date_heure' => Carbon::now()->addDays(2)->format('Y-m-d H:i:s'),
                'statut' => 'confirmé',
                'commentaire' => 'Vaccination annuelle'
            ],
            [
                'animal_id' => 3,
                'service_id' => 3,
                'date_heure' => Carbon::now()->addDays(3)->format('Y-m-d H:i:s'),
                'statut' => 'annulé',
                'commentaire' => 'Toilettage complet'
            ],
            [
                'animal_id' => 4,
                'service_id' => 1,
                'date_heure' => Carbon::now()->addDays(4)->format('Y-m-d H:i:s'),
                'statut' => 'en_attente',
                'commentaire' => 'Consultation de contrôle'
            ]
        ];

        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }
    }
}
