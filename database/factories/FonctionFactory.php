<?php

namespace Database\Factories;

use App\Models\Service;
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
        // Obtenez un ID de service existant
        $serviceId = Service::inRandomOrder()->first()->id;
        static $count = 0; // Variable statique pour compter le nombre d'enregistrements créés

        $count++; // Incrémentez le compteur

        return [
            'nom_fonction' => $this->faker->jobTitle,
            'service_id' => $serviceId,
            'role' => $count === 1 ? 'Administrateur' : 'Utilisateur', // Si c'est le premier enregistrement, définissez le rôle sur "Administrateur", sinon sur "Utilisateur"
        ];
    }
}
