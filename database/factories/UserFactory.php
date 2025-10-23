<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition(): array
    {
        return [
            'nombreUsuario' => $this->faker->unique()->userName(),
            'clave' => Hash::make('123456'), // contraseña
            'role_id' => 1, // temporal: asegurarse de que exista el rol
            'nombre' => $this->faker->firstName(),
            'paterno' => $this->faker->lastName(),
            'materno' => $this->faker->lastName(),
            'ci' => $this->faker->unique()->numerify('########'),
        ];
    }
}
