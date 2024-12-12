function showModal(aluno) {
    // Preenche o modal com as informações do aluno
    document.getElementById("modalNome").textContent = aluno.nome;
    document.getElementById("modalCurso").textContent = aluno.curso;
    document.getElementById("modalTurma").textContent = aluno.turma;
    document.getElementById("modalCpf").textContent = aluno.cpf;
    document.getElementById("modalMatricula").textContent = aluno.numero_matricula;
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
                li.innerHTML = `Titulo: ${item.titulo} <br>  Queixa: ${item.queixa}  <br> Responsável: ${item.responsavel}  <br> Data do ocorrido: ${item.data}<br>  Inicío do Atendimento: ${item.horaInicio} <br> Final do Atendimento: ${item.horaFinal} <br>Atividade Realizada: ${item.atividade_realizada}  <br>Observações: ${item.descricao}`;
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
            
            document.getElementById('alunoModalInfo').addEventListener('hidden.bs.modal', function() {
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.removeProperty('padding-right');
            });

            deleteAluno(alunoId);
        }
    };

    // Mostra o modal
    const alunoModalInfo = new bootstrap.Modal(document.getElementById("alunoModalInfo"));
    alunoModalInfo.show();
}

document.getElementById('emitirRelatorioNapneButton').onclick = function() {
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

document.getElementById('gerarDesempenhoButton').onclick = function() {
    const alunoId = document.getElementById("modalDeleteButton").getAttribute('data-aluno-id');
    if (alunoId) {
        // Redireciona para a rota que gera o PDF
        window.location.href = `/alunos/${alunoId}/gerar-desempenho`;
    } else {
        console.error('ID do aluno não encontrado');
    }
};
