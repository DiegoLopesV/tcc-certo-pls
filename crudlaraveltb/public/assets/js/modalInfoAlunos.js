function showModal(aluno) {
    // Preenche o modal com as informações do aluno
    document.getElementById("modalNome").textContent = aluno.nome;
    document.getElementById("modalCurso").textContent = aluno.curso;
    document.getElementById("modalTurma").textContent = aluno.turma;
    document.getElementById("modalCpf").textContent = aluno.cpf;
    document.getElementById("modalNomePais").textContent = aluno.nome_pais;
    document.getElementById("modalTelefone").textContent = aluno.telefone;
    document.getElementById("modalTelefonePais").textContent = aluno.telefone_pais;
    document.getElementById("modalEmail").textContent = aluno.email;
    document.getElementById("modalEmailPais").textContent = aluno.email_pais;
    document.getElementById("data_nascimento").textContent = aluno.data_nascimento;
    document.getElementById("napne").textContent = aluno.napne;

    // Atualiza o ID do aluno no botão Deletar
    const deleteButton = document.getElementById("modalDeleteButton");
    deleteButton.setAttribute('data-aluno-id', aluno.id);

    // Faz a requisição para buscar as ocorrências do aluno
    fetch(`/alunos/${aluno.id}/ocorrencias`)
        .then(response => response.json())
        .then(ocorrencias => {
            // Renderiza as ocorrências no modal
            const ocorrenciasList = document.getElementById("ocorrenciasList");
            ocorrenciasList.innerHTML = ''; // Limpa a lista de ocorrências atual
            ocorrencias.forEach(ocorrencia => {
                const li = document.createElement('li');
                li.innerHTML = `Título: ${ocorrencia.titulo} <br> Data do Ocorrido: ${ocorrencia.data}<br> Descrição: ${ocorrencia.descricao}`;
                ocorrenciasList.appendChild(li);
            });
        })
        .catch(error => {
            console.error('Erro ao buscar ocorrências:', error);
        });

    // Faz a requisição para buscar as ocorrências da enfermaria
    fetch(`/alunos/${aluno.id}/enfermaria`)
        .then(response => response.json())
        .then(enfermaria => {
            const enfermariaList = document.getElementById("enfermariaList");
            enfermariaList.innerHTML = ''; // Limpa a lista de enfermaria atual
            enfermaria.forEach(item => {
                const li = document.createElement('li');
                li.textContent = `${item.data} - ${item.titulo} - ${item.descricao}`;
                enfermariaList.appendChild(li);
            });
        })
        .catch(error => {
            console.error('Erro ao buscar enfermaria:', error);
        });

    // Configura o botão de editar
    const editButton = document.getElementById("modalEditButton");
    editButton.onclick = function () {
        const alunoModalInfo = bootstrap.Modal.getInstance(
            document.getElementById("alunoModalInfo")
        );
        alunoModalInfo.hide();
        editAluno(aluno.id); // Função para editar o aluno
    };

    // Configura o botão de deletar
    deleteButton.onclick = function () {
        const alunoId = deleteButton.getAttribute('data-aluno-id'); // Pega o ID do aluno do atributo

        if (!alunoId) {
            console.error('Nenhum ID de aluno fornecido');
            return;
        }

        if (confirm('Tem certeza que deseja excluir este aluno?')) {
            const alunoModalInfo = bootstrap.Modal.getInstance(document.getElementById("alunoModalInfo"));
            alunoModalInfo.hide(); // Fecha o modal de informações do aluno
            deleteAluno(alunoId);
            location.reload(); // Chama a função de deletar o aluno
        }
    };

    // Mostra o modal
    const alunoModalInfo = new bootstrap.Modal(document.getElementById("alunoModalInfo"));
    alunoModalInfo.show();
}
