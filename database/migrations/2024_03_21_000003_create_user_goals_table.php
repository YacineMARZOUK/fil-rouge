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
            $table->string('goal');
            $table->integer('age');
            $table->enum('sexe', ['homme', 'femme']);
            $table->integer('taille')->comment('Taille en cm');
            $table->decimal('poids', 5, 2)->comment('Poids en kg');
            $table->enum('niveau_activite', ['sedentaire', 'modere', 'actif']);
            $table->enum('objectif_principal', ['perte_poids', 'prise_masse']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_goals');
    }
}; 