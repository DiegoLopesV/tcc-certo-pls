async function editAluno(id) {
    try {
        const response = await fetch(`/alunos/${id}/edit`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        });

        const data = await response.json();

        if (data) {
            const fields = ['nome', 'curso', 'turma', 'cpf', 'nome_pais', 'telefone', 'telefone_pais', 'email', 'email_pais'];
            
            fields.forEach(field => {
                const element = document.getElementById(field + 'Editar');
                if (element) {
                    element.value = data[field];
                }
            });

            // Remove o botão de excluir antigo, se houver
            const existingDeleteButton = document.querySelector('.btn-danger');
            if (existingDeleteButton) {
                existingDeleteButton.remove();
            }

            // Adiciona o botão de excluir somente se não existir
            const deleteButton = `<button type="button" class="btn btn-danger" onclick="deleteAluno(${id})">Excluir</button>`;
            document.getElementById('editarForm').insertAdjacentHTML('beforeend', deleteButton);

            // Atualiza dropdowns
            populateCursos('cursoEditar');
            updateTurmasDropdown('cursoEditar', 'turmaEditar');

            const cursoDropdown = document.getElementById('cursoEditar');
            cursoDropdown.value = data.curso;
            cursoDropdown.dispatchEvent(new Event('change')); // Atualiza as turmas com base no curso selecionado

            const turmaDropdown = document.getElementById('turmaEditar');
            turmaDropdown.value = data.turma;

            document.getElementById('alunoId').value = id;

            const alunoModal = new bootstrap.Modal(document.getElementById('editarAlunoModal'));
            alunoModal.show();
        }
    } catch (error) {
        console.error('Erro:', error);
    }
}


function updateDropdowns(cursoId, turmaId, curso, turma) {
    const cursoDropdown = document.getElementById(cursoId);
    const turmaDropdown = document.getElementById(turmaId);

    // Atualiza dropdown de cursos
    if (cursoDropdown) {
        populateCursos(); // Preenche o dropdown de cursos
        cursoDropdown.value = curso;
        cursoDropdown.dispatchEvent(new Event('change')); // Aciona o evento para atualizar as turmas
    }

    // Atualiza dropdown de turmas
    if (turmaDropdown) {
        turmaDropdown.value = turma;
    }
}
