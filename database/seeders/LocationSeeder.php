<?php

namespace Database\Seeders;

use App\Models\Catalogs\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            'Barcelona',
            'Girona',
            'Tarragona',
            'Lleida',
        ];

        foreach ($locations as $name) {
            Location::firstOrCreate(['name' => $name]);
        }
    }
}
