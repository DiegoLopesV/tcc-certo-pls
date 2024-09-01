<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('layouts.partials.essentials')
</head>

<body id="body">
    <!-- Navbar -->
    @include('layouts.partials.navbarlogged')


    <div class="m-2 p-2 text-center">
        <h1>Estatísticas</h1>
    </div>

    <div class="text-center">
        <div>
            <a href="{{ route('graficosEnf') }}"> <button id="btn02" class="p-3  border-1 rounded m-2">
                    Enfermaria</button></a>
        </div>
        <div>
            <a href="{{ route('graficosOco') }}"> <button id="btn02" class="p-3  border-1 rounded m-2">
                    Ocorrências</button></a>
        </div>
    </div>

</body>

</html>
