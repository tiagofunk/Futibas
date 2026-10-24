<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campeonato;
use App\Models\Edicao;
use Illuminate\Support\Facades\DB;

class EdicaoController extends Controller
{
    public function create()
    {
        $campeonatos = Campeonato::all();
        return view('edicoes.create', compact('campeonatos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'campeonato_id' => 'required|exists:campeonatos,id',
            'temporada' => 'required|string|max:255',
            'fases' => 'required|array|min:1',
            'fases.*.nome' => 'required|string|max:255',
            'fases.*.formato' => 'required|in:pontos_corridos,mata-mata',
            'fases.*.qtd_grupos' => 'required|integer|min:1',
            'fases.*.tipo_numeracao' => 'required|in:letras,numeros',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Cria a Edição do Campeonato
            $edicao = Edicao::create([
                'campeonato_id' => $request->campeonato_id,
                'temporada' => $request->temporada,
            ]);

            // 2. Percorre e cadastra cada fase enviada
            foreach ($request->fases as $faseData) {
                $fase = $edicao->fases()->create([
                    'nome' => $faseData['nome'],
                    'formato' => $faseData['formato'],
                ]);

                $qtdGrupos = (int) $faseData['qtd_grupos'];
                $tipoNumeracao = $faseData['tipo_numeracao'];

                // 3. Gera os grupos automaticamente com base na quantidade e tipo de numeração
                for ($i = 1; $i <= $qtdGrupos; $i++) {
                    if ($qtdGrupos === 1) {
                        $nomeGrupo = 'Grupo Único';
                    } else {
                        if ($tipoNumeracao === 'letras') {
                            $nomeGrupo = 'Grupo ' . chr(64 + $i); // 1 = A, 2 = B, etc.
                        } else {
                            $nomeGrupo = 'Grupo ' . $i; // 1 = 1, 2 = 2, etc.
                        }
                    }

                    $fase->grupos()->create([
                        'nome' => $nomeGrupo,
                    ]);
                }
            }
        });

        return redirect()->back()->with('sucesso', 'Edição de campeonato cadastrada com sucesso!');
    }
}
