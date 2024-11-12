<!-- Modal das Info dos alunos -->
<div class="modal fade" id="alunoModalInfo" tabindex="-1" aria-labelledby="alunoModalInfoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alunoModalInfoLabel">Informações do Aluno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nome:</strong> <span id="modalNome"></span></p>
                <p><strong>Curso:</strong> <span id="modalCurso"></span></p>
                <p><strong>Turma:</strong> <span id="modalTurma"></span></p>
                <p><strong>CPF:</strong> <span id="modalCpf"></span></p>
                <p><strong>Nome dos Pais:</strong> <span id="modalNomePais"></span></p>
                <p><strong>Telefone:</strong> <span id="modalTelefone"></span></p>
                <p><strong>Telefone dos Pais:</strong> <span id="modalTelefonePais"></span></p>
                <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                <p><strong>Email dos Pais:</strong> <span id="modalEmailPais"></span></p>

                <!-- Aqui adicionamos a lista de ocorrências -->
                <h6>Ocorrências</h6>
                <ul id="ocorrenciasList"></ul>

                <h6>Enfermaria</h6>
                <ul id="enfermariaList"></ul>
            </div>
            <div class="modal-footer">
                @if(auth()->check() && auth()->user()->key === '987xyz')
<!-- Botão Editar -->
<button id="modalEditButton" class="btn btn-primary">Editar</button>

<!-- Botão Deletar -->
<button id="modalDeleteButton" class="btn btn-danger" data-aluno-id="">Deletar</button>

<!-- Botão Emitir Relatório Napne -->
<button type="button" class="btn btn-primary" id="emitirRelatorioNapneButton">
    Emitir Relatório Napne
</button>

                @endif
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal de cadastro -->
<div class="modal fade" id="alunoModal" tabindex="-1" aria-labelledby="alunoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alunoModalLabel">Formulário de Cadastro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="infoForm" data-store-url="{{ route('alunos.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" required>
                        <label for="nome">Nome</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="curso" class="form-select" name="curso" required>
                            <!-- As opções são preenchidas via JavaScript -->
                        </select>
                        <label for="curso">Curso</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="turma" class="form-select" name="turma" required>
                            <!-- As opções são preenchidas via JavaScript -->
                        </select>
                        <label for="turma">Turma</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="cpf" placeholder="CPF" name="cpf" required>
                        <label for="cpf">CPF</label>
                        <div id="cpfError" class="text-danger" style="display: none;"></div> <!-- Mensagem de erro -->
                    </div>
                    
                    
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome_pais" placeholder="Nome dos Pais" name="nome_pais" required>
                        <label for="nome_pais">Nome dos Pais</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telefone" placeholder="Telefone" name="telefone" required>
                        <label for="telefone">Telefone</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telefone_pais" placeholder="Telefone dos Pais" name="telefone_pais">
                        <label for="telefone_pais">Telefone dos Pais</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email_pais" placeholder="Email dos Pais" name="email_pais">
                        <label for="email_pais">Email dos Pais</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="napne" name="napne" required>
                            <option value="">Selecione uma opção</option>
                            <option value="Sim">Sim</option>
                            <option value="Não">Não</option>
                        </select>
                        <label for="napne">É aluno da Napne?</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                        <label for="data_nascimento">Data de Nascimento</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="file" id="foto" name="foto" accept="image/*">
                        <div id="imagePreviewContainer">
                            <img id="imagePreview" class="img-preview" alt="">
                        </div>
                    </div>
                    <!-- Botão de Enviar -->
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Napne -->
<div class="modal fade" id="relatorioNapneModal" tabindex="-1" aria-labelledby="relatorioNapneModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="relatorioNapneModalLabel">Relatório Napne</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    <form id="relatorioForm" method="POST" action="{{ route('gerarRelatorioNapne') }}">
        @csrf
        <div class="form-group">
            <label for="bimestre">Bimestre:</label>
            <input type="text" class="form-control" id="bimestre" name="bimestre" required>
        </div>
        <div class="form-group">
            <label for="aluno">Aluno(a):</label>
            <input type="text" class="form-control" id="aluno" name="aluno" required>
        </div>
        <div class="form-group">
            <label for="cursoTurma">Curso e Turma:</label>
            <input type="text" class="form-control" id="cursoTurma" name="cursoTurma" required>
        </div>
        <div class="form-group">
            <label for="disciplina">Disciplina:</label>
            <input type="text" class="form-control" id="disciplina" name="disciplina" required>
        </div>
        <div class="form-group">
            <label for="professor">Professor(a):</label>
            <input type="text" class="form-control" id="professor" name="professor" required>
        </div>
        <div class="form-group">
            <label for="objetivos">Objetivos do bimestre alcançados pelo estudante:</label>
            <textarea class="form-control" id="objetivos" name="objetivos" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="participacao">Nível de participação do estudante nas atividades:</label>
            <textarea class="form-control" id="participacao" name="participacao" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label for="avaliacao">Critérios e instrumentos de avaliação e respostas:</label>
            <textarea class="form-control" id="avaliacao" name="avaliacao" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="metodos">Métodos que facilitaram a aprendizagem:</label>
            <textarea class="form-control" id="metodos" name="metodos" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label for="dificuldades">Dificuldades:</label>
            <textarea class="form-control" id="dificuldades" name="dificuldades" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label for="informacoes">Informações importantes:</label>
            <textarea class="form-control" id="informacoes" name="informacoes" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label for="data">Data:</label>
            <input type="date" class="form-control" id="data" name="data" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

        </div>
    </div>
