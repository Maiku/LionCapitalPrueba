<?php

namespace Database\Seeders;

use App\Models\Catalogs\ZoneType;
use Illuminate\Database\Seeder;

class ZoneTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['neighborhood', 'district', 'municipality',
            'region', 'location'];

        foreach ($types as $name) {
            ZoneType::firstOrCreate(['name' => $name]);
        }
    }
}
