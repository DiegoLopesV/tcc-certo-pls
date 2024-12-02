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
                            <select name="participantes[0][curso]" id="curso-0" required></select>
                            <br>
                            <label for="turma-0">Turma:</label>
                            <select name="participantes[0][turma]" id="turma-0" required></select>
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

// Inicializar primeiro dropdown no carregamento da página
document.addEventListener('DOMContentLoaded', function () {
    populateCursos('curso-0');
    updateTurmasDropdown('curso-0', 'turma-0');
});

// Adicionar novo participante dinamicamente
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
        <select name="participantes[${participantCount}][curso]" id="${cursoId}" required></select>
        
        <label for="${turmaId}">Turma:</label>
        <select name="participantes[${participantCount}][turma]" id="${turmaId}" required></select>
        
        <button type="button" class="remove-btn" onclick="removeParticipant(this)">Remover</button>
    `;

    container.appendChild(participantGroup);

    // Preenche os dropdowns de curso e configura atualização das turmas
    populateCursos(cursoId);
    updateTurmasDropdown(cursoId, turmaId);

    participantCount++;
});

function removeParticipant(button) {
    button.parentElement.remove();
}
</script>

<script src="{{ asset('assets/js/dropdown.js') }}"></script>
<script src="{{ asset('assets/js/dropdownTurmas.js') }}"></script>
