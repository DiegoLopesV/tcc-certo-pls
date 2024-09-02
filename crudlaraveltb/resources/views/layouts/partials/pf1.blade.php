@include('layouts.partials.essentials')

<body id="body">
    @include('layouts.partials.navbarlogged')


    <div class="d-flex text-center border border-dark border-3 border-top-0  ">

        <div class="border border-dark border-2 m-3 box01 p-3 fs-2" id="ic"> <i class="fa-solid fa-camera"></i>
            Processos Fotográficos 1</div>

        @include('layouts.partials.btnTurmas')


    </div>

    <div class="alunos-container d-flex">
        <!-- Container para adicionar o novo conteúdo -->
        <div id="alunoContainer" class="mt-4 d-flex flex-wrap mx-2 gap-2">
            @foreach ($alunos as $aluno)
                <div class="aluno-card rounded text-center border border-dark border-2 excesso"
                    data-id="{{ $aluno->id }}">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-sm btn-warning m-2"
                            onclick="editAluno({{ $aluno->id }})">Editar</button>
                    </div>
                    <div class="me-3">
                        <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
                        <p><strong>Curso:</strong> {{ $aluno->curso }}</p>
                        <p><strong>Turma:</strong> {{ $aluno->turma }}</p>
                        <p><strong>CPF:</strong> {{ $aluno->cpf }}</p>
                        <p><strong>Nome dos Pais:</strong> {{ $aluno->nome_pais }}</p>
                        <p><strong>Telefone:</strong> {{ $aluno->telefone }}</p>
                        <p><strong>Telefone dos Pais:</strong> {{ $aluno->telefone_pais }}</p>
                        <p><strong>Email:</strong> {{ $aluno->email }}</p>
                        <p><strong>Email dos Pais:</strong> {{ $aluno->email_pais }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    </div>





    <script src="{{ asset('js/editAluno.js') }}"></script>


</body>
