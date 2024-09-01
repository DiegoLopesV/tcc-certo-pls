@include('layouts.partials.essentials')
<!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Adicionar/Editar Ocorrência</h5>
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
                    <div class="form-group">
                        <label for="participantes">Participantes</label>
                        <input type="text" class="form-control" id="participantes" name="participantes" required>
                    </div>
                    <div class="form-group">
                        <label for="turma">Turma</label>
                        <input type="text" class="form-control" id="turma" name="turma" required>
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

<script>
    document.getElementById('infoForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        const ocorrenciaId = this.getAttribute('data-id'); // Obtém o ID do aluno do atributo data-id

        const url = ocorrenciaId ? `/ocorrencia/${ocorrenciaId}` :
        '{{ route('ocorrencias.store') }}'; // URL para PUT ou POST
        const method = ocorrenciaId ? 'PUT' : 'POST'; // Método para PUT ou POST

        fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    titulo: formData.get('titulo'),
                    descricao: formData.get('descricao'),
                    participantes: formData.get('participantes'),
                    turma: formData.get('turma'),
                    data: formData.get('data'),
                    status: formData.get('status'),
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Ocorrencia salva com sucesso!' || data.message ===
                    'Ocorrencia atualizada com sucesso!') {
                    if (ocorrenciaId) {
                        updateOcorrencia(ocorrenciaId, {
                            titulo: formData.get('titulo'),
                            descricao: formData.get('descricao'),
                            participantes: formData.get('participantes'),
                            turma: formData.get('turma'),
                            data: formData.get('data'),
                            status: formData.get('status'),
                        });
                    } else {
                        renderOcorrencia({
                            id: data.id,
                            titulo: formData.get('titulo'),
                            descricao: formData.get('descricao'),
                            participantes: formData.get('participantes'),
                            turma: formData.get('turma'),
                            data: formData.get('data'),
                            status: formData.get('status'),
                        });
                    }

                    const infoModal = bootstrap.Modal.getInstance(document.getElementById('infoModal'));
                    infoModal.hide();
                    document.getElementById('infoForm').reset();
                    document.getElementById('infoForm').removeAttribute('data-id');
                    document.querySelector('.btn-danger')?.remove(); // Remove o botão de excluir se existir
                }
            })
            .catch(error => console.error('Erro:', error));
    });

    function renderOcorrencia(ocorrencia) {
        const infoBox = document.createElement('div');
        infoBox.className = 'aluno-card rounded text-center border border-dark border-2 excesso';
        infoBox.setAttribute('data-id', ocorrencia.id);

        infoBox.innerHTML = `
            <div class="d-flex justify-content-end">
                <button class="btn btn-sm btn-warning m-2" onclick="editOcorrencia(${ocorrencia.id})">Editar</button>
            </div>
                <p><strong>Título:</strong> ${ocorrencia.titulo}</p>
                <p><strong>Descrição:</strong> ${ocorrencia.descricao}</p>
                <p><strong>Participantes:</strong> ${ocorrencia.participantes}</p>
                <p><strong>Turma:</strong> ${ocorrencia.turma}</p>
                <p><strong>Data:</strong> ${ocorrencia.data}</p>
                <p><strong>Status:</strong> ${ocorrencia.status}</p>
        `;

        document.getElementById('ocorrenciaContainer').appendChild(infoBox);
    }

    function updateOcorrencia(id, ocorrencia) {
        const card = document.querySelector(`[data-id='${id}']`);
        if (card) {
            card.innerHTML = `
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-warning m-2" onclick="editOcorrencia(${id})">Editar</button>
                </div>
                <p><strong>Título:</strong> ${ocorrencia.titulo}</p>
                <p><strong>Descrição:</strong> ${ocorrencia.descricao}</p>
                <p><strong>Participantes:</strong> ${ocorrencia.participantes}</p>
                <p><strong>Turma:</strong> ${ocorrencia.turma}</p>
                <p><strong>Data:</strong> ${ocorrencia.data}</p>
                <p><strong>Status:</strong> ${ocorrencia.status}</p>
            `;
        }
    }

    function editOcorrencia(id) {
        fetch(`/ocorrencias/${id}/edit`)
            .then(response => response.json())
            .then(ocorrencia => {
                document.getElementById('titulo').value = ocorrencia.titulo;
                document.getElementById('descricao').value = ocorrencia.descricao;
                document.getElementById('participantes').value = ocorrencia.participantes;
                document.getElementById('turma').value = ocorrencia.turma;
                document.getElementById('data').value = ocorrencia.data;
                document.getElementById('status').value = ocorrencia.status;

                let deleteButton = document.querySelector('.btn-danger');
                if (!deleteButton) {
                    deleteButton =
                    `<button type="button" class="btn btn-danger" onclick="deleteOcorrencia(${id})">Excluir</button>`;
                    document.getElementById('infoForm').insertAdjacentHTML('beforeend', deleteButton);
                }

                document.getElementById('infoForm').setAttribute('data-id', id);

                const infoModal = new bootstrap.Modal(document.getElementById('infoModal'));
                infoModal.show();
            })
            .catch(error => console.error('Erro:', error));
    }

    function deleteOcorrencia(id) {
        if (confirm('Tem certeza que deseja excluir esta ocorrencia?')) {
            fetch(`/ocorrencias/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'Ocorrencia excluída com sucesso!') {
                        const card = document.querySelector(`[data-id='${id}']`);
                        if (card) {
                            card.remove();
                        }
                        const infoModal = bootstrap.Modal.getInstance(document.getElementById('infoModal'));
                        infoModal.hide();
                    }
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


<!--                

                                
