<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enfermaria</title>
    @include('layouts.partials.essentials')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body id="body">

    @include('layouts.partials.navbarlogged')
    <!-- Texto escrito Ocorrências -->
    <div class=" m-4 text-center  fs-1 fw-bold ">Enfermaria</div>

    <!-- Botões abaixo do texto de ocorrências -->
    <div class="d-flex align-items-center justify-content-center border border-dark border-2 p-2 text-center">

        @include('layouts.partials.btnEmitirRelat')
        <!-- Botão para emitir relatório -->
        @include('layouts.partials.btnEmitirRelat')

        <a href="{{ route('enfermaria.pdf', ['download' => 'pdf']) }}"
            class="border border-dark border-1 border rounded-2 m-2 fs-3 fw-bold text-dark btn btn-sm float-left"
            id="pdf">
            <i class="fa-solid fa-file-pdf me-1"></i> PDF

        </a>

        <button id="filtrar" class="border border-dark border-1 border rounded-2 m-1 fs-2 fw-bold"
            data-bs-toggle="modal" data-bs-target="#filterModal"> <i class="fa-solid fa-list me-1"></i> Filtrar</button>

        <button id="add" class=" border border-dark border-1 border rounded-2 m-1 fs-2 text-wrap fw-bold"
            data-bs-toggle="modal" data-bs-target="#infoModal"> Adicionar Atestados <i
                class="fa-solid fa-plus ms-1"></i></button>

    </div>


    <!-- Seção para ordenação -->
    <div class="border border-dark border-2 border-top-0 position-relative">
        <a class="ms-1 fs-2 text-dark text-decoration-none" href="#" id="ordenarLink">Ordenar ▼</a>
        <!-- Incluindo o dropdown de ordenação -->
    </div>

    @if (auth()->check() && auth()->user()->key === '987xyz')
        <!-- Botões para ativar o modo de seleção e confirmar a exclusão -->
        <div class=" m-2 mt-4">
            <button id="selectModeBtn" class="btn btn-primary">Excluir múltiplos Atendimentos</button>
            <button id="confirmDeleteBtn" class="btn btn-danger hidden">Confirmar Exclusão</button>
            <button id="cancelDeleteBtn" class="btn btn-secondary hidden">Cancelar</button>
        </div>
    @endif



    <!-- Container com os card -->
    <div id="enfermariaContainer" class="mt-4 d-flex flex-wrap mx-2 gap-2">
        @foreach ($enfermaria as $enfermaria)
            <div class="enfermaria-card rounded text-center border border-dark border-2 excesso"
                data-id="{{ $enfermaria->id }}" data-turma="{{ $enfermaria->turma }}" data-title="{{ $enfermaria->titulo }}"
                data-created="{{ $enfermaria->data }}">
                <div class="d-flex justify-content-end">
                    @if (auth()->check() && auth()->user()->key === '987xyz')
                        <button class="btn btn-sm btn-warning m-2"
                            onclick="editEnfermaria({{ $enfermaria->id }})">Editar</button>
                        <div class="checkbox-container">
                            <input type="checkbox" class="enfermaria-checkbox" data-id="{{ $enfermaria->id }}">
                        </div>
                    @endif
                </div>
                <p><strong>Título:</strong> {{ $enfermaria->titulo }}</p>
                <p><strong>Responsável:</strong> {{ $enfermaria->responsavel }}</p>
                <p><strong>Aluno Atendido:</strong> {{ $enfermaria->pessoas }}</p>
                <p><strong>Idade:</strong> {{ $enfermaria->idade }}</p>
                <p><strong>Turma:</strong> {{ $enfermaria->turma }}</p>
                <p><strong>Hora de Início:</strong> {{ $enfermaria->horaIncio }}</p>
                <p><strong>Horário de Término:</strong> {{ $enfermaria->horaFinal }}</p>
                <p><strong>Queixa:</strong> {{ $enfermaria->queixa }}</p>
                <p><strong>Atividade Realizada:</strong> {{ $enfermaria->atividade_realizada }}</p>
                <p><strong>Conduta:</strong> {{ $enfermaria->conduta }}</p>
                <p><strong>Outras informações/observações:</strong> {{ $enfermaria->descricao }}</p>


                <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($enfermaria->data)->format('d-m-Y') }}</p>
            </div>
        @endforeach
    </div>


    @include('layouts.partials.btnEnf')


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectModeBtn = document.getElementById('selectModeBtn');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
            const enfermariaCards = document.querySelectorAll('.enfermaria-card'); // Cards de enfermaria
            const checkboxes = document.querySelectorAll(
                '.enfermaria-checkbox'); // Checkbox para selecionar enfermarias
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            selectModeBtn.addEventListener('click', function () {
                // Ativa ou desativa o modo de seleção
                document.body.classList.toggle('select-mode');
                selectModeBtn.classList.toggle('hidden');
                confirmDeleteBtn.classList.toggle('hidden');
                cancelDeleteBtn.classList.toggle('hidden'); // Mostrar o botão de Cancelar

                // Exibe ou oculta os checkboxes em cada card de enfermaria
                enfermariaCards.forEach(card => {
                    const checkboxContainer = card.querySelector('.checkbox-container');
                    checkboxContainer.classList.toggle('hidden');
                });

            });

            cancelDeleteBtn.addEventListener('click', function () {
                // Oculta o modo de seleção
                document.body.classList.remove('select-mode');
                selectModeBtn.classList.remove('hidden');
                confirmDeleteBtn.classList.add('hidden');
                cancelDeleteBtn.classList.add('hidden'); // Oculta o botão de Cancelar

                // Oculta os checkboxes em cada card de enfermaria
                enfermariaCards.forEach(card => {
                    const checkboxContainer = card.querySelector('.checkbox-container');
                    checkboxContainer.classList.add('hidden');
                });

                // Desmarca todas as checkboxes
                checkboxes.forEach(checkbox => checkbox.checked = false);
            });


            confirmDeleteBtn.addEventListener('click', function () {
                const selectedEnfermarias = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.dataset.id);

                if (selectedEnfermarias.length > 0) {
                    // Envia uma requisição AJAX para deletar as enfermarias
                    fetch('/deletar-enfermarias', { // Endpoint para deletar enfermarias
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': csrfToken
                        },
                        body: JSON.stringify({
                            enfermarias: selectedEnfermarias
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Remove os cards das enfermarias excluídas
                                selectedEnfermarias.forEach(id => {
                                    document.querySelector(
                                        `.enfermaria-card[data-id="${id}"]`)
                                        .remove();
                                });

                                // Restaura o estado original dos botões e oculta os checkboxes
                                document.body.classList.remove('select-mode');
                                selectModeBtn.classList.remove('hidden');
                                confirmDeleteBtn.classList.add('hidden');

                                // Desmarca todas as checkboxes
                                checkboxes.forEach(checkbox => checkbox.checked = false);

                                // Oculta os checkboxes em cada card de enfermaria
                                enfermariaCards.forEach(card => {
                                    const checkboxContainer = card.querySelector(
                                        '.checkbox-container');
                                    checkboxContainer.classList.add('hidden');
                                });
                            } else {
                                alert('Erro ao excluir enfermarias');
                            }
                        })
                        .catch(error => {
                            console.error('Erro:', error);
                        });
                }
            });
        });
    </script>



</body>
@include('layouts.partials.btnFiltro')
@include('layouts.partials.btnOrdenacao')
</html>