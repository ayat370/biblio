<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Emprunt;
use App\Models\Livre;
use App\Models\Emprunteur;

class EmpruntFactory extends Factory
{
    protected $model = Emprunt::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement(['en_cours', 'rendu', 'en_retard']);
        
        $dateEmprunt = $this->faker->dateTimeBetween('-6 months', '-2 days');
        $dateRetour = null;

        if ($status === 'rendu') {
            // Returned: Set a return date after the loan date
            $dateRetour = $this->faker->dateTimeBetween($dateEmprunt, 'now');
        } elseif ($status === 'en_retard') {
            // Overdue: Loan date must be old (> 1 month ago), and NOT returned yet
            $dateEmprunt = $this->faker->dateTimeBetween('-6 months', '-35 days'); 
            $dateRetour = null; 
        } else {
            // En cours: Recent loan (< 1 month ago), not returned yet
            $dateEmprunt = $this->faker->dateTimeBetween('-20 days', 'now');
            $dateRetour = null;
        }

        return [
            'livre_id' => Livre::inRandomOrder()->first()->id,
            'emprunteur_id' => Emprunteur::inRandomOrder()->first()->id,
            'date_emprunt' => $dateEmprunt,
            'date_retour' => $dateRetour,
            'etat' => $status,
        ];
    }
}
