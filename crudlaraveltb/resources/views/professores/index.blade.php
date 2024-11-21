@extends('layouts.partials.essentials')
@include('layouts.partials.navbarlogged')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Meta tag do CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Servidores</title>

</head>

<body id="body">

    <div>

        <div class="position-relative m-3 border border-dark border-3 rounded p-5">
            <div class="fs-1 mb-3">Lista de todos os Servidores <br></div>

            <!-- Botões posicionados no canto superior direito -->
            @if (auth()->check() && auth()->user()->key === '987xyz')
                <div class="position-absolute top-0 end-0 mx-4 button-container">
                    <button class="rounded AddProf mb-2" data-bs-toggle="modal" data-bs-target="#ServidorModal">
                        Criar Chave para Servidor</button>
                    <button class="rounded AddProf mb-2" data-bs-toggle="modal" data-bs-target="#chavesModal">
                        Ver Chaves Geradas
                    </button>
                </div>
            @endif


            <div class="alunos-container d-flex">
                <!-- Container para adicionar o novo conteúdo -->
                <div id="alunoContainer" class="mt-4 d-flex flex-wrap mx-2 gap-2">
                    @if ($professores && count($professores) > 0)
                        @foreach ($professores as $professor)
                            <div class="servidor-card rounded text-center border border-dark border-2 excesso"
                                data-bs-toggle="modal" data-bs-target="#servidorModalInfo">
                                <img src="{{ asset($professor->foto) }}" alt="Foto do Professor"
                                    class="img-fluid img-preview mt-4 mb-3" style="cursor: pointer;">
                                <p><strong>Nome:</strong> {{ $professor->nome }}</p>
                                <p><strong>Email:</strong> {{ $professor->email }}</p>
                                <p><strong>CPF:</strong> {{ $professor->cpf }}</p>
                                <p><strong>Telefone:</strong> {{ $professor->telefone }}</p>
                                <p><strong>Data de Nascimento:</strong> {{ $professor->data_nascimento }}</p>
                                <p><strong>Chave:</strong> {{ $professor->chave }}</p>
                            </div>
                        @endforeach
                    @else
                        <p>Nenhum professor encontrado.</p><br>
                    @endif

                    @if ($terceirizados && count($terceirizados) > 0)
                        @foreach ($terceirizados as $terceirizado)
                            <div class="servidor-card rounded text-center border border-dark border-2 excesso"
                                data-bs-toggle="modal" data-bs-target="#servidorModalInfo">
                                <img src="{{ asset($terceirizado->foto) }}" alt="Foto do Professor"
                                    class="img-fluid img-preview mt-4 mb-3" style="cursor: pointer;">
                                <p><strong>Nome:</strong> {{ $terceirizado->nome }}</p>
                                <p><strong>Email:</strong> {{ $terceirizado->email }}</p>
                                <p><strong>CPF:</strong> {{ $terceirizado->cpf }}</p>
                                <p><strong>Telefone:</strong> {{ $terceirizado->telefone }}</p>
                                <p><strong>Data de Nascimento:</strong> {{ $terceirizado->data_nascimento }}</p>
                                <p><strong>Chave:</strong> {{ $terceirizado->chave }}</p>

                            </div>
                        @endforeach
                    @else
                        <p>Nenhum Terceirizado encontrado.</p><br>
                    @endif

                    @if ($enfermeiros && count($enfermeiros) > 0)
                        @foreach ($enfermeiros as $enfermeiro)
                            <div class="servidor-card rounded text-center border border-dark border-2 excesso"
                                data-bs-toggle="modal" data-bs-target="#servidorModalInfo">
                                <img src="{{ asset($enfermeiro->foto) }}" alt="Foto do Professor"
                                    class="img-fluid img-preview mt-4 mb-3" style="cursor: pointer;">
                                <p><strong>Nome:</strong> {{ $enfermeiro->nome }}</p>
                                <p><strong>Email:</strong> {{ $enfermeiro->email }}</p>
                                <p><strong>CPF:</strong> {{ $enfermeiro->cpf }}</p>
                                <p><strong>Telefone:</strong> {{ $enfermeiro->telefone }}</p>
                                <p><strong>Data de Nascimento:</strong> {{ $enfermeiro->data_nascimento }}</p>
                                <p><strong>Chave:</strong> {{ $enfermeiro->chave }}</p>

                            </div>
                        @endforeach
                    @else
                        <p>Nenhum Enfermeiro encontrado.</p><br>
                    @endif

                </div>
            </div>

        </div>
        @include('layouts.partials.modalServidores')

    </div>


<!-- Modal Chaves Geradas -->
<div class="modal fade" id="chavesModal" tabindex="-1" aria-labelledby="chavesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chavesModalLabel">Chaves Geradas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Exibe as chaves na tabela -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Chave</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chavesTemporarias as $chave)
                            <tr>
                                <td>{{ $chave->nome }}</td>
                                <td>{{ $chave->chave }}</td>
                                <td>
                                    <button class="btn btn-outline-secondary btn-sm" onclick="copiarChave('{{ $chave->chave }}')" title="Copiar Chave">
                                        <i class="fa-regular fa-paste"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Função para copiar chave para a área de transferência
    function copiarChave(chave) {
        navigator.clipboard.writeText(chave)
            .then(() => {
                alert('Chave copiada para a área de transferência!');
            })
            .catch(err => {
                console.error('Erro ao copiar a chave: ', err);
            });
    }
</script>
</body>

</html>
