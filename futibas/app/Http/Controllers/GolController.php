<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gol;

class GolController extends Controller
{
    public function store(Request $request, $jogoId)
    {
        $request->validate([
            'jogador_id' => 'required|exists:jogadores,id',
            'is_mandante' => 'required|boolean',
            'minuto' => 'required|string|max:10',
            'penalti' => 'sometimes|boolean',
            'contra' => 'sometimes|boolean',
        ]);

        Gol::create([
            'jogo_id' => $jogoId,
            'jogador_id' => $request->jogador_id,
            'is_mandante' => $request->is_mandante,
            'minuto' => $request->minuto,
            'penalti' => $request->has('penalti'),
            'contra' => $request->has('contra'),
        ]);

        return redirect()->route('jogos.edit', $jogoId)->with('sucesso', 'Gol registrado com sucesso!');
    }

    public function destroy($id)
    {
        $gol = Gol::findOrFail($id);
        $jogoId = $gol->jogo_id;
        $gol->delete();

        return redirect()->route('jogos.edit', $jogoId)->with('sucesso', 'Gol removido com sucesso!');
    }
}
