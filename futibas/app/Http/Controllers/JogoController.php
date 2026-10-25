<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogo;
use App\Models\Fase;
use App\Models\Time;
use App\Models\Estadio;
use App\Models\Campeonato;

class JogoController extends Controller
{
    public function create()
    {
        $campeonatos = Campeonato::all();
        $fases = Fase::with('edicao.campeonato')->get();
        $times = Time::all();
        $estadios = Estadio::all();

        return view('jogos.create', compact('campeonatos', 'fases', 'times', 'estadios'));
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

    public function consultar(Request $request)
    {
        $campeonatos = Campeonato::all();
        $fases = Fase::with('edicao.campeonato')->get();
        $jogos = [];
        $faseSelecionada = null;

        if ($request->has('fase_id') && $request->fase_id) {
            $faseSelecionada = Fase::with('edicao.campeonato')->find($request->fase_id);
            $jogos = Jogo::with(['mandante', 'visitante', 'estadio'])
                ->where('fase_id', $request->fase_id)
                ->orderBy('rodada')
                ->orderBy('data_hora')
                ->get();
        }

        return view('jogos.consultar', compact('campeonatos', 'fases', 'jogos', 'faseSelecionada'));
    }

    public function show($id)
    {
        $jogo = Jogo::with(['mandante', 'visitante', 'estadio', 'fase.edicao.campeonato'])->findOrFail($id);

        return view('jogos.show', compact('jogo'));
    }
}