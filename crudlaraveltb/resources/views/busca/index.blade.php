<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SGA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.partials.essentials')
</head>

<body id="body">

    <!-- Navbar -->
    @include('layouts.partials.navbarlogged')

    <!-- Título da página -->
    <div class="m-4 text-center fs-1 fw-bold">
        Resultado Pesquisa
    </div>

    <!-- Seção de Botões -->
    <div class="d-flex align-items-center justify-content-center border border-dark border-2 p-2 text-center">
        <!-- Botão para emitir relatório -->
        @include('layouts.partials.btnEmitirRelat')
        <a href="{{ route('ocorrencias.pdf', ['download' => 'pdf']) }}" id="pdf" class="border border-dark border-1 border rounded-2 m-1 fs-2 text-wrap fw-bold"  >
            <i class="fa-solid fa-file-pdf me-1"></i> PDF
        </a>
        
        <!-- Botão para abrir modal de filtro -->
        <button id="filtrar" class="border border-dark border-1 border rounded-2 m-1 fs-2 fw-bold" data-bs-toggle="modal" data-bs-target="#filterModal">
            <i class="fa-solid fa-list me-1"></i> Filtrar
        </button>
        
        <!-- Botão para adicionar ocorrência -->
        <button id="add" class="border border-dark border-1 border rounded-2 m-1 fs-2 text-wrap fw-bold" data-bs-toggle="modal" data-bs-target="#infoModal">
            Adicionar Ocorrência <i class="fa-solid fa-plus ms-1"></i>
        </button>
    </div>

    <!-- Seção para ordenação -->
    <div class="border border-dark border-2 border-top-0">
        <!-- Link que abre o dropdown -->
        <a class="ms-1 fs-2 text-dark text-decoration-none" href="#" id="ordenarLink">Ordenar ▼</a>
    </div>

    <!-- Container para informações -->
    <div id="ocorrenciaContainer" class="mt-4 d-flex flex-wrap mx-2 gap-2">
        @foreach($ocorrencias as $ocorrencia)
        <div class="ocorrencia-card rounded text-center border border-dark border-2 excesso" data-id="{{ $ocorrencia->id }}">
            <div class="d-flex justify-content-end">
                Ocorrência
                @if(auth()->check() && auth()->user()->key === '987xyz')
                    <button class="btn btn-sm btn-warning m-2" onclick="editOcorrencia({{ $ocorrencia->id }})">Editar</button>
                @endif
            </div>

                <p><strong>Título:</strong> {{ $ocorrencia->titulo }}</p>
                <p><strong>Descrição:</strong> {{ $ocorrencia->descricao }}</p>
                <p><strong>Participantes:</strong> {{ $ocorrencia->participantes }}</p>
                <p><strong>Turma:</strong> {{ $ocorrencia->turma }}</p>
                <p><strong>Data:</strong> {{ $ocorrencia->created_at }}</p>
                <p><strong>Status:</strong> 
                @php
                
                if($ocorrencia->status == 0){
                    echo 'Concluído';
                }
                if($ocorrencia->status == 1){
                    echo 'Em Andamento';
                }
                if($ocorrencia->status == 2){
                    echo 'Pendente';
                }
                
                @endphp</p>
            </div>
        @endforeach
        @foreach($enfermarias as $enfermaria)
        <div class="aluno-card rounded text-center border border-dark border-2 excesso" data-id="{{ $enfermaria->id }}">
            <div class="d-flex justify-content-start">
                Atendimento Enfermaria

                
                @if(auth()->check() && auth()->user()->key === '987xyz')
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-warning m-2"
                        onclick="editEnfermaria({{ $enfermaria->id }})">Editar</button>
                </div>
                @endif
            </div>

            <p><strong>Título:</strong> {{ $enfermaria->titulo }}</p>
                <p><strong>Descrição:</strong> {{ $enfermaria->descricao }}</p>
                <p><strong>Aluno Atendido:</strong> {{ $enfermaria->pessoas }}</p>
                <p><strong>Turma:</strong> {{ $enfermaria->turma }}</p>
                <p><strong>Data:</strong> {{ $enfermaria->data }}</p>
                <p><strong>Status:</strong> {{ $enfermaria->status }}</p>

            </div>
        @endforeach
        @foreach ($alunos as $aluno)
            @if ($aluno->turma !== 'passou de ano') <!-- Manter o filtro original -->
                <div class="aluno-card rounded text-center border border-dark border-2 excesso"
                     data-bs-toggle="modal" data-bs-target="#alunoModalInfo"
                     data-id="{{ $aluno->id }}"
                     style="background-color: {{ $aluno->napne === 'Sim' ? '#cce7ff' : 'transparent' }};">
                    <!-- O card agora é clicável para abrir o modal -->
                    <img src="{{ $aluno->foto }}" alt="Foto do Aluno" class="img-fluid img-preview mt-4 mb-3" style="cursor: pointer;">
                    <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
                    <p><strong>Curso:</strong> {{ $aluno->curso }}</p>
                    <p><strong>Turma:</strong> {{ $aluno->turma }}</p>
                    <p><strong>Data de Nascimento:</strong> {{ $aluno->data_nascimento }}</p>

                    
                </div>
            @endif
        @endforeach
        
    </div>

    <!-- Botões adicionais -->
    @include('layouts.partials.btnOco')
    @include('layouts.partials.btnFiltro')

    <script src="{{ asset('assets/js/formOco.js') }}"></script>
    <script src="{{ asset('assets/js/editOco.js') }}"></script>

    <script>
        const pdfButton = document.getElementById('pdf');
        console.log(pdfButton); // Verifica se o botão foi encontrado
        console.log(getComputedStyle(pdfButton).backgroundColor); // Verifica a cor de fundo
    </script>
</body>
@include('layouts.partials.btnOrdenar')

</html>
