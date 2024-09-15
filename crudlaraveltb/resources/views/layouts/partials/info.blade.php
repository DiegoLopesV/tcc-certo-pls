@include('layouts.partials.essentials')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SGA</title>
</head>

<body id="body">
    @include('layouts.partials.navbarlogged')

    <div class="d-flex text-center border border-dark border-3 border-top-0">
        <div class="border border-dark border-2 m-3 box01 p-2 fs-1 rounded" id="ic">
            <i class="fa-solid fa-laptop"></i> Informática
        </div>

        @include('layouts.partials.btnTurmas')
    </div>

    <div class="border border-dark border-3 border-top-0 align-items-center justify-content-center text-center p-2">
        <!-- Turmas -->
        <span class="fs-1">Turmas</span>
        <div class="d-flex mt-2">
            <!-- Botões para as turmas -->
            <a href="{{ route('turma', ['turma' => 'info1']) }}" class="btn-turma">
                <i id="ic" class="fa-solid fa-laptop"></i> Informática 1
            </a>
            <a href="{{ route('turma', ['turma' => 'info2']) }}" class="btn-turma">
                <i id="ic" class="fa-solid fa-laptop"></i> Informática 2
            </a>
            <a href="{{ route('turma', ['turma' => 'info3']) }}" class="btn-turma">
                <i id="ic" class="fa-solid fa-laptop"></i> Informática 3
            </a>
            <a href="{{ route('turma', ['turma' => 'info4']) }}" class="btn-turma">
                <i id="ic" class="fa-solid fa-laptop"></i> Informática 4
            </a>
        </div>
    </div>
</body>
</html>