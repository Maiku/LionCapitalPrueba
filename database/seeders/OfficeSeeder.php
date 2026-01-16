<?php

namespace Database\Seeders;

use App\Models\Catalogs\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    public function run(): void
    {
        $offices = [
            'Oficina Centro',
            'Oficina Norte',
            'Oficina Sur',
        ];

        foreach ($offices as $name) {
            Office::firstOrCreate(['name' => $name]);
        }
    }
}
