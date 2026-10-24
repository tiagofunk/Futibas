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
        Schema::create('campeonatos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('periodicidade');
            $table->string('formato');
            $table->string('tipo');
            $table->string('classificacao');
            $table->string('local_disputa');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE campeonatos ADD CONSTRAINT check_periodicidade CHECK (periodicidade IN ('1 ano', '2 anos', '4 anos'))");
        DB::statement("ALTER TABLE campeonatos ADD CONSTRAINT check_formato CHECK (formato IN ('campeonato', 'torneio', 'copa'))");
        DB::statement("ALTER TABLE campeonatos ADD CONSTRAINT check_tipo CHECK (tipo IN ('regional', 'nacional', 'continental', 'mundial'))");
        DB::statement("ALTER TABLE campeonatos ADD CONSTRAINT check_classificacao CHECK (classificacao IN ('clubes', 'selecoes'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campeonatos');
    }
};
