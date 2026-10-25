<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Jogo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10 px-4">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <!-- Cabeçalho -->
        <div class="flex justify-between items-center mb-6 pb-4 border-b">
            <div>
                <span class="text-sm font-semibold text-blue-600 uppercase tracking-wide">
                    {{ $jogo->fase->campeonato->nome ?? 'Campeonato' }} — {{ $jogo->fase->nome ?? 'Fase' }}
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
            </div>
            
            <div class="w-1/3">
                <span class="text-sm font-bold bg-blue-100 text-blue-800 px-3 py-1 rounded-full">VS</span>
            </div>

            <div class="w-1/3">
                <span class="text-xs text-gray-500 uppercase block mb-1">Visitante</span>
                <span class="text-xl font-bold text-gray-800">{{ $jogo->visitante->nome ?? '-' }}</span>
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