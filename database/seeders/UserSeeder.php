<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Catalogs\Office;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $office = Office::first();

        if (! $office) {
            $this->command?->warn('No hay oficinas para asignar a los usuarios de prueba. Ejecuta OfficeSeeder primero.');
        }

        // Usuarios de "dirección" (ven todas las oficinas)
        $usersData = [
            [
                'name' => 'God User',
                'email' => 'god@example.com',
                'role' => User::ROLE_GOD,
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role' => User::ROLE_ADMIN,
            ],
            [
                'name' => 'Commercial Director User',
                'email' => 'cd@example.com',
                'role' => User::ROLE_COMMERCIAL_DIRECTOR,
            ],
        ];

        foreach ($usersData as $data) {
            User::factory()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => '123456',
                'role' => $data['role'],
                'office_id' => $office?->id,
            ]);
        }

        // Crear un agente por cada oficina para probar el filtrado por office
        foreach (Office::all() as $idx => $agentOffice) {
            User::factory()->create([
                'name' => 'Agent ' . $agentOffice->name,
                'email' => 'agent' . ($idx + 1) . '@example.com',
                'password' => '123456',
                'role' => User::ROLE_AGENT,
                'office_id' => $agentOffice->id,
            ]);
        }
    }
}
