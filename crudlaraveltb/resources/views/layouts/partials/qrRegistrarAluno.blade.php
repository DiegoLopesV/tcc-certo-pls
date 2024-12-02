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

            <!-- Dropdown de Curso -->
            <div class="form-floating mb-3">
                <select id="aluno-curso" class="form-select" name="curso" required>
                    <!-- As opções são preenchidas via dropdown.js -->
                </select>
                <label for="aluno-curso">Curso</label>
            </div>

            <!-- Dropdown de Turma -->
            <div class="form-floating mb-3">
                <select id="aluno-turma" class="form-select" name="turma" required>
                    <!-- As opções são preenchidas via dropdown.js -->
                </select>
                <label for="aluno-turma">Turma</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="cpf" placeholder="CPF" name="cpf" required>
                <label for="cpf">CPF</label>
                <div id="cpfError" class="text-danger" style="display: none;"></div>
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

            <p>Já possui uma conta? Entrar <a href="{{ route('login.perform') }}">aqui</a></p>

            <!-- Botão de Enviar -->
            <button type="submit" class="btn btn-primary">Enviar</button>
            <a href="{{ route('home.index') }}" class="btn btn-secondary mx-auto">Página Inicial</a>
        </form>
    </div>

    <script src="{{ asset('assets/js/dropdown.js') }}"></script> <!-- Dropdown.js já é carregado -->
    <script src="{{ asset('assets/js/imagePreview.js') }}"></script>

    <script>
        document.getElementById('cadastroAluno').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            const url = this.getAttribute('data-store-url');

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                window.location.href = '{{ route("login.perform") }}';
            })
            .catch(error => console.error('Erro ao enviar o formulário:', error));
        });

        // Validação de CPF
        function isValidCPF(cpf) { /* Função permanece igual */ }
    </script>
</body>

</html>
