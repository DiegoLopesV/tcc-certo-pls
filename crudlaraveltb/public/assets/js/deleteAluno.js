// Função para excluir aluno
function deleteAluno(id) {
    if (!confirm('Tem certeza que deseja excluir este aluno?')) return;

    fetch(`/alunos/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Aluno excluído com sucesso!') {
            // Remove o cartão do aluno
            const card = document.querySelector(`[data-id='${id}']`);
            card?.remove();

            // Fecha o modal e limpa o formulário
            const alunoModal = bootstrap.Modal.getInstance(document.getElementById('editarAlunoModal'));
            alunoModal.hide();

            // Limpa o ID do formulário e remove o botão de excluir
            const editarForm = document.getElementById('editarForm');
            editarForm.removeAttribute('data-id');
            
        } else {
            console.error('Erro:', data.message);
        }
    })
    .catch(error => console.error('Erro:', error));
}
