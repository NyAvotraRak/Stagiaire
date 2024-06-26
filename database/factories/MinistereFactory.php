<?php

namespace Database\Factories;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ministere>
 */
class MinistereFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Configure Faker to use the French locale
        $this->faker->locale('fr_FR');

        // Obtenez la liste des fichiers dans le répertoire 'public/dist/img'
        $files = File::files(public_path('dist/img'));

        // Choisissez un fichier au hasard parmi les fichiers trouvés
        $randomFile = $files[array_rand($files)];

        // Obtenez le chemin d'accès relatif du fichier
        $filePath = 'file/' . $randomFile->getFilename();

        return [
            'titre' => $this->faker->sentence(2, true),
            'description_ministere' => $this->faker->sentences(2, true),
            'image_ministere' => $filePath,
        ];
    }
}
