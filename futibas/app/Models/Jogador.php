<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogador extends Model
{
    protected $table = 'jogadores';

    protected $fillable = [
        'nome',
        'data_nascimento',
        'peso',
        'altura',
        'pe_preferencial',
        'cidade_nascimento',
        'pais_nascimento',
        'nacionalidade',
        'posicao',
    ];
}
