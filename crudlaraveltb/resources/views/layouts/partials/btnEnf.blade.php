@include('layouts.partials.essentials')
<!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Adicionar/Editar Atendimento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="infoForm">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="pessoas">Aluno Atendido</label>
                        <input type="text" class="form-control" id="pessoas" name="pessoas" required>
                    </div>

                    <div class="form-floating mb-3">
                        <select id="curso" class="form-select" name="curso" required>
                            <!-- As opções são preenchidas via JavaScript -->
                        </select>
                        <label for="curso">Curso</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="turma" class="form-select" name="turma" required>
                            <!-- As opções são preenchidas via JavaScript -->
                        </select>
                        <label for="turma">Turma</label>
                    </div>
                    <div class="form-group">
                        <label for="data">Data</label>
                        <input type="date" class="form-control" id="data" name="data" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Concluído">Concluído</option>
                            <option value="Em progresso">Em progresso</option>
                            <option value="Pendente">Pendente</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/dropdown.js') }}"></script>

<script>
    document.getElementById('infoForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        const enfermariaId = this.getAttribute('data-id'); // Obtém o ID do aluno do atributo data-id

        const url = enfermariaId ? `/enfermaria/${enfermariaId}` :
        '{{ route('enfermaria.store') }}'; // URL para PUT ou POST
        const method = enfermariaId ? 'PUT' : 'POST'; // Método para PUT ou POST

        fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    titulo: formData.get('titulo'),
                    descricao: formData.get('descricao'),
                    pessoas: formData.get('pessoas'),
                    turma: formData.get('turma'),
                    data: formData.get('data'),
                    status: formData.get('status'),
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Atendimento salvo com sucesso!' || data.message ===
                    'Atendimento atualizada com sucesso!') {
                    if (enfermariaId) {
                        updateEnfermaria(enfermariaId, {
                            titulo: formData.get('titulo'),
                            descricao: formData.get('descricao'),
                            pessoas: formData.get('pessoas'),
                            turma: formData.get('turma'),
                            data: formData.get('data'),
                            status: formData.get('status'),
                            
                        });
                    } else {
                        renderEnfermaria({
                            id: data.id,
                            titulo: formData.get('titulo'),
                            descricao: formData.get('descricao'),
                            pessoas: formData.get('pessoas'),
                            turma: formData.get('turma'),
                            data: formData.get('data'),
                            status: formData.get('status'),
                        });
                    }

                    const infoModal = bootstrap.Modal.getInstance(document.getElementById('infoModal'));
                    
                    infoModal.hide();
                    document.getElementById('infoForm').reset();
                    document.getElementById('infoForm').removeAttribute('data-id');
                    document.querySelector('.btn-danger')?.remove();
                     // Remove o botão de excluir se existir
                }
            })
            .catch(error => console.error('Erro:', error));
            location.reload();
    });

    function renderEnfermaria(enfermaria) {
        const infoBox = document.createElement('div');
        infoBox.className = 'aluno-card rounded text-center border border-dark border-2 excesso';
        infoBox.setAttribute('data-id', enfermaria.id);

        infoBox.innerHTML = `
            <div class="d-flex justify-content-end">
                <button class="btn btn-sm btn-warning m-2" onclick="editEnfermaria(${enfermaria.id})">Editar</button>
            </div>
                <p><strong>Título:</strong> ${enfermaria.titulo}</p>
                <p><strong>Descrição:</strong> ${enfermaria.descricao}</p>
                <p><strong>Alunos atendidos:</strong> ${enfermaria.pessoas}</p>
                <p><strong>Turma:</strong> ${enfermaria.turma}</p>
                <p><strong>Data:</strong> ${enfermaria.data}</p>
                <p><strong>Status:</strong> ${enfermaria.status}</p>
        `;

        document.getElementById('enfermariaContainer').appendChild(infoBox);
    }

    function updateEnfermaria(id, enfermaria) {
        const card = document.querySelector(`[data-id='${id}']`);
        if (card) {
            card.innerHTML = `
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-warning m-2" onclick="editEnfermaria(${id})">Editar</button>
                </div>
                <p><strong>Título:</strong> ${enfermaria.titulo}</p>
                <p><strong>Descrição:</strong> ${enfermaria.descricao}</p>
                <p><strong>Alunos atendidos:</strong> ${enfermaria.pessoas}</p>
                <p><strong>Turma:</strong> ${enfermaria.turma}</p>
                <p><strong>Data:</strong> ${enfermaria.data}</p>
                <p><strong>Status:</strong> ${enfermaria.status}</p>
            `;
        }
    }

    function editEnfermaria(id) {
    fetch(`/enfermaria/${id}/edit`)
        .then(response => response.json())
        .then(enfermaria => {
            document.getElementById('titulo').value = enfermaria.titulo;
            document.getElementById('descricao').value = enfermaria.descricao;
            document.getElementById('pessoas').value = enfermaria.pessoas;
            document.getElementById('turma').value = enfermaria.turma;

            // Certifique-se de que a data está no formato correto (YYYY-MM-DD)
            const dataFormatada = new Date(enfermaria.data).toISOString().split('T')[0];
            document.getElementById('data').value = dataFormatada;

            document.getElementById('status').value = enfermaria.status;

            // Remove qualquer botão de excluir existente antes de adicionar um novo
            const existingDeleteButton = document.querySelector('.btn-danger');
            if (existingDeleteButton) {
                existingDeleteButton.remove(); // Remove o botão existente se já houver
            }

            // Adiciona o botão de excluir ao final do formulário
            const deleteButton = `
                <button type="button" class="btn btn-danger" onclick="deleteEnfermaria(${id})">Excluir</button>
            `;
            document.getElementById('infoForm').insertAdjacentHTML('beforeend', deleteButton);

            document.getElementById('infoForm').setAttribute('data-id', id);

            const infoModal = new bootstrap.Modal(document.getElementById('infoModal'));
            infoModal.show();
        })
        .catch(error => console.error('Erro:', error));
}



function deleteEnfermaria(id) {
    if (confirm('Tem certeza que deseja excluir este atendimento?')) {
        fetch(`/enfermaria/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(errorData => {
                        throw new Error(errorData.message || 'Erro ao excluir');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.message === 'Atendimento excluída com sucesso!') {
                    const card = document.querySelector(`[data-id='${id}']`);
                    if (card) {
                        card.remove();
                    }
                    const infoModal = bootstrap.Modal.getInstance(document.getElementById('infoModal'));
                    infoModal.hide();
                    
                }
                location.reload();
            })
            .catch(error => console.error('Erro:', error));
    }
}


    document.getElementById('infoModal').addEventListener('hidden.bs.modal', function() {
        const backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(backdrop => backdrop.remove());
        document.body.classList.remove('modal-open');
        document.body.style.removeProperty('padding-right');
    });
</script>




                                
