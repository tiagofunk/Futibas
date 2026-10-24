<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable = [
        'fase_id',
        'nome',
    ];

    public function fase()
    {
        return $this->belongsTo(Fase::class);
    }
}
