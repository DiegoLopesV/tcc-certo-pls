<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Selecionar Filtros</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulário de Filtros -->
                <form id="filterForm">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Turma A" id="filterTurmaA" name="turmas[]">
                        <label class="form-check-label" for="filterTurmaA">
                            Turma A
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Turma B" id="filterTurmaB" name="turmas[]">
                        <label class="form-check-label" for="filterTurmaB">
                            Turma B
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Turma C" id="filterTurmaC" name="turmas[]">
                        <label class="form-check-label" for="filterTurmaC">
                            Turma C
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="applyFilters">Aplicar Filtros</button>
            </div>
        </div>
    </div>
</div>


<script src="{{ mix('js/app.js') }}"></script>
<script>
    document.getElementById('applyFilters').addEventListener('click', function() {
        const form = document.getElementById('filterForm');
        const formData = new FormData(form);

        let ocorrenciasList = document.getElementById('ocorrenciasList');
        let ocorrencias = [
            { turma: 'Turma A', descricao: 'Ocorrência 1' },
            { turma: 'Turma B', descricao: 'Ocorrência 2' },
            { turma: 'Turma C', descricao: 'Ocorrência 3' }
        ];

        let filtros = Array.from(formData.getAll('turmas[]'));
        let filtradas = ocorrencias.filter(o => filtros.includes(o.turma));

        ocorrenciasList.innerHTML = '';
        filtradas.forEach(o => {
            let li = document.createElement('li');
            li.textContent = `${o.turma}: ${o.descricao}`;
            ocorrenciasList.appendChild(li);
        });

        // Tentar fechar o modal de uma maneira mais direta
        new bootstrap.Modal(document.getElementById('filterModal')).hide();
    });
</script>
