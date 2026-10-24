<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campeonato;

class CampeonatoController extends Controller
{
    public function create()
    {
        return view('campeonatos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'periodicidade' => 'required|in:1 ano,2 anos,4 anos',
            'formato' => 'required|in:campeonato,torneio,copa',
            'tipo' => 'required|in:regional,nacional,continental,mundial',
            'classificacao' => 'required|in:clubes,selecoes',
            'local_disputa' => 'required|string|max:255',
        ]);

        Campeonato::create($request->all());

        return redirect()->back()->with('sucesso', 'Campeonato cadastrado com sucesso!');
    }
}
