<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model
{
    protected $fillable = [
        'nome',
        'periodicidade',
        'formato',
        'tipo',
        'classificacao',
        'local_disputa',
    ];
}
