// Função para atualizar aluno existente
function updateAluno(id, aluno) {
    const card = document.querySelector(`[data-id='${id}']`);
    
    if (card) {
        card.innerHTML = `
            ${aluno.foto ? `<img src="${aluno.foto}" alt="Foto do Aluno" class="img-fluid img-preview mt-3" style="cursor: pointer;">` : ''}
            <p><strong>Nome:</strong> ${aluno.nome}</p>
            <p><strong>Curso:</strong> ${aluno.curso}</p>
            <p><strong>Turma:</strong> ${aluno.turma}</p>
            <p><strong>Data de Nascimento:</strong> ${aluno.data_nascimento}</p>
        `;
        
        // Atualiza o evento de clique no card
        card.onclick = () => showModal(id);
    }
}
