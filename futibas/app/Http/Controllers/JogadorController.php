<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogador;

class JogadorController extends Controller
{
    public function create()
    {
        return view('jogadores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'required|date|before:today',
            'peso' => 'required|numeric|min:30|max:200',
            'altura' => 'required|numeric|min:1.00|max:2.50',
            'pe_preferencial' => 'required|in:Direito,Esquerdo,Ambidestro',
            'cidade_nascimento' => 'required|string|max:255',
            'pais_nascimento' => 'required|string|max:255',
            'nacionalidades' => 'required|array|min:1',
            'nacionalidades.*' => 'required|string|max:255',
            'posicao' => 'required|string|max:255',
        ]);

        Jogador::create($request->all());

        return redirect()->back()->with('sucesso', 'Jogador cadastrado com sucesso!');
    }
}