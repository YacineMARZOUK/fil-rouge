<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('sexe', ['homme', 'femme']);
            $table->integer('age');
            $table->decimal('taille', 5, 2);
            $table->decimal('poids', 5, 2);
            $table->enum('niveau_activite', ['sedentaire', 'leger', 'modere', 'actif', 'tres_actif']);
            $table->enum('objectif_principal', ['perte_poids', 'prise_muscle', 'maintien', 'endurance']);
            $table->integer('besoins_caloriques');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_goals');
    }
}; 