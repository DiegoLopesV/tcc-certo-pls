@extends('layouts.partials.essentials')
@include('layouts.partials.navbarlogged')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Meta tag do CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Alunos</title>

</head>

    



<body id="body">

    <div>
        
    <div class="position-relative m-3 border border-dark border-3 rounded p-5">
        <div class="fs-1 mb-3">Lista de todos os alunos <br>
            <button type="button" class="btn btn-primary border border-dark border-1 fs-5 p-0 m-0" id="filtroAluno" data-bs-toggle="modal" data-bs-target="#filterModal">
                Filtrar por turma
            </button>   
        </div>
        

        <!-- Botões posicionados no canto superior direito -->
@if(auth()->check() && auth()->user()->key === '987xyz')
    <div class="position-absolute top-0 end-0 mx-3">
        <button class="rounded AddALunos mb-2" data-bs-toggle="modal" data-bs-target="#alunoModal">Adicionar Alunos</button>
        <a href="{{ route('passar_ano') }}">
            <button class="rounded AddALunos mb-2">Passar de Ano</button>
        </a>
        <a href="{{ route('alunosPassados') }}">
            <button class="rounded AddALunos">Ex Alunos</button>
        </a>     

        <a href="{{route('qrRegistrarAluno')}}"><button class="rounded AddALunos">Teste</button></a>

    </div>
@endif


        <div class="alunos-container d-flex">
    <!-- Container para adicionar o novo conteúdo -->
    <div id="alunoContainer" class="mt-4 d-flex flex-wrap mx-2 gap-2">
        @foreach ($alunos as $aluno)
            @if ($aluno->turma !== 'passou de ano') <!-- Manter o filtro original -->
                <div class="aluno-card rounded text-center border border-dark border-2 excesso"
                     data-bs-toggle="modal" data-bs-target="#alunoModalInfo"
                     data-id="{{ $aluno->id }}" data-turma="{{ $aluno->turma }}"
                     style="background-color: {{ $aluno->napne === 'Sim' ? '#cce7ff' : 'transparent' }};">
                    <!-- O card agora é clicável para abrir o modal -->
                    <img src="{{ $aluno->foto }}" alt="Foto do Aluno" class="img-fluid img-preview mt-4 mb-3" style="cursor: pointer;">
                    <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
                    <p><strong>Curso:</strong> {{ $aluno->curso }}</p>
                    <p><strong>Turma:</strong> {{ $aluno->turma }}</p>
                    <p><strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($aluno->data_nascimento)->format('d-m-Y') }}</p>

                    
                </div>
            @endif
        @endforeach
    </div>
</div>

    </div>

    @include('layouts.partials.formEditAluno')
    @include('layouts.partials.btnAlunos')
    @include('layouts.partials.btnFiltro')
    


</div>

    <script src="{{ asset('assets/js/dropdown.js') }}"></script>
    <script src="{{ asset('assets/js/imagePreview.js') }}"></script>
    <script src="{{ asset('assets/js/formHandler.js') }}"></script>
    <script src="{{ asset('assets/js/modalInfoAlunos.js') }}"></script>
    <script src="{{ asset('assets/js/renderAluno.js') }}"></script>
    <script src="{{ asset('assets/js/updateAluno.js') }}"></script>
    <script src="{{ asset('assets/js/editAluno.js') }}"></script>
    <script src="{{ asset('assets/js/deleteAluno.js') }}"></script>
    <script src="{{ asset('assets/js/utilidadesAluno.js') }}"></script>
    <script src="{{ asset('assets/js/showRelatorioNapne.js') }}"></script>





</body>
</html>