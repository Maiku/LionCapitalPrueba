<?php

namespace Database\Seeders;

use App\Models\Catalogs\Municipality;
use Illuminate\Database\Seeder;

class MunicipalitySeeder extends Seeder
{
    public function run(): void
    {
        $municipalities = [
            'Barcelona',
            'Hospitalet de Llobregat',
            'Badalona',
            'Sabadell',
        ];

        foreach ($municipalities as $name) {
            Municipality::firstOrCreate(['name' => $name]);
        }
    }
}
