<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etat>
 */
class EtatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $index = 0;
        $etats = ['En attente', 'Entretien', 'En cours', 'Fin', 'Terminé'];

        // Assurez-vous que l'index reste dans les limites du tableau
        $index = ($index >= count($etats)) ? 0 : $index;

        // Récupérez la valeur selon l'index actuel
        $etat = $etats[$index++];

        return [
            'nom_etat' => $etat,
        ];
    }
}
