@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Alterar professor</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <form method="post" action="{{ route('professores.update', $professor->id) }}">
                @method('patch')
                @csrf
                
                <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input value="{{ $professor->nome }}" 
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
                <input value="{{ $professor->cpf }}"
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
                <input value="{{ $professor->data_nascimento }}"
                    type="date" 
                    class="form-control" 
                    name="data_nascimento" 
                    placeholder="Data_Nascimento" required>
                @if ($errors->has('data_nascimento'))
                    <span class="text-danger text-left">{{ $errors->first('data_nascimento') }}</span>
                @endif
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input value="{{ $professor->email }}"
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
                <input value="{{ $professor->lotacao->nome_campus }}" 
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
                <input value="{{ $professor->lotacao->departamento }}"
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
                <input value="{{ $professor->lotacao->area_atuacao }}"
                    type="text" 
                    class="form-control" 
                    name="area_atuacao" 
                    placeholder="Area_Atuacao" required>
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
