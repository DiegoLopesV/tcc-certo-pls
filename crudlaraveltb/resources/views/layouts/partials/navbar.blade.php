
<div class="Aviso position-absolute top-50 start-50 translate-middle ">

	<img class="form-group form-floating mb-3 w-25 mx-auto" src="{!! url('assets/img/ifpr_vertical.svg') !!}" alt="" width="202" height="187">

	<div class="fs-5">Site restrito para os servidores e alunos do Instituto Federal do Paraná Campus Curitiba.</div>
	<div class="fs-5 mb-5">Entre ou faça uma conta para poder utilizar o sistema</div>

		@guest
		  <a href="{{ route('register.perform') }}" class="btn btn-outline-success btn-lg me-2 text-align-center  entrar ">Registrar</a>
		@endguest

		@guest
		<a href="{{ route('login.perform') }}" class="btn btn-outline-success btn-lg entrar ">Entrar</a>
		@endguest
</div>

