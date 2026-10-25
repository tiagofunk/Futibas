// Configuração para busca de times via AJAX
const configTimes = {
    valueField: 'id',
    labelField: 'nome',
    searchField: 'nome',
    placeholder: 'Digite o nome do time...',
    load: function(query, callback) {
        if (!query.length) return callback();
        fetch(`/times?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(json => callback(json))
            .catch(() => callback());
    }
};

// Configuração para busca de estádios via AJAX
const configEstadios = {
    valueField: 'id',
    labelField: 'nome',
    searchField: ['nome', 'cidade'],
    placeholder: 'Digite o nome do estádio ou cidade...',
    render: {
        option: function(item, escape) {
            return `<div>${escape(item.nome)} (${escape(item.cidade)})</div>`;
        }
    },
    load: function(query, callback) {
        if (!query.length) return callback();
        fetch(`/estadios?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(json => callback(json))
            .catch(() => callback());
    }
};

document.addEventListener("DOMContentLoaded", function(){
    new TomSelect("#time_mandante_select", configTimes);
    new TomSelect("#time_visitante_select", configTimes);
    new TomSelect("#estadio_select", configEstadios);
});

// Lógica de Filtro em Cascata (Campeonato -> Fases)
const campeonatoSelect = document.getElementById('campeonato_select');
const faseSelect = document.getElementById('fase_select');

campeonatoSelect.addEventListener('change', function() {
    const campeonatoId = this.value;
    faseSelect.value = "";
    faseSelect.querySelectorAll('option').forEach(option => {
        if (option.value === "") return;
        const optionCampeonatoId = option.getAttribute('data-campeonato');
        option.style.display = (!campeonatoId || optionCampeonatoId === campeonatoId) ? "block" : "none";
    });
});