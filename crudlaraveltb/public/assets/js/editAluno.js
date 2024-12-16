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
            const fields = ['nome', 'curso', 'turma', 'cpf', 'nome_pais', 'telefone', 'telefone_pais', 'email', 'email_pais', 'data_nascimento', 'napne', 'numero_matricula'];
            fields.forEach(field => {
                const element = document.getElementById(field + 'Editar');
                if (element) {
                    element.value = ''; // Limpa o valor atual
                }
            });

                        // Formatando a data de nascimento corretamente para o padrão YYYY-MM-DD
                        if (data.data_nascimento) {
                            const dataFormatada = new Date(data.data_nascimento).toISOString().split('T')[0];
                            document.getElementById('data_nascimento').value = dataFormatada;
                        }

            // Atualiza dropdowns
            populateCursos('cursoEditar');
            updateTurmasDropdown('cursoEditar', 'turmaEditar');

            // Atualiza os valores do formulário com os dados recebidos
            const cursoDropdown = document.getElementById('cursoEditar');
            cursoDropdown.value = data.curso;
            cursoDropdown.dispatchEvent(new Event('change')); // Atualiza as turmas com base no curso selecionado

            const turmaDropdown = document.getElementById('turmaEditar');
            turmaDropdown.value = data.turma;

            // Atualiza o campo Napne
            const napneDropdown = document.getElementById('napne');

            // Limpa as opções existentes antes de adicionar
            napneDropdown.innerHTML = `
                <option value="">Selecione uma opção</option>
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
            `;
            napneDropdown.value = data.napne || '';// Log para verificar

            // Preencher outros campos
            fields.forEach(field => {
                const element = document.getElementById(field + 'Editar');
                if (element && field !== 'napne' && field !== 'data_nascimento') { // Preencher outros campos
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
        }
    } catch (error) {
        console.error('Erro:', error);
    }
}
