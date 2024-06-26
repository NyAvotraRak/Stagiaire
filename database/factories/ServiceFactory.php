<?php

namespace Database\Factories;

use Illuminate\Support\Facades\File;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
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
            'nom_service' => $this->faker->company,
            'description_service' => $this->faker->text(100),
            'image_service' => $filePath,
        ];
    }
}
