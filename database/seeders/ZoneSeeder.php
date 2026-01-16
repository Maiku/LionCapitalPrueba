<?php

namespace Database\Seeders;

use App\Models\Catalogs\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    public function run(): void
    {
        $zones = [
            ['name' => 'Zona A', 'type' => 1],
            ['name' => 'Zona B', 'type' => 1],
            ['name' => 'Zona C', 'type' => 2],
            ['name' => 'Zona D', 'type' => 3],
            ['name' => 'Zona E', 'type' => 4],
            ['name' => 'Zona F', 'type' => 5],
        ];

        foreach ($zones as $zone) {
            Zone::firstOrCreate(
                ['name' => $zone['name']],
                ['type' => $zone['type']]
            );
        }
    }
}
