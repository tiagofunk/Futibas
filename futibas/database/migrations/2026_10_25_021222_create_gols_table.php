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
        Schema::create('gols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jogo_id')->constrained('jogos')->onDelete('cascade');
            $table->foreignId('jogador_id')->constrained('jogadores')->onDelete('cascade');
            $table->boolean('is_mandante');
            $table->string('minuto');
            $table->boolean('penalti')->default(false);
            $table->boolean('contra')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gols');
    }
};
