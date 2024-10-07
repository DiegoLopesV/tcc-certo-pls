function renderAluno(aluno) {
    const infoBox = document.createElement("div");
    infoBox.className =
        "aluno-card rounded text-center border border-dark border-2 excesso";
    infoBox.setAttribute("data-id", aluno.id);

    // Adiciona um evento de clique para abrir o modal
    infoBox.addEventListener("click", () => {
        showModal(aluno);
    });

    // Verifica se o aluno tem uma foto e exibe a imagem
    infoBox.innerHTML = `
    ${
        aluno.foto
            ? `<img src="${aluno.foto}" alt="Foto do Aluno" class="img-preview mt-4 mb-3" style="max-width: 150px;">`
            : ""
    }
    <p><strong>Nome:</strong> ${aluno.nome}</p>
    <p><strong>Curso:</strong> ${aluno.curso}</p>
    <p><strong>Turma:</strong> ${aluno.turma}</p>
    <p><strong>Data de Nascimento:</strong> ${aluno.data_nascimento}</p>
`;

    document.getElementById("alunoContainer").appendChild(infoBox);
}
