<?php

namespace Database\Factories;

use DragonCode\Support\Facades\Helpers\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Niveau>
 */
class NiveauFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $index = 0;
        $niveaux = ['Licence 1', 'Licence 2', 'Licence 3', 'Master 1', 'Master 2'];

        // Assurez-vous que l'index reste dans les limites du tableau
        $index = ($index >= count($niveaux)) ? 0 : $index;

        // Récupérez la valeur selon l'index actuel
        $niveau = $niveaux[$index++];

        return [
            'nom_niveau' => $niveau,
        ];
    }
}
