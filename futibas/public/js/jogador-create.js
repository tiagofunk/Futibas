document.addEventListener("DOMContentLoaded", function () {
    // Array com as principais nacionalidades/países
    const nacionalidades = [
        "Afeganistão", "África do Sul", "Albânia", "Alemanha", "Andorra", "Angola", 
        "Antígua e Barbuda", "Arábia Saudita", "Argélia", "Argentina", "Armênia", "Austrália",
        "Áustria", "Azerbaijão", "Bahamas", "Bahrein", "Bangladesh", "Barbados",
        "Bielorrússia", "Bélgica", "Belize", "Benim", "Butão", "Bolívia",
        "Bósnia e Herzegovina", "Botsuana", "Brasil", "Brunei", "Bulgária",
        "Burquina Faso", "Burúndi", "Cabo Verde", "Camarões", "Camboja", "Canadá",
        "Catar", "Cazaquistão", "Chade", "Chile", "China", "Chipre", "Singapura",
        "Colômbia", "Comores", "Coreia do Norte", "Coreia do Sul", "Costa do Marfim",
        "Costa Rica", "Croácia", "Cuba", "Dinamarca", "Djibuti", "Dominica", "Escócia", "Egito",
        "El Salvador", "Emirados Árabes Unidos", "Eritreia", "Eslováquia", "Eslovênia",
        "Espanha", "Estados Unidos", "Estônia", "Essuatíni", "Etiópia", "Fiji", "Filipinas",
        "Finlândia", "França", "Gabão", "Gâmbia", "Gana", "Geórgia", "Granada", "Grécia",
        "Guatemala", "Guiné", "Guiné-Bissau", "Guiné Equatorial", "Guiana", "Haiti",
        "Honduras", "Hungria", "Iêmen", "Ilhas Marshall", "Índia", "Indonésia", "Irã", "Iraque",
        "Irlanda", "Islândia", "Israel", "Itália", "Jamaica", "Japão", "Jordânia", "Kuwait",
        "Laos", "Lesoto", "Letônia", "Líbano", "Libéria", "Líbia", "Liechtenstein", "Lituânia",
        "Luxemburgo", "Macedônia do Norte", "Madagascar", "Malásia", "Maláui", "Maldivas",
        "Mali", "Malta", "Marrocos", "Maurício", "Mauritânia", "México", "Micronésia",
        "Moçambique", "Moldávia", "Mônaco", "Mongólia", "Montenegro", "Namíbia", "Nauru",
        "Nepal", "Nicarágua", "Níger", "Nigéria", "Noruega", "Nova Zelândia", "Omã",
        "Países Baixos", "Paquistão", "Palau", "Palestina", "Panamá", "Papua-Nova Guiné",
        "Paraguai", "Peru", "Polônia", "Portugal", "Quênia", "Quirguistão", "Quiribati",
        "Reino Unido", "República Centro-Africana", "República Checa",
        "República Democrática do Congo", "República do Congo",
        "República Dominicana", "Romênia", "Ruanda", "Rússia", "Ilhas Salomão",
        "Samoa", "Santa Lúcia", "São Cristóvão e Neves", "São Marino",
        "São Tomé e Príncipe", "São Vicente e Granadinas", "Seicheles", "Senegal",
        "Serra Leoa", "Sérvia", "Síria", "Somália", "Sri Lanka", "Sudão", "Sudão do Sul",
        "Suécia", "Suíça", "Suriname", "Tailândia", "Tajiquistão", "Tanzânia", "Timor-Leste",
        "Togo", "Tonga", "Trinidade e Tobago", "Tunísia", "Turquemenistão", "Turquia",
        "Tuvalu", "Ucrânia", "Uganda", "Uruguai", "Uzbequistão", "Vanuatu", "Vaticano",
        "Vietnã", "Zâmbia", "Zimbábue"
    ];

    const select = document.getElementById('nacionalidades_select');

    if (select) {

        nacionalidades.forEach(nacionalidade => {
            const option = document.createElement('option');
            option.value = nacionalidade;
            option.textContent = nacionalidade;
            select.appendChild(option);
        });

        // Inicializa o Tom Select permitindo múltiplas seleções e criação de novas tags
        new TomSelect("#nacionalidades_select", {
            create: true,
            placeholder: "Selecione ou digite as nacionalidades..."
        });
    }
});