<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('user_goals', function (Blueprint $table) {
            $table->foreignId('program_id')->nullable()->after('user_id')->constrained()->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('user_goals', function (Blueprint $table) {
            $table->dropForeign(['program_id']);
            $table->dropColumn('program_id');
        });
    }
}; 