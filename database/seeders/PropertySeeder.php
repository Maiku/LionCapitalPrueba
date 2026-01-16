<?php

namespace Database\Seeders;

use App\Models\Main\Property;
use App\Models\Catalogs\Office;
use App\Models\Catalogs\PropertyType;
use App\Models\Catalogs\Neighborhood;
use App\Models\Catalogs\District;
use App\Models\Catalogs\Municipality;
use App\Models\Catalogs\Region;
use App\Models\Catalogs\Location;
use App\Models\Catalogs\Zone;
use App\Models\User;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $count = 100;

        // Colecciones de catálogos ya seedados
        $offices = Office::all();
        $propertyTypes = PropertyType::all();
        $neighborhoods = Neighborhood::all();
        $districts = District::all();
        $municipalities = Municipality::all();
        $regions = Region::all();
        $locations = Location::all();
        $zones = Zone::all();
        $users = User::all();

        // Si no hay datos base, no seguimos para evitar errores de FK
        if (
            $offices->isEmpty() ||
            $propertyTypes->isEmpty() ||
            $neighborhoods->isEmpty() ||
            $districts->isEmpty() ||
            $municipalities->isEmpty() ||
            $regions->isEmpty() ||
            $locations->isEmpty() ||
            $zones->isEmpty() ||
            $users->isEmpty()
        ) {
            $this->command?->warn('No hay suficientes datos en catálogos/usuarios para seedear propiedades.');
            return;
        }

        Property::factory()
            ->count($count)
            ->make()
            ->each(function (Property $property) use (
                $offices,
                $propertyTypes,
                $neighborhoods,
                $districts,
                $municipalities,
                $regions,
                $locations,
                $users,
                $zones
            ) {
                $property->{Property::OFFICE_ID} = $offices->random()->id;
                $property->{Property::PROPERTY_TYPE_ID} = $propertyTypes->random()->id;
                $user = $users->random();
                $property->{Property::USER_ID} = $user->id;
                $property->{Property::SECONDARY_USER_ID} = $users->random()->id;
                $property->{Property::NEIGHBORHOOD_ID} = $neighborhoods->random()->id;
                $property->{Property::DISTRICT_ID} = $districts->random()->id;
                $property->{Property::MUNICIPALITY_ID} = $municipalities->random()->id;
                $property->{Property::REGION_ID} = $regions->random()->id;
                $property->{Property::LOCATION_ID} = $locations->random()->id;
                $property->{Property::ZONE_ID} = $zones->random()->id;

                $property->save();
            });
    }
}
