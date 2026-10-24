<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Jogo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10 px-4">
    <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Cadastrar Jogo</h2>

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

        <form action="{{ route('jogos.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Fase da Edição:</label>
                <select name="fase_id" class="w-full px-3 py-2 border rounded-lg bg-white focus:outline-none focus:ring" required>
                    <option value="">Selecione a Fase...</option>
                    @foreach($fases as $fase)
                        <option value="{{ $fase->id }}">
                            {{ $fase->edicao->campeonato->nome }} ({{ $fase->edicao->temporada }}) — Fase: {{ $fase->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Rodada:</label>
                    <input type="number" name="rodada" min="1" placeholder="Ex: 1" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Data e Horário:</label>
                    <input type="datetime-local" name="data_hora" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Time Mandante:</label>
                    <select name="time_mandante_id" class="w-full px-3 py-2 border rounded-lg bg-white focus:outline-none focus:ring" required>
                        <option value="">Selecione...</option>
                        @foreach($times as $time)
                            <option value="{{ $time->id }}">{{ $time->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Time Visitante:</label>
                    <select name="time_visitante_id" class="w-full px-3 py-2 border rounded-lg bg-white focus:outline-none focus:ring" required>
                        <option value="">Selecione...</option>
                        @foreach($times as $time)
                            <option value="{{ $time->id }}">{{ $time->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Estádio:</label>
                <select name="estadio_id" class="w-full px-3 py-2 border rounded-lg bg-white focus:outline-none focus:ring" required>
                    <option value="">Selecione o Estádio...</option>
                    @foreach($estadios as $estadio)
                        <option value="{{ $estadio->id }}">{{ $estadio->nome }} ({{ $estadio->cidade }})</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-600 transition">
                Cadastrar Jogo
            </button>
        </form>
    </div>
</body>
</html>