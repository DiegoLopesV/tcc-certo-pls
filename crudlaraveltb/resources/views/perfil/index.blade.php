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


        @if(auth()->user()->key === 'aluno2024')
        <p>Nome dos pais: {{ $user->nome_pais ?? 'Nome dos pais não informado' }}</p>
        <p>Telefone dos Pais: {{ $user->telefone_pais ?? 'Telefone dos pais não informado' }}</p>
        <p>Telefone dos pais: {{ $user->telefone_pais ?? 'Telefone dos pais não informado' }}</p>
        <p>E-mail dos Pais:{{ $user->email_pais ?? 'Email dos pais não informado' }}</p>
        @endif
    </div>
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
    </script>

</body>

</html>
