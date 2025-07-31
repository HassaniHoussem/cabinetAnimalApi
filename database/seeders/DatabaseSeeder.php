<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ServiceSeeder::class,
            ClientSeeder::class,
            AnimalSeeder::class,
            AppointmentSeeder::class,
        ]);
    }
}
