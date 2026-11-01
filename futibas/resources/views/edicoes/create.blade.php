<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Edição de Campeonato</title>
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
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Cadastrar Edição de Campeonato</h2>

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

        <form action="{{ route('edicoes.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Campeonato:</label>
                    <select name="campeonato_id" class="w-full px-3 py-2 border rounded-lg bg-white focus:outline-none focus:ring" required>
                        <option value="">Selecione o Campeonato...</option>
                        @foreach($campeonatos as $campeonato)
                            <option value="{{ $campeonato->id }}">{{ $campeonato->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Temporada / Ano:</label>
                    <input type="text" name="temporada" placeholder="Ex: 2024 ou 2024/2025" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring" required>
                </div>
            </div>

            <hr class="my-6">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-700">Fases da Edição</h3>
                <button type="button" id="add-fase" class="bg-green-500 text-white text-sm font-bold py-2 px-4 rounded-lg hover:bg-green-600 transition">
                    + Adicionar Fase
                </button>
            </div>

            <div id="fases-container" class="space-y-4">
                <!-- Template inicial de fase -->
                <div class="fase-item bg-gray-50 p-4 rounded-lg border relative">
                    <button type="button" class="remove-fase absolute top-2 right-2 text-red-500 font-bold hover:text-red-700">&times;</button>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                        <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">Nome da Fase:</label>
                            <input type="text" name="fases[0][nome]" placeholder="Ex: Fase de Grupos / Oitavas" class="w-full px-3 py-2 border rounded-lg text-sm bg-white" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">Formato:</label>
                            <select name="fases[0][formato]" class="w-full px-3 py-2 border rounded-lg text-sm bg-white" required>
                                <option value="pontos_corridos">Pontos Corridos</option>
                                <option value="mata-mata">Mata-mata</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">Quantidade de Grupos / Confrontos:</label>
                            <input type="number" name="fases[0][qtd_grupos]" value="1" min="1" class="w-full px-3 py-2 border rounded-lg text-sm bg-white" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">Tipo de Numeração dos Grupos:</label>
                            <select name="fases[0][tipo_numeracao]" class="w-full px-3 py-2 border rounded-lg text-sm bg-white" required>
                                <option value="letras">Letras (A, B, C...)</option>
                                <option value="numeros">Números (1, 2, 3...)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full mt-6 bg-blue-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-600 transition">
                Cadastrar Edição e Fases
            </button>
        </form>
    </div>

    <script>
        let faseIndex = 0;
        document.getElementById('add-fase').addEventListener('click', function() {
            faseIndex++;
            const container = document.getElementById('fases-container');
            
            const html = `
                <div class="fase-item bg-gray-50 p-4 rounded-lg border relative">
                    <button type="button" class="remove-fase absolute top-2 right-2 text-red-500 font-bold hover:text-red-700">&times;</button>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                        <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">Nome da Fase:</label>
                            <input type="text" name="fases[${faseIndex}][nome]" placeholder="Ex: Quartas de Final" class="w-full px-3 py-2 border rounded-lg text-sm bg-white" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">Formato:</label>
                            <select name="fases[${faseIndex}][formato]" class="w-full px-3 py-2 border rounded-lg text-sm bg-white" required>
                                <option value="pontos_corridos">Pontos Corridos</option>
                                <option value="mata-mata">Mata-mata</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">Quantidade de Grupos / Confrontos:</label>
                            <input type="number" name="fases[${faseIndex}][qtd_grupos]" value="1" min="1" class="w-full px-3 py-2 border rounded-lg text-sm bg-white" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">Tipo de Numeração dos Grupos:</label>
                            <select name="fases[${faseIndex}][tipo_numeracao]" class="w-full px-3 py-2 border rounded-lg text-sm bg-white" required>
                                <option value="letras">Letras (A, B, C...)</option>
                                <option value="numeros">Números (1, 2, 3...)</option>
                            </select>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-fase')) {
                const items = document.querySelectorAll('.fase-item');
                if (items.length > 1) {
                    e.target.closest('.fase-item').remove();
                } else {
                    alert('A edição deve conter pelo menos uma fase.');
                }
            }
        });
    </script>
</body>
</html>