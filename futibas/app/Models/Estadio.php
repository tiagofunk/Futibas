<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estadio extends Model
{
   protected $fillable = [
        'nome',
        'cidade',
        'pais',
        'capacidade',
        'data_fundacao',
    ];
}
