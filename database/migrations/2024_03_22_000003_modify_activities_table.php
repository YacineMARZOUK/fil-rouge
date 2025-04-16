<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->foreignId('user_id')->after('coach_id')->constrained()->onDelete('cascade');
            $table->dropColumn(['location', 'max_participants', 'equipment']);
        });
    }

    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->string('location');
            $table->integer('max_participants')->default(10);
            $table->text('equipment')->nullable();
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}; 