<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use App\Models\Client;
use App\Models\Service;

Route::post("register", [ApiController::class, "Register"]);
Route::post("login", [ApiController::class, "Login"]);

Route::group(["middleware" => ["auth:sanctum"]], function () {
    Route::get("profile", [ApiController::class, "Profile"]);
    Route::get("logout", [ApiController::class, "Logout"]);


});

Route::apiResource('appointments', AppointmentController::class);

    Route::get('/clients/{client}/animals', function(Client $client) {
        return $client->animals;
    });

    Route::get('/clients', function() {
        return Client::all();
    });

    Route::get('/services', function() {
        return Service::all();
    });

Route::get('/docs', function() {
    return response()->json([
        'message' => 'Consultez la documentation Postman pour les endpoints disponibles',
        'endpoints' => [
            'POST /register' => 'Enregistrement utilisateur',
            'POST /login' => 'Connexion',
            'GET /profile' => 'Profil utilisateur (protégé)',
            'GET /logout' => 'Déconnexion (protégé)',
            'POST /appointments' => 'Créer rendez-vous (protégé)',
            'GET /appointments' => 'Lister rendez-vous (protégé)',
            'GET /appointments/{id}' => 'Afficher rendez-vous (protégé)',
            'PUT /appointments/{id}' => 'Mettre à jour rendez-vous (protégé)',
            'DELETE /appointments/{id}' => 'Supprimer rendez-vous (protégé)',
            'GET /clients/{id}/animals' => 'Lister animaux d\'un client (protégé)'
        ]
    ]);
});
