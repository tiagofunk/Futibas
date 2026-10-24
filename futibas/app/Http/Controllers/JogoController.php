<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogo;
use App\Models\Fase;
use App\Models\Time;
use App\Models\Estadio;

class JogoController extends Controller
{
    public function create()
    {
        $fases = Fase::with('edicao.campeonato')->get();
        $times = Time::all();
        $estadios = Estadio::all();

        return view('jogos.create', compact('fases', 'times', 'estadios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fase_id' => 'required|exists:fases,id',
            'rodada' => 'required|integer|min:1',
            'data_hora' => 'required|date',
            'time_mandante_id' => 'required|exists:times,id',
            'time_visitante_id' => 'required|exists:times,id|different:time_mandante_id',
            'estadio_id' => 'required|exists:estadios,id',
        ]);

        Jogo::create($request->all());

        return redirect()->back()->with('sucesso', 'Jogo cadastrado com sucesso!');
    }
}