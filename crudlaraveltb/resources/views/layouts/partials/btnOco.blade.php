<!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Adicionar/Editar Ocorrência</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="infoForm" data-store-url="{{ route('ocorrencias.store') }}">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                    </div>
                    <div id="participantsContainer" class="form-group mb-3">
                        <div class="participant-group" id="participant-0">
                            <h4>Participante 1</h4>
                            <label for="nome-0">Nome:</label>
                            <input type="text" name="participantes[0][nome]" id="nome-0" required>
                            <br>
                            <label for="curso-0">Curso:</label>
                            <select name="participantes[0][curso]" id="curso-0" required onchange="updateTurmas(0)">
                                <option value="">Selecione o Curso</option>
                            </select>
                            <br>
                            <label for="turma-0">Turma:</label>
                            <select name="participantes[0][turma]" id="turma-0" required>
                                <option value="">Selecione a Turma</option>
                            </select>
                        </div>
                        <button type="button" id="addParticipantBtn" class="btn btn-primary mt-3">Adicionar Mais Participantes</button>
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
let participantCount = 1;

document.getElementById("addParticipantBtn").addEventListener("click", () => {
    const container = document.getElementById("participantsContainer");

    // Cria um novo grupo de inputs para um participante
    const participantGroup = document.createElement("div");
    participantGroup.className = "participant-group";

    const cursoId = `curso-${participantCount}`;
    const turmaId = `turma-${participantCount}`;

    participantGroup.innerHTML = `
        <h4>Participante ${participantCount + 1}</h4>
        <label for="nome-${participantCount}">Nome:</label>
        <input type="text" name="participantes[${participantCount}][nome]" id="nome-${participantCount}" required>
        
        <label for="${cursoId}">Curso:</label>
        <select name="participantes[${participantCount}][curso]" id="${cursoId}" required onchange="updateTurmas(${participantCount})">
            <option value="">Selecione o Curso</option>
        </select>
        
        <label for="${turmaId}">Turma:</label>
        <select name="participantes[${participantCount}][turma]" id="${turmaId}" required>
            <option value="">Selecione a Turma</option>
        </select>
        
        <button type="button" class="remove-btn" onclick="removeParticipant(this)">Remover</button>
    `;

    container.appendChild(participantGroup);

    // Preenche os dropdowns de curso (de acordo com o script 'dropdown.js' que você já tem)
    populateCursos(cursoId); // Preenche todos os cursos

    // Incrementa o contador de participantes
    participantCount++;
});

function removeParticipant(button) {
    button.parentElement.remove();
}

// Função para atualizar as turmas de acordo com o curso selecionado
function updateTurmas(participantIndex) {
    const cursoSelect = document.getElementById(`curso-${participantIndex}`);
    const turmaSelect = document.getElementById(`turma-${participantIndex}`);
    
    // Verifica se o curso foi selecionado
    if (cursoSelect && turmaSelect) {
        const cursoValue = cursoSelect.value;
        
        // Limpa as opções de turma
        turmaSelect.innerHTML = '<option value="">Selecione a Turma</option>';

        if (cursoValue) {
            // Aqui, você pode fazer a lógica para preencher o dropdown de turmas com base no curso
            updateTurmasDropdown(cursoValue, turmaSelect);
        }
    }
}

// Função para preencher o dropdown de turmas (como já está implementado no seu 'dropdown.js')
function updateTurmasDropdown(curso, turmaSelect) {
    // Lógica para atualizar as turmas com base no curso
    // Exemplo: se curso for 'Informática', adicionar as turmas correspondentes
    let turmas = [];

    // Aqui você preenche com base nos cursos que você tem
    if (curso === 'Informática') {
        turmas = ['Info 1', 'Info 2', 'Info 3'];
    } else if (curso === 'Administração') {
        turmas = ['Adm 1', 'Adm 2'];
    }

    // Preenche o dropdown de turmas
    turmas.forEach(turma => {
        const option = document.createElement('option');
        option.value = turma;
        option.textContent = turma;
        turmaSelect.appendChild(option);
    });
}

function openEditModal(ocorrenciaData) {
    const form = document.getElementById('infoForm');
    // Preencher os campos do formulário com os dados da ocorrência
    form.querySelector('#titulo').value = ocorrenciaData.titulo;
    form.querySelector('#descricao').value = ocorrenciaData.descricao;
    form.querySelector('#data').value = ocorrenciaData.data;
    form.querySelector('#status').value = ocorrenciaData.status;

    // Preenche os participantes
    ocorrenciaData.participantes.forEach((participant, index) => {
        if (index > 0) {
            // Adiciona novos participantes se houver mais de um
            document.getElementById("addParticipantBtn").click();
        }

        // Preenche os campos do participante
        const participante = document.getElementById(`participant-${index}`);
        participante.querySelector(`#nome-${index}`).value = participant.nome;
        participante.querySelector(`#curso-${index}`).value = participant.curso;
        participante.querySelector(`#turma-${index}`).value = participant.turma;

        // Carrega as turmas baseadas no curso
        updateTurmas(index);
    });

    // Exibe o modal
    const modal = new bootstrap.Modal(document.getElementById('infoModal'));
    modal.show();
}
</script>

<script src="{{ asset('assets/js/dropdown.js') }}"></script>
