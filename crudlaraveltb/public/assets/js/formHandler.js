// Obtém o token CSRF do meta tag
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

document.getElementById('infoForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const alunoId = this.getAttribute('data-id');
    const storeUrl = this.getAttribute('data-store-url');
    const url = alunoId ? `/alunos/${alunoId}` : storeUrl; // Usa a URL dinamicamente
    const method = alunoId ? 'PUT' : 'POST';

    fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Aluno salvo com sucesso!' || data.message === 'Aluno atualizado com sucesso!') {
                if (alunoId) {
                    updateAluno(alunoId, data.aluno);
                } else {
                    renderAluno(data.aluno);
                }

                // Fechar modal e resetar formulário
                const alunoModal = bootstrap.Modal.getInstance(document.getElementById('alunoModal'));
                alunoModal.hide();
                document.getElementById('infoForm').reset();
                document.getElementById('infoForm').removeAttribute('data-id');
                document.querySelector('.btn-danger')?.remove();
            } else {
                console.error('Erro:', data);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
        });
});
