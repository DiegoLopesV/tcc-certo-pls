@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Dados da solicitação</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <div>
                <b>Título:</b> {{ $solicitacao->titulo }}
            </div>
            <div>
                <b>Status:</b> {{ $solicitacao->status }}
            </div>
            <div>
                <b>Data:</b> {{ date('d/m/Y', strtotime($solicitacao->data)) }}
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('solicitacoes.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
