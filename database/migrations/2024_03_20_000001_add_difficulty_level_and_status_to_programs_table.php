<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->enum('difficulty_level', ['beginner', 'intermediate', 'advanced'])
                  ->after('duration');
            $table->enum('status', ['active', 'inactive'])
                  ->default('active')
                  ->after('difficulty_level');
        });
    }

    public function down()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn('difficulty_level');
            $table->dropColumn('status');
        });
    }
}; 