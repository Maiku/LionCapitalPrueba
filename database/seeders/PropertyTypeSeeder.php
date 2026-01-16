<?php

namespace Database\Seeders;

use App\Models\Catalogs\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Piso',
            'Casa',
            'Ático',
            'Dúplex',
            'Local comercial',
            'Oficina',
            'Parcela',
        ];

        foreach ($types as $name) {
            PropertyType::firstOrCreate(['name' => $name]);
        }
    }
}
