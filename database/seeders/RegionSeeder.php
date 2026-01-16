<?php

namespace Database\Seeders;

use App\Models\Catalogs\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            'Comarca 1',
            'Comarca 2',
            'Comarca 3',
        ];

        foreach ($regions as $name) {
            Region::firstOrCreate(['name' => $name]);
        }
    }
}
