<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Campeonato</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen py-10">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Cadastrar Campeonato</h2>

        @if(session('sucesso'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('sucesso') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('campeonatos.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nome do Campeonato:</label>
                <input type="text" name="nome" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Periodicidade:</label>
                <select name="periodicidade" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring bg-white" required>
                    <option value="">Selecione...</option>
                    <option value="1 ano">1 ano</option>
                    <option value="2 anos">2 anos</option>
                    <option value="4 anos">4 anos</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Formato:</label>
                <select name="formato" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring bg-white" required>
                    <option value="">Selecione...</option>
                    <option value="campeonato">Campeonato</option>
                    <option value="torneio">Torneio</option>
                    <option value="copa">Copa</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tipo:</label>
                <select name="tipo" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring bg-white" required>
                    <option value="">Selecione...</option>
                    <option value="regional">Regional</option>
                    <option value="nacional">Nacional</option>
                    <option value="continental">Continental</option>
                    <option value="mundial">Mundial</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Classificação:</label>
                <select name="classificacao" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring bg-white" required>
                    <option value="">Selecione...</option>
                    <option value="clubes">Clubes</option>
                    <option value="seleções">Seleções</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Local de Disputa:</label>
                <input type="text" name="local_disputa" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                Cadastrar Campeonato
            </button>
        </form>
    </div>
</body>
</html>