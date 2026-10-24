<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    protected $fillable = [
        'edicao_id',
        'nome',
        'formato',
    ];

    public function edicao()
    {
        return $this->belongsTo(Edicao::class);
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
