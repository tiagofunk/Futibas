<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Time</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Cadastrar Time de Futebol</h2>

        @if(session('sucesso'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('sucesso') }}
            </div>
        @endif

        <form action="{{ route('times.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nome / Apelido:</label>
                <input type="text" name="nome" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nome Completo:</label>
                <input type="text" name="nome_completo" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Cidade:</label>
                <input type="text" name="cidade" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">País:</label>
                <input type="text" name="pais" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Data de Fundação:</label>
                <input type="date" name="data_fundacao" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                Cadastrar Time
            </button>
        </form>
    </div>
</body>
</html>