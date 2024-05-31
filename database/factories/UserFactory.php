<?php

namespace Database\Factories;

use App\Models\Fonction;
use App\Models\FonctionService;
use App\Models\Service;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Obtenez la liste des fichiers dans le répertoire 'public/dist/img'
        $files = File::files(public_path('dist/img'));

        // Choisissez un fichier au hasard parmi les fichiers trouvés
        $randomFile = $files[array_rand($files)];

        // Obtenez le chemin d'accès relatif du fichier
        $filePath = 'file/' . $randomFile->getFilename();

        // Obtenez un ID de service existant
        $fonctionId = Fonction::inRandomOrder()->first()->id;
        return [
            'nom_user' => fake()->lastName,
            'prenom_user' => fake()->firstName,
            'valider_user' => true,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
            'image_users' => $filePath,
            'fonction_id' => 6
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
