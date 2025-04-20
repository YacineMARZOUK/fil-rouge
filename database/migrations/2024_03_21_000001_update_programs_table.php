<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('programs', function (Blueprint $table) {
        if (!Schema::hasColumn('programs', 'duration')) {
            $table->string('duration')->nullable();
        }
        
        if (!Schema::hasColumn('programs', 'difficulty')) {
            $table->string('difficulty')->enum(['facile', 'moyen', 'difficile'])->nullable();
        }
        
        if (!Schema::hasColumn('programs', 'objectif_cible')) {
            $table->string('objectif_cible')->enum(['perte_poids', 'prise_muscle', 'maintien', 'endurance'])->nullable();
        }
    });
}

    public function down()
    {
        Schema::table('programs', function (Blueprint $table) {
            // Restaurer les anciennes colonnes
            $table->enum('difficulty_level', ['beginner', 'intermediate', 'advanced'])->after('description');
            $table->string('status')->default('active')->after('difficulty_level');
            
            // Supprimer les nouvelles colonnes
            $table->dropColumn(['duration', 'difficulty', 'objectif_cible']);
        });
    }
}; 