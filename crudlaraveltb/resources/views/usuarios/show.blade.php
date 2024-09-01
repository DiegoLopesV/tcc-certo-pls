@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Dados do usuário</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <div>
                <b>Nome:</b> {{ $user->nome }}
            </div>
            <div>
                <b>E-mail:</b> {{ $user->email }}
            </div>
            <div>
                <b>CEP:</b> {{ $user->endereco->cep }}
            </div>
            <div>
                <b>Logradouro:</b> {{ $user->endereco->logradouro }}
            </div>
            <div>
                <b>Número:</b> {{ $user->endereco->numero }}
            </div>
            
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
