@extends('layouts.partials.essentials')
@include('layouts.partials.navbarlogged')

<body id="body">
    <div class="position-relative m-3 border border-dark border-3 rounded p-5 ">
        <div class="fs-1 mb-3">Lista de todos os alunos</div>
        <div> 
            <button class="position-absolute top-0 end-0 mx-3 rounded" id="AddALunos" data-bs-toggle="modal" data-bs-target="#alunoModal">Adicionar Alunos</button>
        </div>
        <div class="alunos-container d-flex">
            <!-- Container para adicionar o novo conteúdo -->
            <div id="alunoContainer" class="mt-4 d-flex flex-wrap mx-2 gap-2">
                @foreach($alunos as $aluno)
                    <div class="aluno-card rounded text-center border border-dark border-2 excesso" data-id="{{ $aluno->id }}">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-warning m-2" onclick="editAluno({{ $aluno->id }})">Editar</button>
                        </div>
                        <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
                        <p><strong>Curso:</strong> {{ $aluno->curso }}</p>
                        <p><strong>Turma:</strong> {{ $aluno->turma }}</p>
                        <p><strong>CPF:</strong> {{ $aluno->cpf }}</p>
                        <p><strong>Nome dos Pais:</strong> {{ $aluno->nome_pais }}</p>
                        <p><strong>Telefone:</strong> {{ $aluno->telefone }}</p>
                        <p><strong>Telefone dos Pais:</strong> {{ $aluno->telefone_pais }}</p>
                        <p><strong>Email:</strong> {{ $aluno->email }}</p>
                        <p><strong>Email dos Pais:</strong> {{ $aluno->email_pais }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



    @include('layouts.partials.btnAlunos')
</body>
