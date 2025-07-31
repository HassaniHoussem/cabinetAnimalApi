<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            ['type' => 'consultation'],
            ['type' => 'vaccination'],
            ['type' => 'toilettage'],
            ['type' => 'chirurgie'],
            ['type' => 'radiologie']
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
