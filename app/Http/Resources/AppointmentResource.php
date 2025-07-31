<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date_heure' => $this->date_heure,
            'statut' => $this->statut,
            'commentaire' => $this->commentaire,
            'animal' => [
                'id' => $this->animal->id,
                'nom' => $this->animal->nom,
                'espece' => $this->animal->espece,
            ],
            'service' => [
                'id' => $this->service->id,
                'type' => $this->service->type,
            ],
            'client' => [
                'id' => $this->animal->client->id,
                'nom' => $this->animal->client->nom,
                'email' => $this->animal->client->email,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
