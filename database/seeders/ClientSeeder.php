<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $clients = [
            [
                'nom' => 'Martin Dupont',
                'email' => 'martin.dupont@example.com',
                'telephone' => '0612345678'
            ],
            [
                'nom' => 'Sophie Lambert',
                'email' => 'sophie.lambert@example.com',
                'telephone' => '0698765432'
            ],
            [
                'nom' => 'Jean Durand',
                'email' => 'jean.durand@example.com',
                'telephone' => '0687654321'
            ]
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
