@extends('layouts.app-master')
 
@section('content')

<div class="bg-light p-4 rounded">
    <h1>Professores</h1>
    <div class="lead">
        Dados do professor
    </div>
    
    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

	<div class="container mt-4">
        <form method="POST" action=>
            @csrf
            
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input value="{{ old('nome') }}" 
                    type="text" 
                    class="form-control" 
                    name="nome" 
                    placeholder="Nome" required>

                @if ($errors->has('nome'))
                    <span class="text-danger text-left">{{ $errors->first('nome') }}</span>
                @endif
                
            </div>
            
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input value="{{ old('cpf') }}"
                    type="text" 
                    class="form-control" 
                    name="cpf" 
                    placeholder="Cadastro de Pessoa Física" required>
                @if ($errors->has('cpf'))
                    <span class="text-danger text-left">{{ $errors->first('cpf') }}</span>
                @endif
            </div>
            
            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de nascimento</label>
                <input value="{{ old('data_nascimento') }}"
                    type="date" 
                    class="form-control" 
                    name="data_nascimento" 
                    placeholder="Data de nascimento" required>
                @if ($errors->has('data_nascimento'))
                    <span class="text-danger text-left">{{ $errors->first('data_nascimento') }}</span>
                @endif
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input value="{{ old('email') }}"
                    type="text" 
                    class="form-control" 
                    name="email" 
                    placeholder="Email" required>
                @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>
            
            <div class="mb-3">
                <label for="nome_campus" class="form-label">Nome do Campus</label>
                <input value="{{ old('nome_campus') }}" 
                    type="text" 
                    class="form-control" 
                    name="nome_campus" 
                    placeholder="Nome do Campus" required>

                @if ($errors->has('nome_campus'))
                    <span class="text-danger text-left">{{ $errors->first('nome_campus') }}</span>
                @endif
            </div>
            
            <div class="mb-3">
                <label for="departamento" class="form-label">Departamento</label>
                <input value="{{ old('departamento') }}"
                    type="text" 
                    class="form-control" 
                    name="departamento" 
                    placeholder="Departamento" required>
                @if ($errors->has('departamento'))
                    <span class="text-danger text-left">{{ $errors->first('departamento') }}</span>
                @endif
            </div>
            
            <div class="mb-3">
                <label for="area_atuacao" class="form-label">Área de atuação</label>
                <input value="{{ old('area_atuacao') }}"
                    type="text" 
                    class="form-control" 
                    name="area_atuacao" 
                    placeholder="Área de atuação" required>
                @if ($errors->has('area_atuacao'))
                    <span class="text-danger text-left">{{ $errors->first('area_atuacao') }}</span>
                @endif
            </div>			

            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('professores.index') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
	

</div>


@endsection