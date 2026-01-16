<?php

namespace Database\Seeders;

use App\Models\Catalogs\OperationStatus;
use Illuminate\Database\Seeder;

class OperationStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            'Abierta',
            'En negociación',
            'Reservada',
            'Cerrada',
            'Cancelada',
        ];

        foreach ($statuses as $name) {
            OperationStatus::firstOrCreate(['name' => $name]);
        }
    }
}
