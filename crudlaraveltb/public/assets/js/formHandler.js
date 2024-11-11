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
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log(data); // Exibe a resposta para verificação
        if (data.message) {
            // Recarrega a página
            location.reload();
        } else {
            console.error('Erro:', data);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
    });
});
