<?php

namespace Database\Factories;

use App\Models\Fonction;
use App\Models\FonctionService;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FonctionService>
 */
class FonctionServiceFactory extends Factory
{
    protected $model = FonctionService::class;

    public function definition()
    {
        return [
            'fonction_id' => Fonction::factory(),
            'service_id' => Service::factory(),
        ];
    }
}
