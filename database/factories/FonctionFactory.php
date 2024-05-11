<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fonction>
 */
class FonctionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $count = 0; // Variable statique pour compter le nombre d'enregistrements créés

        $count++; // Incrémentez le compteur

        return [
            'nom_fonction' => $this->faker->sentence(2, true),
            'role' => $count === 1 ? 'Administrateur' : 'Utilisateur', // Si c'est le premier enregistrement, définissez le rôle sur "Administrateur", sinon sur "Utilisateur"
        ];
    }
}
