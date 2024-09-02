@include('layouts.partials.essentials')

<body id="body">
    @include('layouts.partials.navbarlogged')

    <div class="d-flex text-center border border-dark border-3 border-top-0">
        <div class="border border-dark border-2 m-3 box01 p-3 fs-2 rounded" id="ic">
            <i class="fa-solid fa-camera"></i> Processos Fotográficos
        </div>

        @include('layouts.partials.btnTurmas')
    </div>

    <div class="border border-dark border-3 border-top-0 align-items-center justify-content-center text-center p-2">
        <!-- Turmas -->
        <span class="fs-1">Turmas</span>
        <div class="d-flex mt-2">
            <!-- Botões para as turmas -->
            <a href="{{ route('pf1') }}" class="btn-turma">
                <i id="ic" class="fa-solid fa-camera"></i> Processos Fotográficos 1
            </a>
            <a href="{{ route('pf2') }}" class="btn-turma">
                <i id="ic" class="fa-solid fa-camera"></i> Processos Fotográficos 2
            </a>
            <a href="{{ route('pf3') }}" class="btn-turma">
                <i id="ic" class="fa-solid fa-camera"></i> Processos Fotográficos 3
            </a>
        </div>
    </div>
</body>