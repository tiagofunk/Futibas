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
        Schema::create('jogadores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->date('data_nascimento');
            $table->decimal('peso', 5, 2);
            $table->decimal('altura', 3, 2);
            $table->string('pe_preferencial');
            $table->string('cidade_nascimento');
            $table->string('pais_nascimento');
            $table->jsonb('nacionalidades');
            $table->string('posicao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jogadors');
    }
};
