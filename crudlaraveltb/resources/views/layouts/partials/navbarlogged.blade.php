<!-- Nova Navbar-->

<div class="border border-dark border-2 border-bottom-0">
    <!--Off Canvas -->
    <nav class="navbar navbar-expand-lg nav-underline  ">
        <div class="container-fluid">
            <!--Logo IFPR -->
            <div class="">
                <a class="navbar-brand me-auto " href="{{ route('usuarios.index') }}"> <img
                        src="/assets/img/funcionaNmrl.png" class="img-fluid m-3 me-5 top-0 start-0" alt="logo ifpr"></a>
            </div>


            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                @if(auth()->check() && auth()->user()->access_level === 'admin')
    <div class="offcanvas-body">
        <ul class="navbar-nav align-items-center justify-content-center flex-grow-1 pe-3 mx-3">
            <li class="nav-item">
                <a class="nav-link mx-4 fs-5 text-black" aria-current="page" href="{{ route('usuarios.index') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-4 fs-5 text-black" href="{{ route('ocorrencias.index') }}">Ocorrências</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-4 fs-5 text-black" href="{{ route('enfermaria.index') }}">Enfermaria</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-4 fs-5 text-black" href="{{ route('graficos') }}">Gráficos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-4 fs-5 text-black" href="{{ route('alunos.index') }}">Alunos</a>
            </li>
        </ul>
        <a href="{{ route('perfil.index') }}"> <i class="perfil fa-regular fa-circle-user fs-1 mx-3 mt-2"></i></a>
        @auth
            <div class="fs-5 m-3"> {{ auth()->user()->email }}</div>
            <p class="fs-5 m-3">IFPR</p>
        @endauth
    </div>
@endif

<div class="offcanvas-footer">
    @auth
        <a href="{{ route('logout.perform') }}" class="btn btn-outline-dark fs-5 m-2 logout">Logout</a>
    @endauth
</div>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>


</div>

<!--Pesquisar-->
<div id="" class=" align-items-center border border-dark border-2 mb-0 p-1">
	<form action="{{ route('ocorrencias.index') }}" method="GET" class="d-flex rounded-4" role="search">
	<input id="pesquisa" name="search" class="my-1 p-1 w-100 border border-dark rounded-4 text-center" type="search" placeholder="Pesquisar..." aria-label="Search">
	</form>
</div>