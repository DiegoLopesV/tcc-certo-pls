<!-- Dropdown com opções de ordenação -->
<div id="ordenarDropdown" style="display:none; position: absolute; border: 1px solid #ccc; background-color: #fff; z-index: 1000;">
    <a href="#" class="dropdown-item ordenar-opcao" data-ordem="recentes" style="display: block; padding: 8px;">Mais recente</a>
    <a href="#" class="dropdown-item ordenar-opcao" data-ordem="antigos" style="display: block; padding: 8px;">Mais antigo</a>
    <a href="#" class="dropdown-item ordenar-opcao" data-ordem="alfabetica" style="display: block; padding: 8px;">Ordem alfabética</a>
</div>


<script>
        document.getElementById('ordenarLink').addEventListener('click', function (event) {
    event.preventDefault(); // Impede o comportamento padrão do link
    var dropdown = document.getElementById('ordenarDropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
});

// Evento para ordenação
const ordenarOpcoes = document.querySelectorAll('.ordenar-opcao');
ordenarOpcoes.forEach(opcao => {
    opcao.addEventListener('click', function (event) {
        event.preventDefault();
        const ordem = this.getAttribute('data-ordem');
        const cards = Array.from(document.querySelectorAll('.enfermaria-card'));

        // Ordena os cards de acordo com a opção
        if (ordem === 'recentes') {
            cards.sort((a, b) => new Date(b.getAttribute('data-created')) - new Date(a.getAttribute('data-created')));
        } else if (ordem === 'antigos') {
            cards.sort((a, b) => new Date(a.getAttribute('data-created')) - new Date(b.getAttribute('data-created')));
        } else if (ordem === 'alfabetica') {
            cards.sort((a, b) => {
                const titleA = a.getAttribute('data-title').toLowerCase();
                const titleB = b.getAttribute('data-title').toLowerCase();
                return titleA.localeCompare(titleB);
            });
        }

        // Reorganiza os cards no container correto
        const container = document.getElementById('enfermariaContainer');
        cards.forEach(card => container.appendChild(card)); // Atualiza a ordem

        // Fecha o dropdown
        document.getElementById('ordenarDropdown').style.display = 'none';
    });
});

</script>
