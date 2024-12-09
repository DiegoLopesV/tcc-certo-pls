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
                        <label for="responsavel">Responsável</label>
                        <input type="text" class="form-control" id="responsavel" name="responsavel" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="pessoas">Aluno Atendido</label>
                        <input type="text" class="form-control" id="pessoas" name="pessoas" required>
                    </div>
                    <div class="form-group">
                        <label for="idade">Idade</label>
                        <input type="text" class="form-control" id="idade" name="idade" required>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="turma" class="form-select" name="turma" required>
                            <!-- As opções são preenchidas via JavaScript -->
                        </select>
                        <label for="turma">Turma</label>
                    </div>

                    <div class="form-group">
                        <label for="horaInicio">Hora Início</label>
                        <input type="text" class="form-control" id="horaInicio" name="horaInicio" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="horaFinal">Horário de Término</label>
                        <input type="text" class="form-control" id="horaFinal" name="horaFinal" required>
                    </div>
                    <div class="form-group">
                        <label for="queixa">Queixa</label>
                        <textarea type="text" class="form-control" id="queixa" name="queixa"  rows="2" required> </textarea>
                    </div>
                    <div class="form-group">
                        <label for="atividade_realizada">Atividade Realizada</label>
                        <textarea type="text" class="form-control" id="atividade_realizada" name="atividade_realizada" rows="2" required> </textarea>
                    </div>
                    <div class="form-group">
                        <label for="conduta">Conduta</label>
                        <textarea type="text" class="form-control" id="conduta" name="conduta" rows="2" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Outras informações/observações</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="2" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="data">Data</label>
                        <input type="date" class="form-control" id="data" name="data" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('assets/js/dropdownTurmas.js') }}"></script>
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
                    responsavel: formData.get('responsavel'),
                    atividade_realizada: formData.get('atividade_realizada'),
                    queixa: formData.get('queixa'),
                    conduta: formData.get('conduta'),
                    descricao: formData.get('descricao'),
                    idade: formData.get('idade'),
                    pessoas: formData.get('pessoas'),
                    turma: formData.get('turma'),
                    data: formData.get('data'),
                    horaInicio: formData.get('horaInicio'),
                    horaFinal: formData.get('horaFinal'),
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Atendimento salvo com sucesso!' || data.message ===
                    'Atendimento atualizada com sucesso!') {
                    if (enfermariaId) {
                        updateEnfermaria(enfermariaId, {
                            titulo: formData.get('titulo'),
                    responsavel: formData.get('responsavel'),
                    atividade_realizada: formData.get('atividade_realizada'),
                    queixa: formData.get('queixa'),
                    conduta: formData.get('conduta'),
                    descricao: formData.get('descricao'),
                    idade: formData.get('idade'),
                    pessoas: formData.get('pessoas'),
                    turma: formData.get('turma'),
                    data: formData.get('data'),
                    horaInicio: formData.get('horaInicio'),
                    horaFinal: formData.get('horaFinal'),
                            
                        });
                    } else {
                        renderEnfermaria({
                            id: data.id,
                            titulo: formData.get('titulo'),
                    responsavel: formData.get('responsavel'),
                    atividade_realizada: formData.get('atividade_realizada'),
                    queixa: formData.get('queixa'),
                    conduta: formData.get('conduta'),
                    descricao: formData.get('descricao'),
                    idade: formData.get('idade'),
                    pessoas: formData.get('pessoas'),
                    turma: formData.get('turma'),
                    data: formData.get('data'),
                    horaInicio: formData.get('horaInicio'),
                    horaFinal: formData.get('horaFinal'),
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
                <p><strong>Responsável:</strong> ${enfermaria.responsavel}</p>
                <p><strong>Aluno Atendido:</strong> ${enfermaria.pessoas}</p>
                <p><strong>Idade:</strong> ${enfermaria.idade}</p>
                <p><strong>Turma:</strong> ${enfermaria.turma}</p>
                <p><strong>Hora de início:</strong> ${enfermaria.horaInicio}</p>
                <p><strong>Hora de Finalização:</strong> ${enfermaria.horaFinal}</p>
                <p><strong>Queixa:</strong> ${enfermaria.queixa}</p>
                <p><strong>Atividade Realizada:</strong> ${enfermaria.atividade_realizada}</p>
                <p><strong>Conduta:</strong> ${enfermaria.conduta}</p>
                <p><strong>Outras informações/observações:</strong> ${enfermaria.descricao}</p>
                <p><strong>Data:</strong> ${enfermaria.data}</p>
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
                <p><strong>Responsável:</strong> ${enfermaria.responsavel}</p>
                <p><strong>Aluno Atendido:</strong> ${enfermaria.pessoas}</p>
                <p><strong>Idade:</strong> ${enfermaria.idade}</p>
                <p><strong>Turma:</strong> ${enfermaria.turma}</p>
                <p><strong>Hora de início:</strong> ${enfermaria.horaInicio}</p>
                <p><strong>Hora de Finalização:</strong> ${enfermaria.horaFinal}</p>
                <p><strong>Queixa:</strong> ${enfermaria.queixa}</p>
                <p><strong>Atividade Realizada:</strong> ${enfermaria.atividade_realizada}</p>
                <p><strong>Conduta:</strong> ${enfermaria.conduta}</p>
                <p><strong>Outras informações/observações:</strong> ${enfermaria.descricao}</p>
                <p><strong>Data:</strong> ${enfermaria.data}</p>
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
            document.getElementById('responsavel').value = enfermaria.responsavel;
            document.getElementById('idade').value = enfermaria.idade;
            document.getElementById('horaInicio').value = enfermaria.horaInicio;
            document.getElementById('horaFinal').value = enfermaria.horaFinal;
            document.getElementById('queixa').value = enfermaria.queixa;
            document.getElementById('atividade_realizada').value = enfermaria.atividade_realizada;
            document.getElementById('conduta').value = enfermaria.conduta;

            // Certifique-se de que a data está no formato correto (YYYY-MM-DD)
            const dataFormatada = new Date(enfermaria.data).toISOString().split('T')[0];
            document.getElementById('data').value = dataFormatada;

            

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




                                
