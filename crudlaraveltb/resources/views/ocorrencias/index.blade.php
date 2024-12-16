<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SGA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.partials.essentials')
    @include('layouts.partials.btnOco')
</head>

<body id="body">
    <!-- Navbar -->
    @include('layouts.partials.navbarlogged')

    <!-- Título da página -->
    <div class="m-4 text-center fs-1 fw-bold">Ocorrências</div>

    <!-- Seção de Botões -->
    <div class="d-flex align-items-center justify-content-center border border-dark border-2 p-1 text-center">
        @include('layouts.partials.btnEmitirRelat')
        <a href="{{ route('ocorrencias.pdf', ['download' => 'pdf']) }}"
            class="border border-dark border-1 border rounded-2 m-2 fs-3 fw-bold text-dark btn btn-sm float-left"
            id="pdf">
            <i class="fa-solid fa-file-pdf me-1"></i> PDF
        </a>
        <button id="filtrar" class="border border-dark border-1 border rounded-2 m-1 fs-2 fw-bold"
            data-bs-toggle="modal" data-bs-target="#filterModal">
            <i class="fa-solid fa-list me-1"></i> Filtrar
        </button>
        <button id="add" class="border border-dark border-1 border rounded-2 m-1 fs-2 text-wrap fw-bold"
            data-bs-toggle="modal" data-bs-target="#infoModal">
            Adicionar Ocorrência <i class="fa-solid fa-plus ms-1"></i>
        </button>
    </div>

    <!-- Seção para ordenação -->
    <div class="border border-dark border-2 border-top-0">
        <a class="ms-1 fs-2 text-dark text-decoration-none" href="#" id="ordenarLink">Ordenar ▼</a>
        @include('layouts.partials.btnOrdenar') <!-- Incluindo o dropdown de ordenação -->
    </div>

    @if (auth()->check() && auth()->user()->key === '987xyz')
        <!-- Botões para ativar o modo de seleção e confirmar a exclusão -->
        <div class=" m-2 mt-4">
            <button id="selectModeBtn" class="btn btn-primary">Excluir múltiplas Ocorrências</button>
            <button id="confirmDeleteBtn" class="btn btn-danger hidden">Confirmar Exclusão</button>
            <button id="cancelDeleteBtn" class="btn btn-secondary hidden">Cancelar</button>
        </div>
    @endif

    <!-- Container para informações -->
    <div id="ocorrenciaContainer" class="mt-4 d-flex flex-wrap mx-2 gap-2">
        @foreach ($ocorrencias as $ocorrencia)
            <div class="ocorrencia-card rounded text-center border border-dark border-2 excesso"
                data-id="{{ $ocorrencia->id }}" data-participantes="{{ json_encode($ocorrencia->participantes) }}" data-title="{{ $ocorrencia->titulo }}"
                data-created="{{ $ocorrencia->data }}">
                <div class="d-flex justify-content-end">
                    @if (auth()->check() && auth()->user()->key === '987xyz')
                        <button class="btn btn-sm btn-warning m-2"
                            onclick="editOcorrencia({{ $ocorrencia->id }})">Editar</button>
                        <div class="checkbox-container">
                            <input type="checkbox" class="ocorrencia-checkbox" data-id="{{ $ocorrencia->id }}">
                        </div>
                    @endif
                </div>
                <p><strong>Título:</strong> {{ $ocorrencia->titulo }}</p>
                <p><strong>Descrição:</strong> {{ $ocorrencia->descricao }}</p>
                <p><strong>Participantes:</strong></p>
                <ul>
                    @foreach ($ocorrencia->participantes as $participante)
                        <li>{{ $participante['nome'] }} ({{ $participante['curso'] }}, {{ $participante['turma'] }})</li>
                    @endforeach
                </ul>
                <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($ocorrencia->data)->format('d-m-Y') }}</p>
                <p><strong>Status:</strong>
                    {{ $ocorrencia->status == 0 ? 'Concluído' : ($ocorrencia->status == 1 ? 'Em Andamento' : 'Pendente') }}
                </p>
            </div>
        @endforeach
    </div>

    <script src="{{ asset('assets/js/formOco.js') }}"></script>
    <script src="{{ asset('assets/js/editOco.js') }}"></script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectModeBtn = document.getElementById('selectModeBtn');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
            const ocorrenciaCards = document.querySelectorAll('.ocorrencia-card'); // Cards de ocorrência
            const checkboxes = document.querySelectorAll(
                '.ocorrencia-checkbox'); // Checkbox para selecionar ocorrências
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            selectModeBtn.addEventListener('click', function () {
                // Ativa ou desativa o modo de seleção
                document.body.classList.toggle('select-mode');
                selectModeBtn.classList.toggle('hidden');
                confirmDeleteBtn.classList.toggle('hidden');
                cancelDeleteBtn.classList.toggle('hidden');
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
                const selectedOcorrencias = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.dataset.id);

                if (selectedOcorrencias.length > 0) {
                    // Envia uma requisição AJAX para deletar as ocorrências
                    fetch('/deletar-ocorrencias', { // Altere para o endpoint correto de ocorrências
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': csrfToken
                        },
                        body: JSON.stringify({
                            ocorrencias: selectedOcorrencias
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Remove os cards das ocorrências excluídas
                                selectedOcorrencias.forEach(id => {
                                    document.querySelector(`.ocorrencia-card[data-id="${id}"]`)
                                        .remove();
                                    document.body.classList.remove('select-mode');
                                    selectModeBtn.classList.remove('hidden');
                                    confirmDeleteBtn.classList.add('hidden');

                                    // Desmarca todas as checkboxes
                                    checkboxes.forEach(checkbox => checkbox.checked = false);
                                });
                            } else {
                                alert('Erro ao excluir ocorrências');
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
</html>