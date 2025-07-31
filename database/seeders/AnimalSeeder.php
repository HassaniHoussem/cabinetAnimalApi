<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    public function run()
    {
        $animals = [
            [
                'nom' => 'Rex',
                'espece' => 'Chien',
                'date_naissance' => '2018-05-15',
                'client_id' => 1
            ],
            [
                'nom' => 'Mistigri',
                'espece' => 'Chat',
                'date_naissance' => '2019-02-20',
                'client_id' => 1
            ],
            [
                'nom' => 'Bella',
                'espece' => 'Chien',
                'date_naissance' => '2020-07-10',
                'client_id' => 2
            ],
            [
                'nom' => 'Felix',
                'espece' => 'Chat',
                'date_naissance' => '2017-11-30',
                'client_id' => 3
            ]
        ];

        foreach ($animals as $animal) {
            Animal::create($animal);
        }
    }
}
