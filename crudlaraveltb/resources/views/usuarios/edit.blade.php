@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Alterar usuário</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <form method="post" action="{{ route('usuarios.update', $user->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input value="{{ $user->nome }}" 
                        type="text" 
                        class="form-control" 
                        name="nome"
                        placeholder="Nome" required>

                    @if ($errors->has('nome'))
                        <span class="text-danger text-left">{{ $errors->first('nome') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input value="{{ $user->email }}"
                        type="text" 
                        class="form-control" 
                        name="email" 
                        placeholder="E-mail" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                
                
                <div class="mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input value="{{ $user->endereco->cep }}"
                        type="text"
                        class="form-control" 
                        name="cep" 
                        placeholder="Código de Endereçamento Postal" required>
                    @if ($errors->has('cep'))
                        <span class="text-danger text-left">{{ $errors->first('cep') }}</span>
                    @endif
                </div>
                
                <div class="mb-3">
                    <label for="logradouro" class="form-label">Logradouro</label>
                    <input value="{{ $user->endereco->logradouro }}"
                        type="text"
                        class="form-control" 
                        name="logradouro"
                        placeholder="Logradouro" required>
                    @if ($errors->has('logradouro'))
                        <span class="text-danger text-left">{{ $errors->first('logradouro') }}</span>
                    @endif
                </div>
                
                <div class="mb-3">
                    <label for="numero" class="form-label">Número</label>
                    <input value="{{ $user->endereco->numero }}"
                        type="text"
                        class="form-control" 
                        name="numero" 
                        placeholder="Número" required>
                    @if ($errors->has('numero'))
                        <span class="text-danger text-left">{{ $errors->first('numero') }}</span>
                    @endif
                </div>
                
                
                
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-danger">Cancelar</a>
            </form>
        </div>

    </div>
@endsection
