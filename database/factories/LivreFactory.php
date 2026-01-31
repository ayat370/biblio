<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Livre;
use App\Models\Auteur;

class LivreAuteurFactory extends Factory
{
    public function definition(): array
    {
        return [
            'livre_id' => Livre::inRandomOrder()->first()->id,
            'auteur_id' => Auteur::inRandomOrder()->first()->id,
        ];
    }
}
