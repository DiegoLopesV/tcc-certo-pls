//Modal Aluno
function showModal(aluno) {
    // Preenche o modal com as informações do aluno
    document.getElementById('modalNome').textContent = aluno.nome;
    document.getElementById('modalCurso').textContent = aluno.curso;
    document.getElementById('modalTurma').textContent = aluno.turma;
    document.getElementById('modalCpf').textContent = aluno.cpf;
    document.getElementById('modalNomePais').textContent = aluno.nome_pais;
    document.getElementById('modalTelefone').textContent = aluno.telefone;
    document.getElementById('modalTelefonePais').textContent = aluno.telefone_pais;
    document.getElementById('modalEmail').textContent = aluno.email;
    document.getElementById('modalEmailPais').textContent = aluno.email_pais;

    // Configura o botão de editar
    const editButton = document.getElementById('modalEditButton');
    editButton.onclick = function() {
    // Fechar o modal de informações antes de abrir o formulário de edição
    const alunoModalInfo = bootstrap.Modal.getInstance(document.getElementById('alunoModalInfo'));
    alunoModalInfo.hide();

    // Chamar a função de edição do aluno
    editAluno(aluno.id);
};


    // Mostra o modal
    const alunoModalInfo = new bootstrap.Modal(document.getElementById('alunoModalInfo'));
    alunoModalInfo.show();
}

