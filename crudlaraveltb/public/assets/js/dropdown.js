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

function populateCursos(dropdownId) {
    const cursoDropdown = typeof dropdownId === 'string' 
        ? document.getElementById(dropdownId) 
        : dropdownId;

    if (!cursoDropdown) {
        console.error(`Dropdown com ID "${dropdownId}" não encontrado.`);
        return;
    }

    cursoDropdown.innerHTML = '<option value="">Selecione o Curso</option>'; // Limpa as opções anteriores

    Object.keys(turmasPorCurso).forEach(curso => {
        const option = document.createElement('option');
        option.value = curso;
        option.textContent = curso;
        cursoDropdown.appendChild(option);
    });
}

function updateTurmasDropdown(cursoDropdownId, turmaDropdownId) {
    const cursoDropdown = typeof cursoDropdownId === 'string' 
        ? document.getElementById(cursoDropdownId) 
        : cursoDropdownId;

    const turmaDropdown = typeof turmaDropdownId === 'string' 
        ? document.getElementById(turmaDropdownId) 
        : turmaDropdownId;

    if (!cursoDropdown || !turmaDropdown) {
        console.error(`Dropdown(s) não encontrado(s). Verifique os IDs: cursoDropdownId=${cursoDropdownId}, turmaDropdownId=${turmaDropdownId}`);
        return;
    }

    cursoDropdown.addEventListener('change', function () {
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

// Inicializar dropdowns em contextos específicos
document.addEventListener('DOMContentLoaded', function () {
    // Contexto: Formulário de Alunos
    const alunoCursoDropdown = document.getElementById('aluno-curso');
    const alunoTurmaDropdown = document.getElementById('aluno-turma');
    populateCursos(alunoCursoDropdown);
    updateTurmasDropdown(alunoCursoDropdown, alunoTurmaDropdown);

    // Contexto: Formulário de Ocorrências
    const firstCursoDropdown = document.getElementById('curso-0');
    const firstTurmaDropdown = document.getElementById('turma-0');
    if (firstCursoDropdown && firstTurmaDropdown) {
        populateCursos(firstCursoDropdown);
        updateTurmasDropdown(firstCursoDropdown, firstTurmaDropdown);
    }
});
