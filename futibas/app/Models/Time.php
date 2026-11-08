<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = [
        'nome',
        'escudo',
        'nome_completo',
        'cidade',
        'pais',
        'data_fundacao',
    ];
}
