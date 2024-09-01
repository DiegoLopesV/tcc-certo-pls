@extends('layouts.app-master')


@section('content')

<div class="bg-light p-4 rounded">
    <h1>Usuários</h1>
    <div class="lead">
        Dados do Usuário
    </div>
    
    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

	<div class="container mt-4">
            <form method="POST" action="">
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
                    <label for="email" class="form-label">E-mail</label>
                    <input value="{{ old('email') }}"
                        type="text" 
                        class="form-control" 
                        name="email" 
                        placeholder="E-mail" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input value="{{ old('password') }}"
                        type="password" 
                        class="form-control" 
                        name="password" 
                        placeholder="Senha" required>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                
                
                <div class="mb-3">
                    <label for="cep" class="form-label">Cep</label>
                    <input value="{{ old('cep') }}"
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
                    <input value="{{ old('logradouro') }}"
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
                    <input value="{{ old('numero') }}"
                        type="text" 
                        class="form-control" 
                        name="numero" 
                        placeholder="Número" required>
                    @if ($errors->has('numero'))
                        <span class="text-danger text-left">{{ $errors->first('numero') }}</span>
                    @endif
                </div>
                
                <button type="submit" class="btn btn-success">
                	Salvar
                </button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
	
</div>

@endsection

