@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Dados da disciplina</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <div>
                <b>Nome:</b> {{ $disciplina->nome }}
            </div>
            <div>
                <b>Curso:</b> {{ $disciplina->curso }}
            </div>
            <div>
                <b>Sigla:</b> {{ $disciplina->sigla }}
            </div>
            <div>
                <b>Carga horária:</b> {{ $disciplina->carga_horaria }}
            </div>    
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('disciplinas.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
