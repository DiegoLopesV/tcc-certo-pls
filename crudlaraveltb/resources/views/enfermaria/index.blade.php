<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enfermaria</title>
    @include('layouts.partials.essentials')
</head>

<body id="body">

    @include('layouts.partials.navbarlogged')
    <!-- Texto escrito Ocorrências -->
    <div class=" m-4 text-center  fs-1 fw-bold ">Enfermaria</div>

    <!-- Botões abaixo do texto de ocorrências -->
    <div class="d-flex align-items-center justify-content-center border border-dark border-2 p-2 text-center">

        @include('layouts.partials.btnEmitirRelat')
        <!-- Botão para emitir relatório -->
        @include('layouts.partials.btnEmitirRelat')
        
        <a href="{{ route('enfermaria.pdf', ['download' => 'pdf']) }}" class="border border-dark border-1 border rounded-2 m-1 fs-2 fw-bold bg-white text-dark btn btn-sm float-left">
            <i class="fa-solid fa-file-pdf me-1"></i> PDF
            
        </a>

        <button id="filtrar" class="border border-dark border-1 border rounded-2 m-1 fs-2 fw-bold"
            data-bs-toggle="modal" data-bs-target="#filterModal"> <i class="fa-solid fa-list me-1"></i> Filtrar</button>

        <button id="add" class=" border border-dark border-1 border rounded-2 m-1 fs-2 text-wrap fw-bold"
            data-bs-toggle="modal" data-bs-target="#infoModal"> Adicionar Atestados <i
                class="fa-solid fa-plus ms-1"></i></button>

    </div>


    <div class="border border-dark border-2 border-top-0">
        <!-- Link que abre o dropdown -->
        <a class="ms-1 fs-2 text-dark text-decoration-none" href="#" id="ordenarLink">Ordenar ▼</a>
    </div>



    </div>

    <!-- Container com os card -->
    <div id="enfermariaContainer" class="mt-4 d-flex flex-wrap mx-2 gap-2">
        @foreach ($enfermaria as $enfermaria)
            <div class="aluno-card rounded text-center border border-dark border-2 excesso"
                data-id="{{ $enfermaria->id }}">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-warning m-2"
                        onclick="editEnfermaria({{ $enfermaria->id }})">Editar</button>
                </div>
                <p><strong>Título:</strong> {{ $enfermaria->titulo }}</p>
                <p><strong>Descrição:</strong> {{ $enfermaria->descricao }}</p>
                <p><strong>Aluno Atendido:</strong> {{ $enfermaria->pessoas }}</p>
                <p><strong>Turma:</strong> {{ $enfermaria->turma }}</p>
                <p><strong>Data:</strong> {{ $enfermaria->data }}</p>
                <p><strong>Status:</strong> {{ $enfermaria->status }}</p>
            </div>
        @endforeach
    </div>

    @include('layouts.partials.btnEnf')





</body>
@include('layouts.partials.btnFiltro')
@include('layouts.partials.btnOrdenar')

</html>
