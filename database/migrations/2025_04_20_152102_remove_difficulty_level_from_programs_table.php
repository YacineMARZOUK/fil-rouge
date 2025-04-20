<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDifficultyLevelFromProgramsTable extends Migration
{
    public function up()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn('difficulty_level');
        });
    }

    public function down()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->string('difficulty_level')->after('difficulty')->nullable();
        });
    }
}