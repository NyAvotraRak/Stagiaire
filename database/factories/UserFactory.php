<?php

namespace Database\Factories;

use App\Models\Fonction;
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
        // Obtenez un ID de service existant
        $serviceId = Service::inRandomOrder()->first()->id;

        // Obtenez un ID de fonction existant
        $fonctionId = 1;
        // Obtenez la liste des fichiers dans le répertoire 'public/dist/img'
        $files = File::files(public_path('dist/img'));

        // Choisissez un fichier au hasard parmi les fichiers trouvés
        $randomFile = $files[array_rand($files)];

        // Obtenez le chemin d'accès relatif du fichier
        $filePath = 'file/' . $randomFile->getFilename();
        return [
            'nom_user' => fake()->name(),
            'prenom_user' => fake()->name(),
            'valider_user' => true,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
            'image_users' => $filePath,
            'service_id' => $serviceId,
            'fonction_id' => $fonctionId
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
