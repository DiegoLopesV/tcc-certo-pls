@include('layouts.partials.essentials')

<body id="body">
    @include('layouts.partials.navbarlogged')

    <div class="d-flex text-center border border-dark border-3 border-top-0">
        <div class="border border-dark border-2 m-3 box01 p-2 fs-1 rounded" id="ic">
            <i class="fa-solid fa-calculator"></i> Contabilidade
        </div>

        @include('layouts.partials.btnTurmas')
    </div>

    <div class="border border-dark border-3 border-top-0 align-items-center justify-content-center text-center p-2">
        <!-- Turmas -->
        <span class="fs-1">Turmas</span>
        <div class="d-flex mt-2">
            <!-- Botões para as turmas -->
            <a href="{{ route('cont1') }}" class="btn-turma">
                <i id="ic" class="fa-solid fa-calculator"></i> Contabilidade 1
            </a>
            <a href="{{ route('cont2') }}" class="btn-turma">
                <i id="ic" class="fa-solid fa-calculator"></i> Contabilidade 2
            </a>
            <a href="{{ route('cont3') }}" class="btn-turma">
                <i id="ic" class="fa-solid fa-calculator"></i> Contabilidade 3
            </a>
        </div>
    </div>
</body>
