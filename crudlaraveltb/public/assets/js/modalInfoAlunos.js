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


    function closeAlunoModal() {
        const alunoModal = bootstrap.Modal.getInstance(document.getElementById("alunoModalInfo"));
        alunoModal.hide();
        const backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(backdrop => backdrop.remove());
        document.body.classList.remove('modal-open');
        document.body.style.overflow = 'auto'; // Adiciona scroll novamente
        document.body.style.removeProperty('padding-right');// Remove qualquer estilo extra no body
    }
    // Aplica o closeAlunoModal ao botão Close
    document.getElementById("close").onclick = closeAlunoModal;




    // Atualiza o ID do aluno no botão Deletar
    const deleteButton = document.getElementById("modalDeleteButton");
    deleteButton.setAttribute('data-aluno-id', aluno.id);


    // Mostra o modal
    const alunoModalInfo = new bootstrap.Modal(document.getElementById("alunoModalInfo"));
    alunoModalInfo.show();
}


document.addEventListener('DOMContentLoaded', function () {
    // Capture o modal
    const modal = document.getElementById('alunoModalInfo');


    // Ouça o evento de abertura do modal
    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // O botão que foi clicado
        const alunoId = button.getAttribute('data-id');
        const alunoNome = button.getAttribute('data-nome');
        const alunoCurso = button.getAttribute('data-curso');
        const alunoTurma = button.getAttribute('data-turma');
        const alunoCpf = button.getAttribute('data-cpf');
        const alunoNomePais = button.getAttribute('data-nome-pais');
        const alunoTelefone = button.getAttribute('data-telefone');
        const alunoTelefonePais = button.getAttribute('data-telefone-pais');
        const alunoEmail = button.getAttribute('data-email');
        const alunoEmailPais = button.getAttribute('data-email-pais');
        const alunoDataNascimento = button.getAttribute('data-data-nascimento');
        const alunoNapne = button.getAttribute('data-napne'); // Adicionei o napne como exemplo


        // Preenche o modal com as informações
        document.getElementById('modalNome').textContent = alunoNome;
        document.getElementById('modalCurso').textContent = alunoCurso;
        document.getElementById('modalTurma').textContent = alunoTurma;
        document.getElementById('modalCpf').textContent = alunoCpf;
        document.getElementById('modalNomePais').textContent = alunoNomePais;
        document.getElementById('modalTelefone').textContent = alunoTelefone;
        document.getElementById('modalTelefonePais').textContent = alunoTelefonePais;
        document.getElementById('modalEmail').textContent = alunoEmail;
        document.getElementById('modalEmailPais').textContent = alunoEmailPais;
        document.getElementById('data_nascimento').textContent = alunoDataNascimento;
        document.getElementById('napne').textContent = alunoNapne;  // Preenche o campo do Napne se necessário
    });
});






document.getElementById('emitirRelatorioNapneButton').onclick = function () {
    // Coleta os dados do modal
    const alunoData = {
        nome: document.getElementById("modalNome").textContent,
        curso: document.getElementById("modalCurso").textContent,
        turma: document.getElementById("modalTurma").textContent,
        cpf: document.getElementById("modalCpf").textContent,
        nome_pais: document.getElementById("modalNomePais").textContent,
        telefone: document.getElementById("modalTelefone").textContent,
        telefone_pais: document.getElementById("modalTelefonePais").textContent,
        email: document.getElementById("modalEmail").textContent,
        email_pais: document.getElementById("modalEmailPais").textContent
    };


    // Envia os dados para o servidor
    fetch('/alunos/gerar-relatorio-napne', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(alunoData)
    })
        .then(response => response.blob())
        .then(blob => {
            // Cria um link para download do PDF
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'relatorio_napne.pdf';
            document.body.appendChild(a); // necessário para o Firefox
            a.click();
            a.remove();
        })
        .catch(error => {
            console.error('Erro ao gerar PDF:', error);
        });
};


document.getElementById('gerarDesempenhoButton').onclick = function () {
    const alunoId = document.getElementById("modalDeleteButton").getAttribute('data-aluno-id');
    if (alunoId) {
        // Redireciona para a rota que gera o PDF
        window.location.href = `/alunos/${alunoId}/gerar-desempenho`;
    } else {
        console.error('ID do aluno não encontrado');
    }
};
