@extends('layouts.auth-master')
 
@section('content')
<center>
	<form method="post" action="{{ route('register.perform') }}">
 
    	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
    	<img class="mb-4" src="{!! url('assets/img/ifpr_vertical.svg') !!}" alt="" width="202" height="187">
       
    	<h1 class="h3 mb-3 fw-normal">Cadastro de Servidor</h1>

		<h5 class="mb-3">É Aluno?  <a href="{{route('qrRegistrarAluno')}}">clique aqui para se registrar</a></h5> 
 
          	<div class="form-group form-floating mb-3 w-25 mx-auto">
        	<input type="text" class="form-control" name="nome" value="{{ old('nome') }}" placeholder="Nome" required="required" autofocus>
        	<label for="floatingNome">Nome</label>
        	@if ($errors->has('nome'))
            	<span class="text-danger text-left">{{ $errors->first('nome') }}</span>
        	@endif
    	</div>
 
		 <div class="form-group form-floating mb-3 w-25 mx-auto">
        	<input type="cpf" class="form-control" name="cpf" value="{{ old('cpf') }}" placeholder="CPF" required="required">
        	<label for="floatingCPF">CPF</label>
        	@if ($errors->has('cpf'))
            	<span class="text-danger text-left">{{ $errors->first('cpf') }}</span>
        	@endif
    	</div>

		<div class="form-group form-floating mb-3 w-25 mx-auto">
        	<input type="nome_pais" class="form-control" name="nome_pais" value="{{ old('nome_pais') }}" placeholder="Nome dos pais" required="required">
        	<label for="floatingNomePais">Nome dos pais</label>
        	@if ($errors->has('nome_pais'))
            	<span class="text-danger text-left">{{ $errors->first('nome_pais') }}</span>
        	@endif
    	</div>

		<div class="form-group form-floating mb-3 w-25 mx-auto">
        	<input type="telefone" class="form-control" name="telefone" value="{{ old('telefone') }}" placeholder="Telefone" required="required">
        	<label for="floatingTelefone">Telefone</label>
        	@if ($errors->has('telefone'))
            	<span class="text-danger text-left">{{ $errors->first('telefone') }}</span>
        	@endif
    	</div>

		<div class="form-group form-floating mb-3 w-25 mx-auto">
        	<input type="telefone_pais" class="form-control" name="telefone_pais" value="{{ old('telefone_pais') }}" placeholder="Telefone dos Pais" required="required">
        	<label for="floatingtelefonePais">Telefone dos Pais</label>
        	@if ($errors->has('telefone_pais'))
            	<span class="text-danger text-left">{{ $errors->first('telefone_pais') }}</span>
        	@endif
    	</div>

    	<div class="form-group form-floating mb-3 w-25 mx-auto">
        	<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email@exemplo.com" required="required">
        	<label for="floatingEmail">E-mail</label>
        	@if ($errors->has('email'))
            	<span class="text-danger text-left">{{ $errors->first('email') }}</span>
        	@endif
    	</div>
       
		<div class="form-group form-floating mb-3 w-25 mx-auto">
        	<input type="email_pais" class="form-control" name="email_pais" value="{{ old('email_pais') }}" placeholder="email@exemplo.com" required="required">
        	<label for="floatingEmailPais">E-mail dos Pais</label>
        	@if ($errors->has('email_pais'))
            	<span class="text-danger text-left">{{ $errors->first('email_pais') }}</span>
        	@endif
    	</div>

    	<div class="form-group form-floating mb-3 w-25 mx-auto">
        	<input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
        	<label for="floatingPassword">Senha</label>
        	@if ($errors->has('password'))
            	<span class="text-danger text-left">{{ $errors->first('password') }}</span>
        	@endif
    	</div>
 
    	<div class="form-group form-floating mb-3 w-25 mx-auto">
    		<input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
    		<label for="floatingConfirmPassword">Confirme a senha</label>
    		@if ($errors->has('password_confirmation'))
				<span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
    		@endif
		</div>

		<div class="form-group form-floating mb-3 w-25 mx-auto">
    		<input type="text" class="form-control" name="key" value="{{ old('key') }}" placeholder="Chave" required="required">
    		<label for="floatingKey">Chave</label>
    		@if ($errors->has('key'))
        		<span class="text-danger text-left">{{ $errors->first('key') }}</span>
    		@endif
		</div>

 
    	<div class="form-group form-floating mb-3 mx-auto">
        	<button class="btn btn-lg btn-primary w-25 mx-auto" type="submit">Registrar</button>
        	<br/><br/>
        	<a href="{{ route('home.index') }}" class="btn btn-lg btn-secondary w-25 mx-auto">Página Inicial</a>
          	</div>
			  <p> Já possui uma conta? Entrar <a href="{{ route('login.perform') }}"> aqui</a></p>
       
    	@include('auth.partials.copy')
	</form>
</center>
@endsection
