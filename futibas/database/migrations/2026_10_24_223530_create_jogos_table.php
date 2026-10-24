<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fase_id')->constrained('fases')->onDelete('cascade');
            $table->foreignId('time_mandante_id')->constrained('times')->onDelete('cascade');
            $table->foreignId('time_visitante_id')->constrained('times')->onDelete('cascade');
            $table->foreignId('estadio_id')->constrained('estadios')->onDelete('cascade');
            $table->integer('rodada');
            $table->dateTime('data_hora');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jogos');
    }
};
