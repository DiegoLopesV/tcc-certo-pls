function editAluno(id) {
    fetch(`/alunos/${id}/edit`)

        .then(response => response.json())
        .then(aluno => {
            document.getElementById('nome').value = aluno.nome;
            document.getElementById('curso').value = aluno.curso;
            document.getElementById('turma').value = aluno.turma;
            document.getElementById('cpf').value = aluno.cpf;
            document.getElementById('nome_pais').value = aluno.nome_pais;
            document.getElementById('telefone').value = aluno.telefone;
            document.getElementById('telefone_pais').value = aluno.telefone_pais;
            document.getElementById('email').value = aluno.email;
            document.getElementById('email_pais').value = aluno.email_pais;

            let deleteButton = document.querySelector('.btn-danger');
            if (!deleteButton) {
                deleteButton =
                    `<button type="button" class="btn btn-danger" onclick="deleteAluno(${id})">Excluir</button>`;
                document.getElementById('infoForm').insertAdjacentHTML('beforeend', deleteButton);
            }

            document.getElementById('infoForm').setAttribute('data-id', id);

            const alunoModal = new bootstrap.Modal(document.getElementById('alunoModal'));
            alunoModal.show();
        })
        .catch(error => console.error('Erro:', error));
}