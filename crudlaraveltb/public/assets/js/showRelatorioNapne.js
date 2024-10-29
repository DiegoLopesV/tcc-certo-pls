// Configura o botão para abrir o modal do Relatório Napne
document.getElementById("emitirRelatorioNapneButton").onclick = function () {
    showRelatorioNapneModal();
};

function showRelatorioNapneModal() {
    // Opcional: Pré-preencher campos com valores padrão, se necessário
    //document.getElementById("bimestre").value = "";  // Exemplo: preencher com o bimestre atual
    //document.getElementById("alunoNapne").value = "";  // Preencha o nome do aluno, se tiver
    
    // Abrir o modal
    const relatorioNapneModal = new bootstrap.Modal(document.getElementById("relatorioNapneModal"));
    relatorioNapneModal.show();
}
