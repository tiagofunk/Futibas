<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Time;

class TimeController extends Controller
{
    public function create()
    {
        return view('times.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'nome_completo' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'data_fundacao' => 'required|date',
        ]);

        Time::create($request->all());

        return redirect()->back()->with('sucesso', 'Time cadastrado com sucesso!');
    }

    public function consultarPorNome(Request $request) {
        $termo = $request->get('q', '');
        
        // Busca apenas os times que correspondem ao que foi digitado (limitado a 10)
        $times = Time::where('nome', 'ilike', "%{$termo}%")
                    ->limit(10)
                    ->get(['id', 'nome']);

        return response()->json($times);
    }
}
