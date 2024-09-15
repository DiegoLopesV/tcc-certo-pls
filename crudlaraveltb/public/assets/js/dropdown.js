// Dados das turmas por curso
const turmasPorCurso = {
    'Informática': ['Info 1', 'Info 2', 'Info 3', 'Info 4'],
    'Pg': ['Pg 1', 'Pg 2', 'Pg 3'],
    'Adm': ['Adm 1', 'Adm 2', 'Adm 3'],
    'Jogos': ['Jogos 1', 'Jogos 2', 'Jogos 3', 'Jogos 4'],
    'Mecânica': ['Mecânica 1', 'Mecânica 2', 'Mecânica 3'],
    'Eletrônica': ['Eletrônica 1', 'Eletrônica 2', 'Eletrônica 3'],
    'Contabilidade': ['Contabilidade 1', 'Contabilidade 2', 'Contabilidade 3'],
    'Pf': ['Pf 1', 'Pf 2', 'Pf 3'],
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
