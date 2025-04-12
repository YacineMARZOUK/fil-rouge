<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('goal_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_goal_id')->constrained()->onDelete('cascade');
            $table->decimal('current_value', 10, 2);
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('goal_updates');
    }
}; 