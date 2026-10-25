<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Jogador</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10 px-4">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Cadastrar Jogador</h2>

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

        <form action="{{ route('jogadores.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nome Completo:</label>
                <input type="text" name="nome" placeholder="Ex: Lionel Messi" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Data de Nascimento:</label>
                    <input type="date" name="data_nascimento" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Peso (kg):</label>
                    <input type="number" step="0.01" name="peso" placeholder="Ex: 72.5" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Altura (m):</label>
                    <input type="number" step="0.01" name="altura" placeholder="Ex: 1.70" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Pé Preferencial:</label>
                    <select name="pe_preferencial" class="w-full px-3 py-2 border rounded-lg bg-white focus:outline-none focus:ring" required>
                        <option value="">Selecione...</option>
                        <option value="Direito">Direito</option>
                        <option value="Esquerdo">Esquerdo</option>
                        <option value="Ambidestro">Ambidestro</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Posição:</label>
                    <select name="posicao" class="w-full px-3 py-2 border rounded-lg bg-white focus:outline-none focus:ring" required>
                        <option value="">Selecione a posição...</option>
                        <option value="Goleiro">Goleiro</option>
                        <option value="Zagueiro">Zagueiro</option>
                        <option value="Lateral Direito">Lateral Direito</option>
                        <option value="Lateral Esquerdo">Lateral Esquerdo</option>
                        <option value="Volante">Volante</option>
                        <option value="Meia">Meia</option>
                        <option value="Atacante">Atacante</option>
                        <option value="Centroavante">Centroavante</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Cidade de Nascimento:</label>
                    <input type="text" name="cidade_nascimento" placeholder="Ex: Rosário" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">País de Nascimento:</label>
                    <input type="text" name="pais_nascimento" placeholder="Ex: Argentina" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nacionalidade:</label>
                    <input type="text" name="nacionalidade" placeholder="Ex: Argentina / Espanhola" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-600 transition">
                Cadastrar Jogador
            </button>
        </form>
    </div>
</body>
</html>