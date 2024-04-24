<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('nom_demande');
            $table->string('prenom_demande');
            $table->string('email_demande');
            $table->string('image_demande');
            $table->string('cv');
            $table->string('lm');
            $table->string('autres');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('etat_id')->constrained('etats')->onDelete('cascade');
            $table->foreignId('niveau_id')->constrained('niveaux')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
