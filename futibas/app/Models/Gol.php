<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gol extends Model
{
    protected $table = 'gols';

    protected $fillable = [
        'jogo_id',
        'jogador_id',
        'is_mandante',
        'minuto',
        'penalti',
        'contra',
    ];

    public function jogo()
    {
        return $this->belongsTo(Jogo::class);
    }

    public function jogador()
    {
        return $this->belongsTo(Jogador::class);
    }
}
