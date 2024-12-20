<!-- Dropdown com opções de ordenação -->
<div id="ordenarDropdown" style="display:none; position: absolute; border: 1px solid #ccc; background-color: #fff; z-index: 1000;">
    <a href="#" class="dropdown-item ordenar-opcao" data-ordem="recentes" style="display: block; padding: 8px;">Mais recente</a>
    <a href="#" class="dropdown-item ordenar-opcao" data-ordem="antigos" style="display: block; padding: 8px;">Mais antigo</a>
    <a href="#" class="dropdown-item ordenar-opcao" data-ordem="alfabetica" style="display: block; padding: 8px;">Ordem alfabética</a>
</div>

<script>
// Mostrar/ocultar dropdown ao clicar no link de ordenar
document.getElementById('ordenarLink').addEventListener('click', function(event) {
    event.preventDefault();
    const dropdown = document.getElementById('ordenarDropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';

    // Posicionar o dropdown logo abaixo do link
    const rect = this.getBoundingClientRect();
    dropdown.style.left = `${rect.left}px`;
    dropdown.style.top = `${rect.bottom}px`;
});

// Fechar o dropdown ao clicar fora dele
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('ordenarDropdown');
    if (!dropdown.contains(event.target) && event.target.id !== 'ordenarLink') {
        dropdown.style.display = 'none';
    }
});

// Função para ordenar os cards
function ordenarCards(ordem) {
    const container = document.getElementById('enfermariaContainer');
    const cards = Array.from(container.getElementsByClassName('enfermaria-card'));

    if (ordem === 'recentes') {
        // Ordenar por data, mais recente primeiro
        cards.sort((a, b) => new Date(b.getAttribute('data-created')) - new Date(a.getAttribute('data-created')));
    } else if (ordem === 'antigos') {
        // Ordenar por data, mais antigo primeiro
        cards.sort((a, b) => new Date(a.getAttribute('data-created')) - new Date(b.getAttribute('data-created')));
    } else if (ordem === 'alfabetica') {
        // Ordenar por título em ordem alfabética
        cards.sort((a, b) => a.getAttribute('data-title').localeCompare(b.getAttribute('data-title')));
    }

    // Atualizar a lista no DOM com a nova ordem
    container.innerHTML = '';
    cards.forEach(card => container.appendChild(card));
}

// Adiciona o evento de ordenação para cada opção do dropdown
document.querySelectorAll('.ordenar-opcao').forEach(opcao => {
    opcao.addEventListener('click', function(event) {
        event.preventDefault();
        const ordem = this.getAttribute('data-ordem');
        ordenarCards(ordem);
        document.getElementById('ordenarDropdown').style.display = 'none';
    });
});
</script>
