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
    <title>Servidores</title>

</head>

<body id="body">

    <div>
        
    <div class="position-relative m-3 border border-dark border-3 rounded p-5">
        <div class="fs-1 mb-3">Lista de todos os Servidores <br></div>

        <!-- Botões posicionados no canto superior direito -->
@if(auth()->check() && auth()->user()->key === '987xyz')
    <div class="position-absolute top-0 end-0 mx-3">
        <button class="rounded AddALunos mb-2" data-bs-toggle="modal" data-bs-target="#ServidorModal">Criar Chave para Servidor</button>
        <a href="">
            <button class="rounded AddALunos">Ex Servidores</button>
        </a>     
    </div>
@endif


        <div class="alunos-container d-flex">
    <!-- Container para adicionar o novo conteúdo -->
    <div id="alunoContainer" class="mt-4 d-flex flex-wrap mx-2 gap-2">
        @if($professores && count($professores) > 0)
        @foreach($professores as $professor)
            <div class="servidor-card rounded text-center border border-dark border-2 excesso"
                 data-bs-toggle="modal" data-bs-target="#servidorModalInfo">
                 <img src="{{ asset($professor->foto) }}" alt="Foto do Professor" class="img-fluid img-preview mt-4 mb-3" style="cursor: pointer;">
                 <p><strong>Nome:</strong> {{ $professor->nome }}</p>
                 <p><strong>Email:</strong> {{ $professor->email }}</p>
                 <p><strong>CPF:</strong> {{ $professor->cpf }}</p>
                 <p><strong>Telefone:</strong> {{ $professor->telefone }}</p>
                 <p><strong>Data de Nascimento:</strong> {{ $professor->data_nascimento }}</p>
                 <p><strong>Chave:</strong> {{ $professor->chave }}</p>
            </div>
        @endforeach
    @else
        <p>Nenhum professor encontrado.</p>
    @endif
    
    </div>
</div>

    </div>
    @include('layouts.partials.modalServidores')

    


</div>


</body>
</html>