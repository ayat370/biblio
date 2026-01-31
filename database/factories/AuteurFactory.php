<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Auteur;

class AuteurFactory extends Factory
{
    protected $model = Auteur::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'date_naissance' => $this->faker->date(),
            'nationalite' => $this->faker->country(),
        ];
    }
}
