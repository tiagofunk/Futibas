<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edicao extends Model
{
    protected $table = 'edicoes';

    protected $fillable = [
        'campeonato_id',
        'temporada',
    ];

    public function campeonato()
    {
        return $this->belongsTo(Campeonato::class);
    }

    public function fases()
    {
        return $this->hasMany(Fase::class);
    }
}
