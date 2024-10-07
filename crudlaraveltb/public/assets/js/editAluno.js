async function editAluno(id) {
    try {
        const response = await fetch(`/alunos/${id}/edit`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (data) {
            // Limpa os campos do formulário antes de preenchê-los
            const fields = ['nome', 'curso', 'turma', 'cpf', 'nome_pais', 'telefone', 'telefone_pais', 'email', 'email_pais, data_nascimento, napne'];
            fields.forEach(field => {
                const element = document.getElementById(field + 'Editar');
                if (element) {
                    element.value = ''; // Limpa o valor atual
                }
            });

            // Atualiza dropdowns
            populateCursos('cursoEditar');
            updateTurmasDropdown('cursoEditar', 'turmaEditar');

            // Atualiza os valores do formulário com os dados recebidos
            const cursoDropdown = document.getElementById('cursoEditar');
            cursoDropdown.value = data.curso;
            cursoDropdown.dispatchEvent(new Event('change')); // Atualiza as turmas com base no curso selecionado

            const turmaDropdown = document.getElementById('turmaEditar');
            turmaDropdown.value = data.turma;

            fields.forEach(field => {
                const element = document.getElementById(field + 'Editar');
                if (element) {
                    element.value = data[field] || '';
                }
            });

            document.getElementById('alunoId').value = id;

            // Atualiza a URL de submissão no formulário com o ID correto
            const editarForm = document.getElementById('editarForm');
            editarForm.setAttribute('data-update-url', `/alunos/${id}`); // Atualiza a URL com o ID do aluno

            // Fecha o modal de informações
            const alunoModalInfo = bootstrap.Modal.getInstance(document.getElementById('alunoModalInfo'));
            alunoModalInfo.hide();

            // Abre o modal de edição
            const alunoModal = new bootstrap.Modal(document.getElementById('editarAlunoModal'));
            alunoModal.show();

            // Adiciona um listener para o evento de submissão do formulário
            editarForm.addEventListener('submit', async function(event) {
                event.preventDefault(); // Previne o comportamento padrão de envio do formulário

                const formData = new FormData(this);
                const updateUrl = this.getAttribute('data-update-url'); // Obtém a URL de atualização

                try {
                    const updateResponse = await fetch(updateUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: formData
                    });

                    if (updateResponse.ok) {
                        // Recarrega a página inteira para refletir as alterações
                        location.reload();
                    } else {
                        console.error('Erro ao atualizar o aluno.');
                    }
                } catch (error) {
                    console.error('Erro:', error);
                }
            });
        }
    } catch (error) {
        console.error('Erro:', error);
    }
}
