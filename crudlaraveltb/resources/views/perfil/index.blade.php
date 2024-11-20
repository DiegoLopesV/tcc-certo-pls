<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    @include('layouts.partials.essentials')
    <title>Perfil</title>
    <script src="https://kit.fontawesome.com/ad3460fbc5.js" crossorigin="anonymous"></script>
</head>


<body id="body">
    @include('layouts.partials.navbarlogged')


    <div class="border border-dark border-2 m-5 rounded boxGPerf">
        <div class="d-flex">
            <div class="userBox border border-dark border-1 text-center m-3 rounded">
                <i class="fa-solid fa-user user"></i>
                <p>{{ $user->nome ?? 'Nome não informado' }}</p>








            </div>


            <div class="infoPes border border-dark border-1 m-3 rounded">
                <button class="border border-dark border-2 rounded m-1 botaoPerf" onclick="showContent('personalInfo')">Informações Pessoais</button>
                <button class="border border-dark border-2 rounded m-1 botaoPerf" onclick="showContent('ocorrencias1')">Ocorrências Feitas</button>
                <button class="border border-dark border-2 rounded m-1 botaoPerf" onclick="showContent('enf')">Relatórios Enfermaria</button>


                <div id="personalInfo" class="content mt-3">
    <div class="border border-dark border-1 m-1 p-1 boxinha">
        <h5>Informações Pessoais</h5>
       
        <!-- Exibindo as informações do usuário -->
        <p>Nome: {{ $user->nome }}</p>
        <p>CPF: {{ $user->cpf }}</p>
        <p>Telefone: {{ $user->telefone }}</p>
        <p>E-mail: {{ $user->email }}</p>


        <p>E-mail dos Pais: {{ $user->email_pais }}</p>


        <!-- Botão para editar -->
        <button id="editButton" class="btn btn-primary mt-3">Editar</button>




           </div>
</div>


<!-- Formulário de edição, oculto inicialmente -->
<div id="editForm" class="content mt-3" style="display: none;">
    <form method="POST" action="{{ route('perfil.update', $user->id) }}">
        @csrf
        @method('PUT')


        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" value="{{ $user->nome }}" class="form-control">
        </div>


        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" value="{{ $user->cpf }}" class="form-control">
        </div>


        <div class="form-group">
            <label for="nome_pais">Nome dos Pais</label>
            <input type="text" name="nome_pais" value="{{ $user->nome_pais }}" class="form-control">
        </div>


        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" value="{{ $user->telefone }}" class="form-control">
        </div>


        <div class="form-group">
            <label for="telefone_pais">Telefone dos Pais</label>
            <input type="text" name="telefone_pais" value="{{ $user->telefone_pais }}" class="form-control">
        </div>


        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control">
        </div>


        <div class="form-group">
            <label for="email_pais">E-mail dos Pais</label>
            <input type="email" name="email_pais" value="{{ $user->email_pais }}" class="form-control">
        </div>


        <!-- Botões de ação -->
        <button type="submit" class="btn btn-success mt-3">Salvar</button>
        <button type="button" id="cancelButton" class="btn btn-secondary mt-3">Cancelar</button>
    </form>
</div>












                <div id="ocorrencias1" class="content mt-3">
                   <div class="border border-dark border-1 m-1 p-1 boxinha"><p>Ocorrências</p></div>
                </div>
                <div id="enf" class="content mt-3">
                   <div class="border border-dark border-1 m-1 p-1 boxinha"><p>Relatórios Enfermaria</p></div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function showContent(contentId) {
            // Esconde todos os conteúdos
            const contents = document.querySelectorAll('.content');
            contents.forEach(content => content.style.display = 'none');


            // Mostra o conteúdo selecionado
            document.getElementById(contentId).style.display = 'block';
        }


        document.getElementById('editButton').addEventListener('click', function() {
        // Esconde a seção de informações e mostra o formulário
        document.getElementById('personalInfo').style.display = 'none';
        document.getElementById('editForm').style.display = 'block';
    });


    document.getElementById('cancelButton').addEventListener('click', function() {
        // Esconde o formulário e volta a mostrar as informações
        document.getElementById('editForm').style.display = 'none';
        document.getElementById('personalInfo').style.display = 'block';
    });
    </script>


</body>


</html>


