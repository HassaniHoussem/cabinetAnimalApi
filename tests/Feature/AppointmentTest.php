<?php

namespace Tests\Feature;

use App\Models\Animal;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

     protected Client $client;
    protected Animal $animal;
    protected Service $service;

    protected function setUp(): void
    {
        parent::setUp();

        // Créer un client de test
        $this->client = Client::create([
            'nom' => 'Jean Dupont',
            'email' => 'test@example.com',
            'telephone' => '0123456789'
        ]);

        // Créer un animal de test
        $this->animal = Animal::create([
            'nom' => 'Rex',
            'espece' => 'Chien',
            'date_naissance' => '2020-01-01',
            'client_id' => $this->client->id
        ]);

        // Créer un service de test
        $this->service = Service::create([
            'type' => 'consultation'
        ]);
    }

    public function test_create_appointment()
    {
        $response = $this->postJson('/api/appointments', [
            'client_email' => 'test@example.com',
            'client_nom' => 'Jean Dupont',
            'client_telephone' => '0123456789',
            'animal_nom' => 'Rex',
            'animal_espece' => 'Chien',
            'animal_date_naissance' => '2020-01-01',
            'service_id' => $this->service->id,
            'date_heure' => now()->addDay()->format('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'statut' => 'en_attente'
                ]
            ]);

        $this->assertDatabaseHas('clients', ['email' => 'test@example.com']);
        $this->assertDatabaseHas('animals', ['nom' => 'Rex']);
        $this->assertDatabaseHas('appointments', ['statut' => 'en_attente']);
    }

    public function test_prevent_double_booking()
    {
        $date = now()->addDay()->format('Y-m-d H:i:s');

        // Premier rendez-vous
        $this->postJson('/api/appointments', [
            'client_email' => 'test@example.com',
            'client_nom' => 'Jean Dupont',
            'client_telephone' => '0123456789',
            'animal_nom' => 'Rex',
            'animal_espece' => 'Chien',
            'animal_date_naissance' => '2020-01-01',
            'service_id' => $this->service->id,
            'date_heure' => $date,
        ]);

        // Tentative de double réservation
        $response = $this->postJson('/api/appointments', [
            'client_email' => 'test@example.com',
            'client_nom' => 'Jean Dupont',
            'client_telephone' => '0123456789',
            'animal_nom' => 'Rex',
            'animal_espece' => 'Chien',
            'animal_date_naissance' => '2020-01-01',
            'service_id' => $this->service->id,
            'date_heure' => $date,
        ]);

        $response->assertStatus(400);
    }
}
