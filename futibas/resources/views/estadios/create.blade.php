<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Estádio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col justify-center min-h-screen">

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

    <main class="flex-1 flex items-center justify-center p-4 my-8">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Cadastrar Estádio</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('sucesso'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('sucesso') }}
                </div>
            @endif

            <form action="{{ route('estadios.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nome do Estádio:</label>
                    <input type="text" name="nome" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
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
                    <label class="block text-gray-700 text-sm font-bold mb-2">Capacidade:</label>
                    <input type="number" name="capacidade" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Data de Fundação:</label>
                    <input type="date" name="data_fundacao" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                    Cadastrar Estádio
                </button>
            </form>
        </div>
    </main>
</body>
</html>