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
        
        $times = Time::where('nome', 'ilike', "%{$termo}%")
                    ->limit(10)
                    ->get(['id', 'nome']);

        return response()->json($times);
    }

    public function store_image(Request $request)
    {
        $request->validate([
            'escudo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $time = Time::findOrFail($request->time_id);

        if ($request->hasFile('escudo')) {
        
            if ($time->escudo && \Storage::disk('public')->exists($time->escudo)) {
                \Storage::disk('public')->delete($time->escudo);
            }

            $caminhoEscudo = $request->file('escudo')->store('escudos', 'public');

            $time->update([
                'escudo' => $caminhoEscudo
            ]);
        }

        return redirect()->back()->with('sucesso', 'Escudo atualizado com sucesso!');
    }

    public function atualizarEscudo(){
        return view('times.escudo');
    }
}
