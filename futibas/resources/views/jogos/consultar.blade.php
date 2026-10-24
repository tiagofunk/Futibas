<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Jogos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10 px-4">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Consultar Jogos por Campeonato e Fase</h2>

        <form action="{{ route('jogos.consultar') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 items-end">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Campeonato:</label>
                <select id="campeonato_select" class="w-full px-3 py-2 border rounded-lg bg-white focus:outline-none focus:ring">
                    <option value="">Selecione o Campeonato...</option>
                    @foreach($campeonatos as $campeonato)
                        <option value="{{ $campeonato->id }}" {{ (isset($faseSelecionada) && $faseSelecionada->edicao->campeonato_id == $campeonato->id) ? 'selected' : '' }}>
                            {{ $campeonato->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Fase / Temporada:</label>
                <select id="fase_select" name="fase_id" class="w-full px-3 py-2 border rounded-lg bg-white focus:outline-none focus:ring" required>
                    <option value="">Selecione a Fase...</option>
                    @foreach($fases as $fase)
                        <option value="{{ $fase->id }}" data-campeonato="{{ $fase->edicao->campeonato_id }}" {{ request('fase_id') == $fase->id ? 'selected' : '' }}>
                            {{ $fase->edicao->temporada }} — {{ $fase->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-600 transition h-[42px]">
                    Consultar
                </button>
            </div>
        </form>

        @if($faseSelecionada)
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700">
                    Jogos de: <span class="text-blue-600">{{ $faseSelecionada->edicao->campeonato->nome }} ({{ $faseSelecionada->edicao->temporada }}) — {{ $faseSelecionada->nome }}</span>
                </h3>
            </div>

            @if($jogos->isEmpty())
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                    Nenhum jogo cadastrado para esta fase até o momento.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 text-left text-sm uppercase font-semibold">
                                <th class="py-3 px-4 border-b">Rodada</th>
                                <th class="py-3 px-4 border-b">Data / Hora</th>
                                <th class="py-3 px-4 border-b text-right">Mandante</th>
                                <th class="py-3 px-4 border-b text-center">vs</th>
                                <th class="py-3 px-4 border-b">Visitante</th>
                                <th class="py-3 px-4 border-b">Estádio</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @foreach($jogos as $jogo)
                                <tr class="hover:bg-gray-50 border-b">
                                    <td class="py-3 px-4 font-bold">{{ $jogo->rodada }}ª</td>
                                    <td class="py-3 px-4">{{ \Carbon\Carbon::parse($jogo->data_hora)->format('d/m/Y H:i') }}</td>
                                    <td class="py-3 px-4 text-right font-medium">{{ $jogo->mandante->nome }}</td>
                                    <td class="py-3 px-4 text-center text-gray-400 font-bold">X</td>
                                    <td class="py-3 px-4 font-medium">{{ $jogo->visitante->nome }}</td>
                                    <td class="py-3 px-4 text-gray-600">{{ $jogo->estadio->nome }} ({{ $jogo->estadio->cidade }})</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif
    </div>

    <script>
        const campeonatoSelect = document.getElementById('campeonato_select');
        const faseSelect = document.getElementById('fase_select');

        function filtrarFases() {
            const campeonatoId = campeonatoSelect.value;
            const faseOptions = faseSelect.querySelectorAll('option');
            
            let primeiraVisivel = true;

            faseOptions.forEach(option => {
                if (option.value === "") {
                    option.style.display = "block";
                    return;
                }

                const optionCampeonatoId = option.getAttribute('data-campeonato');
                if (campeonatoId === "" || optionCampeonatoId === campeonatoId) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                    if (faseSelect.value === option.value) {
                        faseSelect.value = ""; // Reseta a fase se o campeonato mudar
                    }
                }
            });
        }

        campeonatoSelect.addEventListener('change', filtrarFases);

        // Executa ao carregar caso já venha com um campeonato selecionado
        window.addEventListener('DOMContentLoaded', () => {
            if (campeonatoSelect.value) {
                filtrarFases();
                const urlParams = new URLSearchParams(window.location.search);
                const faseId = urlParams.get('fase_id');
                if (faseId) {
                    faseSelect.value = faseId;
                }
            }
        });
    </script>
</body>
</html>