<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Gols - Partida</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tom Select CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tom-select.css') }}">
</head>
<body class="bg-gray-100">

    <header class="w-full bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Título / Logo do Sistema -->
            <h1 class="text-xl font-extrabold text-gray-800 tracking-tight flex items-center space-x-2">
                <span>⚽</span>
                <span>Sistema de Gestão de Futebol</span>
            </h1>

            <!-- Navegação Direta / Início -->
            <nav class="flex items-center space-x-4">
                <a href="{{ route('home') }}" class="inline-flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-3.5 py-2 rounded-lg text-sm font-semibold transition shadow-sm" title="Página Inicial">
                    <!-- Ícone de Casa (SVG) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Início</span>
                </a>
            </nav>
        </div>
    </header>

    <div class="max-w-4xl mx-auto bg-white p-8 my-10 rounded-lg shadow-md">
        <!-- Cabeçalho -->
        <div class="flex justify-between items-center mb-6 pb-4 border-b">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Gols da Partida</h2>
                <span class="text-sm text-gray-500">
                    {{ $jogo->estadio->nome ?? 'Estádio não informado' }} — {{ \Carbon\Carbon::parse($jogo->data_hora)->format('d/m/Y H:i') }}
                </span>
            </div>
            <a href="javascript:history.back()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm transition font-bold">
                Voltar aos Jogos
            </a>
        </div>

        @if(session('sucesso'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('sucesso') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Placar / Confronto Atualizado Dinamicamente -->
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mb-8 flex justify-around items-center text-center">
            <div class="w-2/5">
                <span class="text-xs text-gray-500 uppercase block mb-1">Mandante</span>
                <span class="text-xl font-bold text-gray-800">{{ $jogo->mandante->nome ?? '-' }}</span>
                <span class="block text-3xl font-extrabold text-blue-600 mt-2">
                    {{ $jogo->gols->where('is_mandante', true)->count() }}
                </span>
            </div>
            
            <div class="w-1/5">
                <span class="text-sm font-bold bg-blue-100 text-blue-800 px-3 py-1 rounded-full">VS</span>
            </div>

            <div class="w-2/5">
                <span class="text-xs text-gray-500 uppercase block mb-1">Visitante</span>
                <!-- <span class="text-xl font-bold text-gray-800">{{ $jogo->visitante }}</span> -->
                <span class="text-xl font-bold text-gray-800">{{ $jogo->visitante->nome ?? '-' }}</span>
                <span class="block text-3xl font-extrabold text-blue-600 mt-2">
                    {{ $jogo->gols->where('is_mandante', false)->count() }}
                </span>
            </div>
        </div>

        <!-- Formulário para Adicionar Gol -->
        <form action="{{ route('gols.store', $jogo->id) }}" method="POST" class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-8">
            @csrf
            <h3 class="text-lg font-bold text-gray-700 mb-4">Adicionar Gol</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Equipe:</label>
                    <select name="is_mandante" class="w-full px-3 py-2 border rounded-lg bg-white focus:outline-none focus:ring" required>
                        <option value="1">{{ $jogo->mandante->nome ?? 'Mandante' }} (Mandante)</option>
                        <option value="0">{{ $jogo->visitante->nome ?? 'Visitante' }} (Visitante)</option>
                    </select>
                </div>

               <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Jogador:</label>
                    <select id="jogador_select" name="jogador_id" placeholder="Digite para pesquisar o jogador..." required>
                        <option value="">Digite para pesquisar...</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 items-center">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Minuto:</label>
                    <input type="text" name="minuto" placeholder="Ex: 45 ou 45+1" class="w-full px-3 py-2 border rounded-lg bg-white focus:outline-none focus:ring" required>
                </div>

                <div class="flex space-x-6 mt-6 md:mt-0 md:col-span-2 items-center">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="penalti" value="1" class="w-4 h-4 text-blue-600 rounded">
                        <span class="text-gray-700 font-medium text-sm">Gol de Pênalti</span>
                    </label>

                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="contra" value="1" class="w-4 h-4 text-red-600 rounded">
                        <span class="text-gray-700 font-medium text-sm">Gol Contra</span>
                    </label>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transition">
                Adicionar Gol
            </button>
        </form>

        <!-- Listagem de Gols Dividida por Lados -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Gols Mandante -->
            <div class="bg-white p-4 rounded-lg border border-gray-200">
                <h4 class="font-bold text-gray-800 mb-3 border-b pb-2">Gols - {{ $jogo->timeMandante->nome ?? 'Mandante' }}</h4>
                <ul class="space-y-2">
                    @forelse($jogo->gols->where('is_mandante', true) as $gol)
                        <li class="flex justify-between items-center bg-gray-50 p-2 rounded border">
                            <div>
                                <span class="font-bold text-blue-600">{{ $gol->minuto }}'</span>
                                <span class="font-medium text-gray-800 ml-2">{{ $gol->jogador->nome ?? '-' }}</span>
                                @if($gol->penalti) <span class="text-xs bg-yellow-100 text-yellow-800 px-1.5 py-0.5 rounded ml-1">Pênalti</span> @endif
                                @if($gol->contra) <span class="text-xs bg-red-100 text-red-800 px-1.5 py-0.5 rounded ml-1">Contra</span> @endif
                            </div>
                            <form action="{{ route('gols.destroy', $gol->id) }}" method="POST" onsubmit="return confirm('Deseja remover este gol?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold px-2">✕</button>
                            </form>
                        </li>
                    @empty
                        <li class="text-gray-400 text-sm">Nenhum gol registrado.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Gols Visitante -->
            <div class="bg-white p-4 rounded-lg border border-gray-200">
                <h4 class="font-bold text-gray-800 mb-3 border-b pb-2">Gols - {{ $jogo->timeVisitante->nome ?? 'Visitante' }}</h4>
                <ul class="space-y-2">
                    @forelse($jogo->gols->where('is_mandante', false) as $gol)
                        <li class="flex justify-between items-center bg-gray-50 p-2 rounded border">
                            <div>
                                <span class="font-bold text-blue-600">{{ $gol->minuto }}'</span>
                                <span class="font-medium text-gray-800 ml-2">{{ $gol->jogador->nome ?? '-' }}</span>
                                @if($gol->penalti) <span class="text-xs bg-yellow-100 text-yellow-800 px-1.5 py-0.5 rounded ml-1">Pênalti</span> @endif
                                @if($gol->contra) <span class="text-xs bg-red-100 text-red-800 px-1.5 py-0.5 rounded ml-1">Contra</span> @endif
                            </div>
                            <form action="{{ route('gols.destroy', $gol->id) }}" method="POST" onsubmit="return confirm('Deseja remover este gol?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold px-2">✕</button>
                            </form>
                        </li>
                    @empty
                        <li class="text-gray-400 text-sm">Nenhum gol registrado.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- Tom Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            new TomSelect("#jogador_select", {
                valueField: 'id',
                labelField: 'nome',
                searchField: 'nome',
                placeholder: 'Digite o nome do jogador...',
                load: function(query, callback) {
                    if (!query.length) return callback();

                    // Faz a requisição AJAX para a sua rota de busca no Laravel
                    fetch('{{ route("jogadores.consultar") }}?q=' + encodeURIComponent(query))
                        .then(response => response.json())
                        .then(json => {
                            callback(json);
                        }).catch(()=>{
                            callback();
                        });
                },
                // Personaliza como o jogador aparece na lista de resultados
                render: {
                    option: function(item, escape) {
                        return `<div class="py-2 px-3 flex flex-col">
                                    <span class="font-bold text-gray-800">
                                        ${escape(item.nome)} (${escape(item.nome_camisa)}) - ${escape(item.posicao ?? 'Posição não informada')}
                                    </span>
                                </div>`;
                    },
                    item: function(item, escape) {
                        return `<div>${escape(item.nome)}</div>`;
                    }
                }
            });
        });
    </script>
</body>
</html>