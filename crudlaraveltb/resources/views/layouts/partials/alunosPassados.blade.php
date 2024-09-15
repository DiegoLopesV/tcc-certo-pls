@extends('layouts.partials.essentials')
@include('layouts.partials.navbarlogged')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SGA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Adicione um estilo para o botão de seleção e o botão de confirmar */
        .aluno-checkbox{
            height: 20px;
            width: 20px;
        }
        .select-mode .checkbox-container {
            display: block;
        }
        .checkbox-container {
            display: none;
            position: absolute;
            top: 5px;
            right: 5px;
        }
        .hidden {
            display: none;
        }
        .aluno-card {
            position: relative;
        }
    </style>
</head>
<body id="body">

    <h1 class="text-center mt-2">Ex Alunos</h1>

    <!-- Botões para ativar o modo de seleção e confirmar a exclusão -->
    <div class="text-center mt-4">
        <button id="selectModeBtn" class="btn btn-primary">Selecionar Alunos</button>
        <button id="confirmDeleteBtn" class="btn btn-danger hidden">Confirmar Exclusão</button>
    </div>

    <div class="alunos-container d-flex">
        <!-- Container para adicionar o novo conteúdo -->
        <div id="alunoContainer" class="mt-4 d-flex flex-wrap mx-2 gap-2">
            @foreach ($alunos as $aluno)
                @if ($aluno->turma == 'passou de ano')
                    <div class="aluno-card rounded text-center border border-dark border-2 excesso" data-id="{{ $aluno->id }}">
                        <div class="checkbox-container">
                            <input type="checkbox" class="aluno-checkbox" data-id="{{ $aluno->id }}">
                        </div>
                        <img src="{{ $aluno->foto }}" alt="Foto do Aluno" class="img-fluid img-preview mt-4 mb-3" style="cursor: pointer;">
                        <p><strong>Nome:</strong> {{ $aluno->nome }}</p>
                        <p><strong>Curso:</strong> {{ $aluno->curso }}</p>
                        <p><strong>Turma:</strong> {{ $aluno->turma }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectModeBtn = document.getElementById('selectModeBtn');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            const alunoCards = document.querySelectorAll('.aluno-card');
            const checkboxes = document.querySelectorAll('.aluno-checkbox');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            selectModeBtn.addEventListener('click', function () {
                // Ativa ou desativa o modo de seleção
                document.body.classList.toggle('select-mode');
                selectModeBtn.classList.toggle('hidden');
                confirmDeleteBtn.classList.toggle('hidden');
            });

            confirmDeleteBtn.addEventListener('click', function () {
                const selectedAlunos = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.dataset.id);

                if (selectedAlunos.length > 0) {
                    // Envia uma requisição AJAX para deletar os alunos
                    fetch('/deletar-alunos', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': csrfToken
                        },
                        body: JSON.stringify({ alunos: selectedAlunos })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove os cards dos alunos excluídos
                            selectedAlunos.forEach(id => {
                                document.querySelector(`.aluno-card[data-id="${id}"]`).remove();
                            });
                        } else {
                            alert('Erro ao excluir alunos');
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
</html>
