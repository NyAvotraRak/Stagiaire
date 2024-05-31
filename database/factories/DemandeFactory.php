<?php

namespace Database\Factories;

use App\Models\Etat;
use App\Models\Niveau;
use App\Models\Service;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Demande>
 */
class DemandeFactory extends Factory
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

        // Obtenez un ID de fonction existant
        $niveauId = Niveau::inRandomOrder()->first()->id;
        // Définir etat_id à 1
        $etatId = 1;
        // Obtenez la liste des fichiers dans le répertoire 'public/dist/img'
        $files = File::files(public_path('dist/img'));
        // Obtenez la liste des fichiers dans le répertoire 'public/dist/img'
        $filespdf = File::files(public_path('dist/files'));

        // Choisissez un fichier au hasard parmi les fichiers trouvés
        $randomFile = $files[array_rand($files)];
        // Choisissez un fichier au hasard parmi les fichiers trouvés
        $randomFilepdf = $filespdf[array_rand($filespdf)];

        // Obtenez le chemin d'accès relatif du fichier
        $filePath = 'file/' . $randomFile->getFilename();
        // Obtenez le chemin d'accès relatif du fichier
        $filePathpdf = 'file/' . $randomFilepdf->getFilename();
        return [
            'nom_demande' => $this->faker->lastName,
            'prenom_demande' => $this->faker->firstName,
            'email_demande' => fake()->unique()->safeEmail(),
            'image_demande' => $filePath,
            'cv' => $filePathpdf,
            'lm' => $filePathpdf,
            'autres' => $filePathpdf,
            'service_id' => $serviceId,
            'etat_id' => $etatId,
            'niveau_id' => $niveauId
        ];
    }
}
