<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::table('programs')->insert([
            [
                'name' => 'Brûle Graisse Express',
                'description' => 'Entraînement HIIT de 30 minutes pour brûler un maximum de calories.',
                'duration' => 4,
                'difficulty' => 'intermediate',
                'status' => 'active',
                'objectif_cible' => 'perte_poids',
                'coach_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cardio Matinal',
                'description' => 'Routine cardio légère pour commencer la journée en forme.',
                'duration' => 6,
                'difficulty_level' => 'beginner',
                'status' => 'active',
                'objectif_cible' => 'perte_poids',
                'coach_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    public function down()
    {
        DB::table('programs')
            ->whereIn('name', ['Brûle Graisse Express', 'Cardio Matinal'])
            ->delete();
    }
}; 