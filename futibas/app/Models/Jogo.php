<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    protected $fillable = [
        'fase_id',
        'time_mandante_id',
        'time_visitante_id',
        'estadio_id',
        'rodada',
        'data_hora',
    ];

    public function fase()
    {
        return $this->belongsTo(Fase::class);
    }

    public function mandante()
    {
        return $this->belongsTo(Time::class, 'time_mandante_id');
    }

    public function visitante()
    {
        return $this->belongsTo(Time::class, 'time_visitante_id');
    }

    public function estadio()
    {
        return $this->belongsTo(Estadio::class);
    }
}