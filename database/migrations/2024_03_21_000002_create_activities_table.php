<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('program_id')->nullable()->constrained()->onDelete('set null');
            $table->dateTime('date');
            $table->string('location');
            $table->integer('max_participants')->default(10);
            $table->integer('duration')->comment('Durée en minutes');
            $table->text('equipment')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activities');
    }
}; 