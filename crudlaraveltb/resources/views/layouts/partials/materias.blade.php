<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    @include('layouts.partials.essentials')
</head>
<body id="body">
    <p><a href="{{ route('password.request') }}">Esqueceu a senha?</a></p>
    <div class="d-grid justify-content-center align-items-center border border-dark border-2 border-top-0">
        <!-- Cursos -->
        <div class="text-center fs-1 fw-bold text-decoration-underline mb-lg-5">Cursos</div>
        <div class="container text-center">
            <!-- Display grid dos botões -->
            <div class="row row-cols-1 row-cols-lg-4 g-2 g-lg-3">
                <!-- Botão Informática -->
                <div class="col">
                    <a href="{{ route('info') }}" class="btn btn-outline-dark btn-lg bg-Info border-3 btn-curso">
                        <i class="fa-solid fa-laptop"></i> Informática
                    </a>
                </div>
                <!-- Botão Petróleo e Gás -->
                <div class="col">
                    <a href="{{ route('pg') }}" class="btn btn-outline-dark btn-lg bg-PetEGas border-3 btn-curso">
                        <i class="fa-solid fa-oil-well"></i> Petróleo e Gás
                    </a>
                </div>
                <!-- Botão Administração -->
                <div class="col">
                    <a href="" class="btn btn-outline-dark btn-lg bg-Adm border-3 btn-curso">
                        <i class="fa-solid fa-user-tie"></i> Administração
                    </a>
                </div>
                <!-- Botão Eletrônica -->
                <div class="col">
                    <a href="" class="btn btn-outline-dark btn-lg bg-Elet border-3 btn-curso">
                        <i class="fa-solid fa-bolt"></i> Eletrônica
                    </a>
                </div>
                <!-- Botão Mecânica -->
                <div class="col">
                    <a href="" class="btn btn-outline-dark btn-lg bg-Mec border-3 btn-curso">
                        <i class="fa-solid fa-screwdriver-wrench"></i> Mecânica
                    </a>
                </div>
                <!-- Botão Contabilidade -->
                <div class="col">
                    <a href="" class="btn btn-outline-dark btn-lg bg-Cont border-3 btn-curso">
                        <i class="fa-solid fa-camera"></i> Contabilidade
                    </a>
                </div>
                <!-- Botão Programação de Jogos Digitais -->
                <div class="col">
                    <a href="" class="btn btn-outline-dark btn-lg bg-Foto border-3 btn-curso">
                        <i class="fa-solid fa-gamepad"></i> Programação de Jogos Digitais
                    </a>
                </div>
                <!-- Botão Processos Fotográficos -->
                <div class="col">
                    <a href="" class="btn btn-outline-dark btn-lg bg-Jogos border-3 btn-curso">
                        <i class="fa-solid fa-camera"></i> Processos Fotográficos
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
