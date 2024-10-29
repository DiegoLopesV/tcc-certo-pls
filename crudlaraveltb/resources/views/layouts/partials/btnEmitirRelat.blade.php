<!-- Modal -->
<div class="modal fade" id="relatorio" tabindex="-1" aria-labelledby="relatorioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="relatorioLabel">Emitir Relatório</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="relatorioForm" method="GET" action="{{ route('ocorrencias.pdf') }}">
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Data</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Emitir</button>
                </form>
            </div>
        </div>
    </div>
</div>








<script>
document.getElementById('relatorioForm').addEventListener('submit', function(event) {
event.preventDefault();

// Obtém os valores do formulário
const date = document.getElementById('date').value;


// Cria o novo retângulo de informação
const infoBox = document.createElement('button');
infoBox.className = 'info-box expand-btn d-flex border border-dark border-1 border rounded-2 my-2 w-100 fs-3 text-wrap fw-bold align-items-center justify-content-center text-center';
infoBox.innerHTML = `

    <span><strong>Data:</strong> ${date}</span>

    <button class="btn expand-btn"><i class=" test fa-solid fa-maximize ms-3 "></i></button>

`;

// Adiciona o evento de clique ao botão de ampliar
infoBox.querySelector('.expand-btn').addEventListener('click', function() {
    infoBox.classList.toggle('expanded');
});

// Adiciona o novo retângulo ao container
document.getElementById('ocorrenciaContainer').appendChild(infoBox);

// Fecha o modal
('#relatorio').modal('hide');

// Limpa o formulário
document.getElementById('relatorioForm').reset();
});
</script>