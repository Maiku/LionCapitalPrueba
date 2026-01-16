<?php

namespace Database\Seeders;

use App\Models\Main\Operations;
use App\Models\Main\Property;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OperationsSeeder extends Seeder
{
    public function run(): void
    {
        $properties = Property::all();

        if ($properties->isEmpty()) {
            $this->command?->warn('No hay propiedades para seedear operaciones.');
            return;
        }

        foreach ($properties as $property) {
            // Si la propiedad está en venta, creamos su operación de venta
            if ($property->{\App\Models\Main\Property::IS_SELL}) {
                $start = Carbon::now()->subMonths(rand(1, 12))->startOfDay();
                $end = rand(0, 1) ? (clone $start)->addDays(rand(15, 180)) : null;

                Operations::updateOrCreate(
                    [
                        Operations::PROPERTY_ID => $property->id,
                        Operations::TYPE => 'sale',
                    ],
                    [
                        Operations::STATUS => $end ? 'closed' : 'open',
                        Operations::OPERATION_DATE_START => $start,
                        Operations::OPERATION_DATE_END => $end,
                    ]
                );
            }

            // Si la propiedad está en alquiler, creamos su operación de alquiler
            if ($property->{\App\Models\Main\Property::IS_RENT}) {
                $start = Carbon::now()->subMonths(rand(1, 12))->startOfDay();
                $end = rand(0, 1) ? (clone $start)->addDays(rand(15, 180)) : null;

                Operations::updateOrCreate(
                    [
                        Operations::PROPERTY_ID => $property->id,
                        Operations::TYPE => 'rent',
                    ],
                    [
                        Operations::STATUS => $end ? 'closed' : 'open',
                        Operations::OPERATION_DATE_START => $start,
                        Operations::OPERATION_DATE_END => $end,
                    ]
                );
            }
        }
    }
}
