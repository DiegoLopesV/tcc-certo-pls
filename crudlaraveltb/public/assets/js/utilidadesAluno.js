
document.getElementById('alunoModal').addEventListener('hidden.bs.modal', function() {
    const backdrops = document.querySelectorAll('.modal-backdrop');
    backdrops.forEach(backdrop => backdrop.remove());
    document.body.classList.remove('modal-open');
    document.body.style.overflow = 'auto'; // Adiciona scroll novamente
    document.body.style.removeProperty('padding-right');
});

document.getElementById('editarAlunoModal').addEventListener('hidden.bs.modal', function() {
    const backdrops = document.querySelectorAll('.modal-backdrop');
    backdrops.forEach(backdrop => backdrop.remove());
    document.body.classList.remove('modal-open');
    document.body.style.overflow = 'auto'; // Adiciona scroll novamente
    document.body.style.removeProperty('padding-right');
});


document.getElementById('alunoContainer').addEventListener('click', function(event) {
    const card = event.target.closest('.aluno-card');
    if (card) {
        const alunoId = card.getAttribute('data-id');
        // Supondo que você tem uma função para buscar os dados do aluno
        fetch(`/alunos/${alunoId}`)
            .then(response => response.json())
            .then(aluno => showModal(aluno));
    }
});