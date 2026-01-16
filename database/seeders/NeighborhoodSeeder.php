<?php

namespace Database\Seeders;

use App\Models\Catalogs\Neighborhood;
use Illuminate\Database\Seeder;

class NeighborhoodSeeder extends Seeder
{
    public function run(): void
    {
        $neighborhoods = [
            'El Raval',
            'Gòtic',
            'Barceloneta',
            'Sant Pere, Santa Caterina i la Ribera',
        ];

        foreach ($neighborhoods as $name) {
            Neighborhood::firstOrCreate(['name' => $name]);
        }
    }
}
