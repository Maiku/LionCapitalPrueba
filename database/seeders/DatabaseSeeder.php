<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            RegionSeeder::class,
            LocationSeeder::class,
            MunicipalitySeeder::class,
            DistrictSeeder::class,
            NeighborhoodSeeder::class,
            OfficeSeeder::class,
            UserSeeder::class,
            PropertyTypeSeeder::class,
            ZoneSeeder::class,
            ZoneTypeSeeder::class,
            PropertySeeder::class,
            OperationsSeeder::class,
        ]);
    }
}
