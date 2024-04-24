<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('fonction_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();

            // Ajout des clés étrangères
            $table->foreign('fonction_id')->references('id')->on('fonctions')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['fonction_id']);
            $table->dropForeign(['service_id']);
            $table->dropColumn(['fonction_id', 'service_id']);
        });
    }
}
