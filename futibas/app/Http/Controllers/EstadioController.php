<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estadio;

class EstadioController extends Controller
{
    public function create()
    {
        return view('estadios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'capacidade' => 'required|integer|min:1',
            'data_fundacao' => 'required|date'
        ]);

        Estadio::create($request->all());

        return redirect()->back()->with('sucesso', 'Estádio cadastrado com sucesso!');
    }
}