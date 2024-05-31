<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Demande;
use App\Models\Etat;
use App\Models\Fonction;
use App\Models\FonctionService;
use App\Models\Ministere;
use App\Models\Niveau;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // FonctionService::factory(5)->create();
        // User::factory(10)->create();

        // Service::factory(5)->create();
        // Fonction::factory(1)->create();
        // Niveau::factory(5)->create();
        // Etat::factory(6)->create();
        // Ministere::factory(1)->create();

        // // Demande::factory(10)->create();
        // User::factory(1)->create([
        //     'nom_user' => 'Administrateur',
        //     'email' => 'admin@gmail.com',
        // ]);

        User::factory(1)->create();
    }
}