</div>

<script>
  

function isValidCPF(cpf) {
    // Remove caracteres não numéricos
    cpf = cpf.replace(/\D/g, '');

    // Verifica se o CPF tem 11 dígitos e não são todos iguais
    if (cpf.length !== 11 || /^[0-9]{1}\1{10}$/.test(cpf)) {
        return false;
    }

    // Cálculo do primeiro dígito verificador
    let sum = 0;
    for (let i = 0; i < 9; i++) {
        sum += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let firstVerifier = 11 - (sum % 11);
    if (firstVerifier >= 10) firstVerifier = 0;

    // Cálculo do segundo dígito verificador
    sum = 0;
    for (let i = 0; i < 10; i++) {
        sum += parseInt(cpf.charAt(i)) * (11 - i);
    }
    let secondVerifier = 11 - (sum % 11);
    if (secondVerifier >= 10) secondVerifier = 0;

    // Verifica se os dígitos verificadores estão corretos
    return (firstVerifier === parseInt(cpf.charAt(9))) && (secondVerifier === parseInt(cpf.charAt(10)));
}


// Valida o CPF ao perder o foco do campo
document.getElementById('cpf').addEventListener('blur', function() {
    const cpf = this.value;
    const errorDiv = document.getElementById('cpfError');

    if (!isValidCPF(cpf)) {
        errorDiv.textContent = 'CPF inválido. Por favor, insira um CPF válido.';
        errorDiv.style.display = 'block';
        this.focus(); // Foca novamente no campo
    } else {
        errorDiv.style.display = 'none'; // Limpa a mensagem de erro
    }
});

// Limpar mensagem de erro enquanto digita
document.getElementById('cpf').addEventListener('input', function() {
    const errorDiv = document.getElementById('cpfError');
    errorDiv.style.display = 'none'; // Oculta a mensagem de erro
});

// Validar CPF na submissão do formulário
document.querySelector('form').addEventListener('submit', function(event) {
    const cpf = document.getElementById('cpf').value;
    if (!isValidCPF(cpf)) {
        event.preventDefault(); // Impede o envio do formulário
        const errorDiv = document.getElementById('cpfError');
        errorDiv.textContent = 'CPF inválido. Por favor, insira um CPF válido.';
        errorDiv.style.display = 'block';
        document.getElementById('cpf').focus(); // Foca no campo de CPF
    }
});


</script>








<!-- Container para adicionar o novo conteúdo -->
<div id="alunoContainer" class="mt-4"></div>
