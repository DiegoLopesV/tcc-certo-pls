// Dados das turmas por curso
const turmasPorCurso = {
    'Informática': ['Info 1', 'Info 2', 'Info 3', 'Info 4'],
    'PG': ['PG 1', 'PG 2', 'PG 3'],
    'ADM': ['ADM 1', 'ADM 2', 'ADM 3'],
    'Jogos': ['Jogos 1', 'Jogos 2', 'Jogos 3', 'Jogos 4'],
    'Mecânica': ['Mecânica 1', 'Mecânica 2'],
    'Eletrônica': ['Eletrônica 1', 'Eletrônica 2'],
    'Contabilidade': ['Contabilidade 1', 'Contabilidade 2'],
    'Processos Fotográficos': ['Processos Fotográficos 1', 'Processos Fotográficos 2'],
};

// Preencher dropdown de cursos
function populateCursos(dropdownId) {
    const cursoDropdown = document.getElementById(dropdownId);
    cursoDropdown.innerHTML = '<option value="">Selecione o Curso</option>'; // Limpa as opções anteriores

    Object.keys(turmasPorCurso).forEach(curso => {
        const option = document.createElement('option');
        option.value = curso;
        option.textContent = curso;
        cursoDropdown.appendChild(option);
    });
}

// Atualizar dropdown de turmas com base no curso selecionado
function updateTurmasDropdown(cursoDropdownId, turmaDropdownId) {
    const cursoDropdown = document.getElementById(cursoDropdownId);
    const turmaDropdown = document.getElementById(turmaDropdownId);
    
    cursoDropdown.addEventListener('change', function() {
        const turmaSelecionada = turmaDropdown.querySelector('option[selected]');
        if (turmaSelecionada) turmaSelecionada.removeAttribute('selected'); // Remove seleção anterior

        turmaDropdown.innerHTML = '<option value="">Selecione a Turma</option>'; // Limpa as opções anteriores

        const cursoSelecionado = this.value;
        if (cursoSelecionado && turmasPorCurso[cursoSelecionado]) {
            turmasPorCurso[cursoSelecionado].forEach(turma => {
                const option = document.createElement('option');
                option.value = turma;
                option.textContent = turma;
                turmaDropdown.appendChild(option);
            });
        }
    });
}

// Inicializar dropdowns
document.addEventListener('DOMContentLoaded', function() {
    populateCursos('curso');
    updateTurmasDropdown('curso', 'turma');
});
