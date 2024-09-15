
@include('layouts.partials.essentials')<!DOCTYPE html>
@include('layouts.partials.navbarlogged')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SGA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body id="body">
    <div class="d-flex text-center border border-dark border-3 border-top-0  ">
        <div class="border border-dark border-2 m-3 box01 p-2 fs-1" id="ic"> <i class="fa-solid fa-camera"></i>
            Processos Fotográficos 2</div>
        @include('layouts.partials.btnTurmas')
    </div>
    <div class="alunos-container d-flex">
        <!-- Container para adicionar o novo conteúdo -->
        <div id="alunoContainer" class="mt-4 d-flex flex-wrap mx-2 gap-2">
            @foreach ($alunos as $aluno)
                    @if ($aluno->turma !== 'passou de ano')
                        <div class="aluno-card rounded text-center border border-dark border-2 excesso" data-id="{{ $aluno->id }}">
                            <!-- O card agora é clicável para abrir o modal -->
                            <img src="{{ $aluno->foto }}" alt="Foto do Aluno" class="img-fluid img-preview mt-4 mb-3" style="cursor: pointer;">
                            <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
                            <p><strong>Curso:</strong> {{ $aluno->curso }}</p>
                            <p><strong>Turma:</strong> {{ $aluno->turma }}</p>
                        </div>
                    @endif
                @endforeach
        </div>
    </div>
    </div>
    @extends('layouts.partials.essentialsAlunos')
</html>
</body>
