@extends('layouts.partials.essentials')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registrar Aluno</title>
</head>


<body>
    <!-- Formulário de Cadastro -->
<div class="container mt-4 form-container text-center">
    <img class="mb-4" src="{!! url('assets/img/ifpr_vertical.svg') !!}" alt="" width="202" height="187">
    <h5>Formulário de Cadastro de Aluno</h5>
    <form id="cadastroAluno" data-store-url="{{ route('alunos.store2') }}" enctype="multipart/form-data">
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
            <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha" required>
            <label for="senha">Senha</label>
        </div>        
        <div class="form-floating mb-3">
            <input type="file" id="foto" name="foto" accept="image/*">
            <div id="imagePreviewContainer">
                <img id="imagePreview" class="img-preview" alt="">
            </div>
        </div>
        <p> Já possui uma conta? Entrar <a href="{{ route('login.perform') }}"> aqui</a></p>
        <!-- Botão de Enviar -->
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a href="{{ route('home.index') }}" class="btn btn-secondary mx-auto">Página Inicial</a>
    </form>
    
</div>
<script src="{{ asset('assets/js/dropdown.js') }}"></script>
<script src="{{ asset('assets/js/imagePreview.js') }}"></script>

<script>
    // Captura o evento de envio do formulário
    document.getElementById('cadastroAluno').addEventListener('submit', function(event) {
        // Impede o comportamento padrão de envio
        event.preventDefault();

        // Coleta os dados do formulário
        const formData = new FormData(this);
        const url = this.getAttribute('data-store-url');

        fetch(url, {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: formData
})
.then(response => {
    if (!response.ok) {
        throw new Error(`Erro HTTP: ${response.status}`);
    }
    return response.json(); // Apenas converte para JSON se o status for OK
})
.then(data => {
    console.log(data);
    // Redireciona o usuário para a rota de login se a operação for bem-sucedida
    window.location.href = '{{ route("login.perform") }}';
})
.catch(error => {
    console.error('Erro ao enviar o formulário:', error);
});


});


    
</script>

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
</body>
</html>