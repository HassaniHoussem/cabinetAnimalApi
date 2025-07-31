<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
        use HasFactory;

    protected $fillable = ['animal_id', 'service_id', 'date_heure', 'statut', 'commentaire'];

    protected $casts = [
        'date_heure' => 'datetime',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}


