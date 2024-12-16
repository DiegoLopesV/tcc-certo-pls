<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>

<body>



	@extends('layouts.auth-master')
	@include('layouts.partials.essentials')

	@section('content')
	<div class="text-center">
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form method="post" action="{{ route('register.perform') }}" enctype="multipart/form-data">>

			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<img class="mb-4" src="{!! url('assets/img/ifpr_vertical.svg') !!}" alt="" width="202" height="187">

			<h1 class="h3 mb-3 fw-normal">Cadastro de Servidor</h1>

			<h5 class="mb-3">É Aluno? <a href="{{route('qrRegistrarAluno')}}">clique aqui para se registrar</a></h5>

			<div class="form-group form-floating mb-3 w-25 mx-auto">
				<input type="text" class="form-control" name="nome" value="{{ old('nome') }}" placeholder="Nome"
					required="required" autofocus>
				<label for="floatingNome">Nome</label>
				@if ($errors->has('nome'))
					<span class="text-danger text-left">{{ $errors->first('nome') }}</span>
				@endif
			</div>

			<div class="form-group form-floating mb-3 w-25 mx-auto">
				<input type="cpf" class="form-control" name="cpf" value="{{ old('cpf') }}" placeholder="CPF"
					required="required">
				<label for="floatingCPF">CPF</label>
				@if ($errors->has('cpf'))
					<span class="text-danger text-left">{{ $errors->first('cpf') }}</span>
				@endif
			</div>



			<div class="form-group form-floating mb-3 w-25 mx-auto">
				<input type="telefone" class="form-control" name="telefone" value="{{ old('telefone') }}"
					placeholder="Telefone" required="required">
				<label for="floatingTelefone">Telefone</label>
				@if ($errors->has('telefone'))
					<span class="text-danger text-left">{{ $errors->first('telefone') }}</span>
				@endif
			</div>


			<div class="form-group form-floating mb-3 w-25 mx-auto">
				<input type="email" class="form-control" name="email" value="{{ old('email') }}"
					placeholder="email@exemplo.com" required="required">
				<label for="floatingEmail">E-mail</label>
				@if ($errors->has('email'))
					<span class="text-danger text-left">{{ $errors->first('email') }}</span>
				@endif
			</div>

			<div class="form-group form-floating mb-3 w-25 mx-auto">
				<input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
				<label for="data_nascimento">Data de Nascimento</label>
			</div>


			<div class="form-group form-floating mb-3 w-25 mx-auto">
				<input type="text" class="form-control" name="numeroDeContrato" placeholder="numeroDeContrato"
					required="required" autofocus>
				<label for="floatingNome">SIAP</label>
			</div>


			<div class="form-group form-floating mb-3 w-25 mx-auto">
				<input type="password" class="form-control" name="password" value="{{ old('password') }}"
					placeholder="Password" required="required">
				<label for="floatingPassword">Senha</label>
				@if ($errors->has('password'))
					<span class="text-danger text-left">{{ $errors->first('password') }}</span>
				@endif
			</div>

			<div class="form-group form-floating mb-3 w-25 mx-auto">
				<input type="password" class="form-control" name="password_confirmation"
					value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
				<label for="floatingConfirmPassword">Confirme a senha</label>
				@if ($errors->has('password_confirmation'))
					<span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
				@endif
			</div>

			<div class="form-group form-floating mb-3 w-25 mx-auto">
				<input type="text" class="form-control" name="key" value="{{ old('key') }}" placeholder="Chave"
					required="required">
				<label for="floatingKey">Chave</label>
				@if ($errors->has('key'))
					<span class="text-danger text-left">{{ $errors->first('key') }}</span>
				@endif
			</div>


			<div class="form-floating mb-3">
				<input type="file" id="foto" name="foto" accept="image/*">
				<div id="imagePreviewContainer">
					<img id="imagePreview" class="img-preview" alt="">
				</div>
			</div>


			<div class="form-group form-floating mb-3 mx-auto">
				<button class="btn btn-lg btn-primary w-25 mx-auto" type="submit">Registrar</button>
				<br /><br />
				<a href="{{ route('home.index') }}" class="btn btn-lg btn-secondary w-25 mx-auto">Página Inicial</a>
			</div>
			<p> Já possui uma conta? Entrar <a href="{{ route('login.perform') }}"> aqui</a></p>

			@include('auth.partials.copy')
		</form>
	</div>

	<script src="{{ asset('assets/js/imagePreview.js') }}"></script>
	@endsection



</body>

</html>