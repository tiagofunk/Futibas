<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Jogo</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

    <div class="max-w-3xl mx-auto bg-white p-8 my-10 rounded-lg shadow-md">
        <!-- Cabeçalho -->
        <div class="flex justify-between items-center mb-6 pb-4 border-b">
            <div>
                <span class="text-sm font-semibold text-blue-600 uppercase tracking-wide">
                    {{ $jogo->fase->edicao->campeonato->nome ?? 'Campeonato' }} — {{ $jogo->fase->nome ?? 'Fase' }}
                </span>
                <h2 class="text-2xl font-bold text-gray-800">Detalhes da Partida</h2>
            </div>
            <a href="javascript:history.back()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm transition font-bold">
                Voltar
            </a>
        </div>

        <!-- Placar / Confronto Principal -->
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mb-6 flex justify-around items-center text-center">
            <div class="w-1/3">
                <span class="text-xs text-gray-500 uppercase block mb-1">Mandante</span>
                <span class="text-xl font-bold text-gray-800">{{ $jogo->mandante->nome ?? '-' }}</span>
                <span class="block text-4xl font-extrabold text-blue-600 mt-2">
                    {{ $jogo->gols->where('is_mandante', true)->count() }}
                </span>
            </div>
            
            <div class="w-1/3">
                <span class="text-sm font-bold bg-blue-100 text-blue-800 px-3 py-1 rounded-full">X</span>
            </div>

            <div class="w-1/3">
                <span class="text-xs text-gray-500 uppercase block mb-1">Visitante</span>
                <span class="text-xl font-bold text-gray-800">{{ $jogo->visitante->nome ?? '-' }}</span>
                <span class="block text-4xl font-extrabold text-blue-600 mt-2">
                    {{ $jogo->gols->where('is_mandante', false)->count() }}
                </span>
            </div>
        </div>

        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2 text-center">Linha do Tempo de Gols</h3>
            
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-3">
                @forelse($jogo->gols->sortBy(function($gol) {
                    return intval($gol->minuto);
                }) as $gol)
                    
                    <!-- Verifica se o gol é do mandante (esquerda) ou visitante (direita) -->
                    <div class="flex {{ $gol->is_mandante ? 'justify-start' : 'justify-end' }}">
                        <div class="bg-white px-4 py-3 rounded-lg border shadow-sm max-w-xs w-full flex items-center space-x-3 {{ $gol->is_mandante ? 'border-l-4 border-l-blue-500' : 'border-r-4 border-r-green-500 flex-row-reverse space-x-reverse' }}">
                            
                            <!-- Ícone do tipo de gol -->
                            <span class="text-xl" title="{{ $gol->penalti ? 'Gol de Pênalti' : ($gol->contra ? 'Gol Contra' : 'Gol Normal') }}">
                                @if($gol->penalti) ⚽🎯 
                                @elseif($gol->contra) ⚽🔄 
                                @else ⚽ 
                                @endif
                            </span>

                            <!-- Informações do Gol -->
                            <div class="{{ $gol->is_mandante ? 'text-left' : 'text-right' }} w-full">
                                <div class="flex items-center {{ $gol->is_mandante ? 'justify-start space-x-2' : 'justify-end space-x-2 space-x-reverse' }}">
                                    <span class="font-bold text-blue-600 text-sm">{{ $gol->minuto }}'</span>
                                    <span class="font-bold text-gray-800 text-sm">{{ $gol->jogador->nome ?? '-' }}</span>
                                </div>
                                <div class="text-[11px] text-gray-400 font-medium">
                                    {{ $gol->is_mandante ? $jogo->mandante->nome : $jogo->visitante->nome }}
                                    @if($gol->penalti) • Pênalti @endif
                                    @if($gol->contra) • Gol Contra @endif
                                </div>
                            </div>

                        </div>
                    </div>

                @empty
                    <p class="text-center text-gray-400 text-sm italic py-4">Nenhum gol registrado nesta partida até o momento.</p>
                @endforelse
            </div>
        </div>

        <!-- Informações Detalhadas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-4 rounded-lg border border-gray-200">
                <span class="text-xs font-semibold text-gray-400 uppercase block">Data e Hora</span>
                <span class="text-base font-medium text-gray-700">
                    {{ \Carbon\Carbon::parse($jogo->data_hora)->format('d/m/Y H:i') }}
                </span>
            </div>

            <div class="bg-white p-4 rounded-lg border border-gray-200">
                <span class="text-xs font-semibold text-gray-400 uppercase block">Estádio</span>
                <span class="text-base font-medium text-gray-700">
                    {{ $jogo->estadio->nome ?? '-' }} 
                    @if($jogo->estadio && $jogo->estadio->cidade)
                        <span class="text-sm text-gray-500">({{ $jogo->estadio->cidade }})</span>
                    @endif
                </span>
            </div>

            <div class="bg-white p-4 rounded-lg border border-gray-200">
                <span class="text-xs font-semibold text-gray-400 uppercase block">Rodada / Fase</span>
                <span class="text-base font-medium text-gray-700">
                    Rodada {{ $jogo->rodada }} ({{ $jogo->fase->nome ?? '-' }})
                </span>
            </div>

            <div class="bg-white p-4 rounded-lg border border-gray-200">
                <span class="text-xs font-semibold text-gray-400 uppercase block">Campeonato e Edição</span>
                <span class="text-base font-medium text-gray-700">
                    {{ $jogo->fase->edicao->campeonato->nome ?? '-' }}
                    ({{ $jogo->fase->edicao->temporada ?? '-' }})
                </span>
            </div>
        </div>
    </div>
</body>
</html>