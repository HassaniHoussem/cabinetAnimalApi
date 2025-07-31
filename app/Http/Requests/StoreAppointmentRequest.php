<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'client_email' => 'required|email',
            'client_nom' => 'required|string',
            'client_telephone' => 'required|string',
            'animal_nom' => 'required|string',
            'animal_espece' => 'required|string',
            'animal_date_naissance' => 'required|date',
            'service_id' => 'required|exists:services,id',
            'date_heure' => 'required|date|after:now',
            'commentaire' => 'nullable|string',
        ];
    }
}


