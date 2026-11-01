<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Gestão de Futebol</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Barra Superior -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-extrabold text-gray-800 tracking-tight">⚽ Sistema de Gestão de Futebol</h1>
            <span class="text-sm font-medium text-gray-500">Painel Administrativo</span>
        </div>
    </header>

    <!-- Conteúdo Principal -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        
        <!-- Seção de Boas-vindas -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Bem-vindo de volta!</h2>
            <p class="text-gray-500 text-sm mt-1">Gerencie campeonatos, equipes, partidas e estatísticas de forma centralizada.</p>
        </div>

        <!-- Grade de Atalhos Rápidos (Cards) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            
            <!-- Card: Jogos -->
           <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center font-bold text-lg mb-4">📅</div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Jogos e Partidas</h3>
                    <p class="text-gray-500 text-sm">Consulte o calendário, placares em tempo real e linha do tempo dos gols.</p>
                </div>
                
                <!-- Botões de Ação (Consulta e Novo Jogo) -->
                <div class="mt-6 flex space-x-2">
                    <a href="{{ route('jogos.consultar') }}" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-3 rounded-lg text-xs transition">
                        Consultar
                    </a>
                    <a href="{{ route('jogos.create') }}" class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-3 rounded-lg text-xs transition">
                        Novo Jogo
                    </a>
                </div>
            </div>

            <!-- Card: Campeonatos -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 bg-green-50 text-green-600 rounded-lg flex items-center justify-center font-bold text-lg mb-4">🏆</div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Campeonatos</h3>
                    <p class="text-gray-500 text-sm">Cadastre novos campeonatos e gerencie suas respetivas temporadas/edições.</p>
                </div>
                <div class="mt-6 flex space-x-2">
                    <!-- Ajuste as rotas conforme os nomes definidos no seu web.php -->
                    <a href="{{ route('campeonatos.create') }}" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-3 rounded-lg text-xs transition">
                        Novo Campeonato
                    </a>
                    <a href="{{ route('edicoes.create') }}" class="flex-1 text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-3 rounded-lg text-xs transition">
                        Nova Edição
                    </a>
                </div>
            </div>

            <!-- Card: Times -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 bg-yellow-50 text-yellow-600 rounded-lg flex items-center justify-center font-bold text-lg mb-4">🛡️</div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Times e Clubes</h3>
                    <p class="text-gray-500 text-sm">Registo de equipes participantes e clubes parceiros.</p>
                </div>
                <div class="mt-6">
                    <a href="{{ route('times.create') }}" class="inline-block w-full text-center bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded-lg text-sm transition">
                        Gerenciar Times
                    </a>
                </div>
            </div>

            <!-- Card: Jogadores -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center font-bold text-lg mb-4">👤</div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Jogadores</h3>
                    <p class="text-gray-500 text-sm">Banco de atletas integrados com busca rápida (Tom Select).</p>
                </div>
                <div class="mt-6">
                    <a href="{{ route('jogadores.create') }}" class="inline-block w-full text-center bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded-lg text-sm transition">
                        Gerenciar Jogadores
                    </a>
                </div>
            </div>

            <!-- Card: Estádios -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 bg-red-50 text-red-600 rounded-lg flex items-center justify-center font-bold text-lg mb-4">🏟️</div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Estádios</h3>
                    <p class="text-gray-500 text-sm">Locais de realização das partidas oficiais.</p>
                </div>
                <div class="mt-6">
                    <a href="{{ route('estadios.create') }}" class="inline-block w-full text-center bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded-lg text-sm transition">
                        Gerenciar Estádios
                    </a>
                </div>
            </div>

        </div>

    </main>

</body>
</html>