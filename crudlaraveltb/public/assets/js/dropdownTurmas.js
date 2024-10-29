// Dados das turmas
const turmas = [
    'Info 1', 'Info 2', 'Info 3', 'Info 4',
    'Pg 1', 'Pg 2', 'Pg 3',
    'Adm 1', 'Adm 2', 'Adm 3',
    'Jogos 1', 'Jogos 2', 'Jogos 3', 'Jogos 4',
    'Mecânica 1', 'Mecânica 2', 'Mecânica 3',
    'Eletrônica 1', 'Eletrônica 2', 'Eletrônica 3',
    'Contabilidade 1', 'Contabilidade 2', 'Contabilidade 3',
    'Pf 1', 'Pf 2', 'Pf 3',
];

// Preencher dropdown de turmas
function populateTurmas(dropdownId) {
    const turmaDropdown = document.getElementById(dropdownId);
    turmaDropdown.innerHTML = '<option value="">Selecione a Turma</option>'; // Limpa as opções anteriores

    turmas.forEach(turma => {
        const option = document.createElement('option');
        option.value = turma;
        option.textContent = turma;
        turmaDropdown.appendChild(option);
    });
}

// Inicializar dropdown
document.addEventListener('DOMContentLoaded', function() {
    populateTurmas('turma');
});
