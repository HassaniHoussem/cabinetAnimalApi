<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'statut' => 'required|in:en_attente,confirmé,annulé',
        ];
    }
}

