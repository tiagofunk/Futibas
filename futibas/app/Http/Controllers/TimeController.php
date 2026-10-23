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
}
