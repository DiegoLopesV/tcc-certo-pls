<!-- Nova Navbar -->
<div class="border border-dark border-2 border-bottom-0">
    <!-- Off Canvas -->
    <nav class="navbar navbar-expand-lg nav-underline">
        <div class="container-fluid">
            <!-- Logo IFPR -->
            <div>
                <a class="navbar-brand me-auto" href="{{ route('usuarios.index') }}">
                    <img src="/assets/img/funcionaNmrl.png" class="img-fluid m-3 me-5 top-0 start-0" alt="logo ifpr">
                </a>
            </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                
                @if(auth()->check())
                <div class="offcanvas-body">
                    <ul class="navbar-nav align-items-center justify-content-center flex-grow-1 pe-3 mx-3">
                        @if(auth()->user()->key === '987xyz')
                            <!-- Links visíveis apenas para usuários com a chave '987xyz' -->
                            <li class="nav-item">
                                <a class="nav-link mx-4 fs-5 text-black" aria-current="page" href="{{ route('usuarios.index') }}">Home</a>
                            </li>
                            <li class="nav-item">
    <a class="nav-link mx-4 fs-5 text-black" href="{{ route('ocorrencias.index') }}">
        Ocorrências
        @if(auth()->user()->unreadNotifications->count())
            <span class="badge bg-danger rounded-circle position-absolute" style="top: -5px; right: -10px;"></span>
        @endif
    </a>
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
                        @elseif(auth()->user()->key === 'cba321')
                            <!-- Links visíveis apenas para usuários com a chave 'cba321' -->
                            <li class="nav-item">
                                <a class="nav-link mx-4 fs-5 text-black" aria-current="page" href="{{ route('home.index') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-4 fs-5 text-black" href="{{ route('alunos.index') }}">Alunos</a>
                            </li>
                        @elseif(auth()->user()->key === 'abc123')
                            <!-- Links visíveis apenas para usuários com a chave 'abc123' -->
                            <li class="nav-item">
                                <a class="nav-link mx-4 fs-5 text-black" aria-current="page" href="{{ route('home.index') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-4 fs-5 text-black" href="{{ route('ocorrencias.index') }}">Ocorrências</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-4 fs-5 text-black" href="{{ route('alunos.index') }}">Alunos</a>
                            </li>
                        @elseif(auth()->user()->key === 'aluno2024')
                            <!-- Apenas o logout para usuários com a chave 'aluno2024' -->
                            <!-- Não exibe mais nada além do logout -->
                        @endif
                    </ul>

                    <!-- Ícone de Sino de Notificações e Perfil -->
                    <div class="d-flex align-items-center">
                    <!-- Ícone de Notificações (Sino) Verde -->
                        <!--<a href="{{ route('perfil.index') }}" class="position-relative" style="text-decoration: none;">
                            <i class="fa-regular fa-bell fs-2 mx-3 text-success"></i> -->
                            @if(auth()->user()->unreadNotifications->count())
                                <span class="badge bg-danger rounded-circle position-absolute" style="top: 0; right: 0; width: 15px; height: 15px;"></span>
                             @endif
                        </a>
                    <!-- Ícone de Perfil Verde -->
                        <a href="{{ route('perfil.index') }}" style="text-decoration: none;"> 
                            <i class="perfil fa-regular fa-circle-user fs-1 mx-3 mt-2 text-success"></i>
                        </a>
                    </div>

                    @auth
                        <div class="fs-5 m-3"> {{ auth()->user()->email }}</div>
                        <p class="fs-5 m-3">IFPR</p>
                    @endauth

                    @auth
                    <a href="{{ route('logout.perform') }}" class="btn btn-outline-dark fs-5 m-2 logout">Logout</a>
                @endauth
                </div>
                @endif

                <div class="offcanvas-footer">

                </div>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</div>

<!-- Pesquisar -->
<div id="" class="align-items-center border border-dark border-2 mb-0 p-1">
    <form action="{{ route('busca.index') }}" method="GET" class="d-flex rounded-4" role="search">
        <input id="pesquisa" name="search" class="my-1 p-1 w-100 border border-dark rounded-4 text-center" type="search" placeholder="Pesquisar..." aria-label="Search">
    </form>
</div>

<!-- Incluir Axios via CDN -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ocorrenciasLink = document.querySelector('a[href="{{ route('ocorrencias.index') }}"]');
    if (ocorrenciasLink) {
        ocorrenciasLink.addEventListener('click', function() {
            axios.post('/notifications/read').then(response => {
                // Lógica para atualizar a interface, se necessário
            });
        });
    }
});
</script>