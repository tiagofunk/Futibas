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
        Schema::create('fases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('edicao_id')->constrained('edicoes')->onDelete('cascade');
            $table->string('nome');
            $table->string('formato');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE fases ADD CONSTRAINT check_formato_fase CHECK (formato IN ('pontos_corridos', 'mata-mata'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fases');
    }
};
