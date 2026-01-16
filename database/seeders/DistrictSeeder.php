<?php

namespace Database\Seeders;

use App\Models\Catalogs\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districts = [
            'Ciutat Vella',
            'Eixample',
            'Sants-Montjuïc',
            'Les Corts',
            'Sarrià-Sant Gervasi',
            'Gràcia',
            'Horta-Guinardó',
            'Nou Barris',
            'Sant Andreu',
            'Sant Martí',
        ];

        foreach ($districts as $name) {
            District::firstOrCreate(['name' => $name]);
        }
    }
}
