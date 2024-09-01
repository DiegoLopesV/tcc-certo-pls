@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Dados do professor</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <div>
                <b>Nome:</b> {{ $professors->nome }}
            </div>
            <div>
                <b>CPF:</b> {{ $professors->cpf }}
            </div>
            <div>
                <b>Data de nascimento:</b> {{ date('d/m/Y', strtotime($professors->data_nascimento)) }}
            </div>
            <div>
                <b>E-mail:</b> {{ $professors->email }}
            </div>
            <div>
           
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('professores.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
