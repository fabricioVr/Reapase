<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Insertar roles sin duplicados
        DB::table('roles')->insertOrIgnore([
            ['id' => 1, 'nombre' => 'Docente'],
            ['id' => 2, 'nombre' => 'Encargado'],
            ['id' => 3, 'nombre' => 'Pasante'],
        ]);

        // 2️⃣ Crear usuario admin (Encargado)
        User::factory()->create([
            'nombreUsuario' => 'admin',
            'clave' => bcrypt('admin'),
            'role_id' => 2, // Encargado
            'nombre' => 'Administrador',
            'paterno' => 'Principal',
            'materno' => 'Del Sistema',
            'ci' => '9999999',
        ]);

        // 3️⃣ Crear 10 usuarios de prueba con roles aleatorios
        User::factory(10)->create()->each(function ($user) {
            $user->role_id = rand(1,3); // Docente, Encargado o Pasante
            $user->save();
        });
    }
}
