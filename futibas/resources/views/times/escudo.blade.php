<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Escudo ao Time</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tom Select CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tom-select.css') }}">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Cabeçalho Padrão -->
    <header class="w-full bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-extrabold text-gray-800 tracking-tight flex items-center space-x-2">
                <span>⚽</span>
                <span>Sistema de Gestão de Futebol</span>
            </h1>
            <nav class="flex items-center space-x-4">
                <a href="{{ route('home') }}" class="inline-flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-3.5 py-2 rounded-lg text-sm font-semibold transition shadow-sm" title="Página Inicial">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Início</span>
                </a>
            </nav>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="flex-1 max-w-lg w-full mx-auto px-4 my-8 flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Adicionar/Atualizar Escudo</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc pl-5">
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

            <form action="{{ route('times.atualizarEscudo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Selecione o Time:</label>
                    <select id="time_select" name="time_id" placeholder="Digite para pesquisar o time..." required>
                        <option value="">Digite para pesquisar...</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Escudo do Time:</label>
                    <input type="file" name="escudo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border rounded-lg cursor-pointer" required>
                    <p class="text-xs text-gray-400 mt-1">Formatos aceitos: PNG, JPG, WEBP (Máx. 2MB).</p>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-600 transition shadow">
                    Salvar Escudo
                </button>
            </form>
        </div>
    </main>

    <!-- Tom Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            new TomSelect("#time_select", {
                valueField: 'id',
                labelField: 'nome',
                searchField: 'nome',
                placeholder: 'Digite o nome do time...',
                load: function(query, callback) {
                    if (!query.length) return callback();

                    fetch('{{ route("times.consultar") }}?q=' + encodeURIComponent(query))
                        .then(response => response.json())
                        .then(json => {
                            callback(json);
                        }).catch(()=>{
                            callback();
                        });
                },
                render: {
                    option: function(item, escape) {
                        return `<div class="py-2 px-3 flex items-center space-x-3">
                                    <span class="font-bold text-gray-800">${escape(item.nome)}</span>
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