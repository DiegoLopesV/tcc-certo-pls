@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Alterar disciplina</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <form method="post" action="{{ route('disciplinas.update', $disciplina->id) }}">
                @method('patch')
                @csrf
                
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input value="{{ $disciplina->nome }}" 
                    type="text" 
                    class="form-control" 
                    name="nome" 
                    placeholder="Nome" required>

                @if ($errors->has('nome'))
                    <span class="text-danger text-left">{{ $errors->first('nome') }}</span>
                @endif
            </div>
            
            <div class="mb-3">
                <label for="curso" class="form-label">Curso</label>
                <input value="{{ $disciplina->curso }}"
                    type="text" 
                    class="form-control" 
                    name="curso" 
                    placeholder="Curso" required>
                @if ($errors->has('curso'))
                    <span class="text-danger text-left">{{ $errors->first('curso') }}</span>
                @endif
            </div>
            
            <div class="mb-3">
                <label for="sigla" class="form-label">Sigla</label>
                <input value="{{ $disciplina->sigla }}"
                    type="text" 
                    class="form-control" 
                    name="sigla" 
                    placeholder="Sigla" required>
                @if ($errors->has('sigla'))
                    <span class="text-danger text-left">{{ $errors->first('sigla') }}</span>
                @endif
            </div>
            
            <div class="mb-3">
                <label for="carga_horaria" class="form-label">Carga horária</label>
                <input value="{{ $disciplina->carga_horaria }}"
                    type="number" 
                    class="form-control" 
                    name="carga_horaria" 
                    placeholder="Carga horária" required>
                @if ($errors->has('carga_horaria'))
                    <span class="text-danger text-left">{{ $errors->first('carga_horaria') }}</span>
                @endif
            </div>      
                
                

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ route('disciplinas.index') }}" class="btn btn-danger">Cancelar</a>
            </form>
        </div>

    </div>
@endsection
