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
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


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
                                <div class="checkbox-container2 hidden">
                                <input type="checkbox" class="servidor-checkbox" data-id="{{ $professor->id }}">
                                </div>
                                <div class="d-flex justify-content-end">
                                    @if (auth()->check() && auth()->user()->key === '987xyz')
                                        <button class="btn btn-sm btn-warning m-2"
                                            onclick="editProfessor({{ $professor->id }})">Editar</button>
                                    @endif
                                </div>
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
                                <div class="checkbox-container2 hidden">
                                <input type="checkbox" class="servidor-checkbox" data-id="{{ $terceirizado->id }}">
                                </div>
                                <div class="d-flex justify-content-end">
                                    @if (auth()->check() && auth()->user()->key === '987xyz')
                                        <button class="btn btn-sm btn-warning m-2"
                                          onclick="editTerceirizado({{ $terceirizado->id }})">Editar</button>
                                    @endif
                                </div>
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
                                <div class="checkbox-container2 hidden">
                                 <input type="checkbox" class="servidor-checkbox" data-id="{{ $enfermeiro->id }}">
                                </div>
                                <div class="d-flex justify-content-end">
                                    @if (auth()->check() && auth()->user()->key === '987xyz')
                                        <button class="btn btn-sm btn-warning m-2"
                                            onclick="editEnfermaria({{ $enfermeiro->id }})">Editar</button>
                                    @endif
                                </div>
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
<!-- Modal de Edição -->
<div class="modal fade" id="editProfessorModal" tabindex="-1" aria-labelledby="editProfessorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfessorModalLabel">Editar Professor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfessorForm" enctype="multipart/form-data" method="POST" action="{{ isset($professor) ? route('professores.update', $professor->id) : '#' }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="professorId">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                        <label for="nome">Nome</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" required>
                        <label for="cpf">CPF</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>
                        <label for="telefone">Telefone</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="numeroDeContrato" name="numeroDeContrato" placeholder="Número de Contrato" required>
                        <label for="numeroDeContrato">Número de Contrato</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                        <label for="data_nascimento">Data de Nascimento</label>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    </div>
                    <div id="imagePreviewContainer" class="mb-3">
                        <img id="imagePreview" class="img-thumbnail" alt="Pré-visualização da foto" style="max-height: 200px; display: none;">
                    </div>
                    <button type="button" class="btn btn-danger" id="deleteProfessorButton">Excluir</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
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


<div class="modal fade" id="editTerceirizadoModal" tabindex="-1" aria-labelledby="editTerceirizadoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTerceirizadoModalLabel">Editar Terceirizado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTerceirizadoForm" enctype="multipart/form-data" method="POST" action="#">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="terceirizadoId">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="nome" required>
                        <label for="nome">Nome</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" required>
                        <label for="cpf">CPF</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>
                        <label for="telefone">Telefone</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="numeroDeContrato" name="numeroDeContrato" placeholder="Número de Contrato" required>
                        <label for="numeroDeContrato">Número de Contrato</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                        <label for="data_nascimento">Data de Nascimento</label>
                    </div>
                    <button type="button" class="btn btn-danger" id="deleteTerceirizadoButton">Excluir</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('assets/js/editProfessor.js') }}"></script>
<script>
    const csrfToken = '{{ csrf_token() }}'; 
    const routeStore = @json(route('professores.store'));
</script>
 

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


<script>
    document.getElementById('editTerceirizadoForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        const terceirizadoId = document.getElementById('terceirizadoId').value; // Obtém o ID do terceirizado

        const url = terceirizadoId ? `/professores/terceirizados/${terceirizadoId}` : '{{ route('terceirizados.store') }}'; // URL para PUT ou POST
        const method = terceirizadoId ? 'PUT' : 'POST'; // Método para PUT ou POST

        fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Terceirizado salvo com sucesso!' || data.message === 'Terceirizado atualizado com sucesso!') {
                if (terceirizadoId) {
                    updateTerceirizado(terceirizadoId, data.terceirizado);
                } else {
                    renderTerceirizado(data.terceirizado);
                }

                const modal = bootstrap.Modal.getInstance(document.getElementById('editTerceirizadoModal'));
                modal.hide();
                document.getElementById('editTerceirizadoForm').reset();
                document.getElementById('editTerceirizadoForm').removeAttribute('data-id');
                document.getElementById('deleteBtn').style.display = 'none'; // Esconde o botão de excluir
            }
        })
        .catch(error => console.error('Erro:', error));
    });

    function renderTerceirizado(terceirizado) {
        const card = document.createElement('div');
        card.className = 'servidor-card rounded text-center border border-dark border-2 excesso';
        card.setAttribute('data-id', terceirizado.id);
        card.innerHTML = `
            <div class="d-flex justify-content-end">
                <button class="btn btn-sm btn-warning m-2" onclick="editTerceirizado(${terceirizado.id})">Editar</button>
            </div>
            <img src="{{ asset('${terceirizado.foto}') }}" alt="Foto do Terceirizado" class="img-fluid img-preview mt-4 mb-3" style="cursor: pointer;">
            <p><strong>Nome:</strong> ${terceirizado.nome}</p>
            <p><strong>Email:</strong> ${terceirizado.email}</p>
            <p><strong>CPF:</strong> ${terceirizado.cpf}</p>
            <p><strong>Telefone:</strong> ${terceirizado.telefone}</p>
            <p><strong>Data de Nascimento:</strong> ${terceirizado.data_nascimento}</p>
            <p><strong>Chave:</strong> ${terceirizado.chave}</p>
        `;
        document.getElementById('terceirizadoContainer').appendChild(card);
    }

    function editTerceirizado(id) {
    // Requisição para buscar os dados do terceirizado
    fetch(`/professores/terceirizados/${id}/edit`)
        .then(response => response.json())
        .then(terceirizado => {
            console.log('Dados recebidos:', terceirizado);  // Verifique os dados aqui

            // Verificar se os dados recebidos são válidos
            if (!terceirizado || !terceirizado.id) {
                console.error('Dados do terceirizado não encontrados');
                return;
            }

            // Preenche os campos com as informações recebidas
            document.getElementById('nome').value = terceirizado.nome;
            document.getElementById('cpf').value = terceirizado.cpf;
            document.getElementById('telefone').value = terceirizado.telefone;
            document.getElementById('email').value = terceirizado.email;
            document.getElementById('numeroDeContrato').value = terceirizado.numeroDeContrato;
            document.getElementById('data_nascimento').value = terceirizado.data_nascimento;
            document.getElementById('terceirizadoId').value = terceirizado.id;

            // Previsualização da foto, se existir
            if (terceirizado.foto) {
                const imagePreview = document.getElementById('imagePreview');
                if (imagePreview) {
                    imagePreview.src = terceirizado.foto;
                    imagePreview.style.display = 'block';  // Exibe a imagem de pré-visualização
                }
            }

            // Inicializa o modal corretamente
            const modalElement = document.getElementById('editTerceirizadoModal');
            if (modalElement) {
                const modal = new bootstrap.Modal(modalElement);
                modal.show();
            } else {
                console.error('Erro: O modal não foi encontrado no DOM.');
            }
        })
        .catch(error => {
            console.error('Erro ao buscar os dados:', error);
        });
}

    function updateTerceirizado(id, terceirizado) {
        const card = document.querySelector(`[data-id='${id}']`);
        if (card) {
            card.innerHTML = `
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-warning m-2" onclick="editTerceirizado(${id})">Editar</button>
                </div>
                <img src="{{ asset('${terceirizado.foto}') }}" alt="Foto do Terceirizado" class="img-fluid img-preview mt-4 mb-3" style="cursor: pointer;">
                <p><strong>Nome:</strong> ${terceirizado.nome}</p>
                <p><strong>Email:</strong> ${terceirizado.email}</p>
                <p><strong>CPF:</strong> ${terceirizado.cpf}</p>
                <p><strong>Telefone:</strong> ${terceirizado.telefone}</p>
                <p><strong>Data de Nascimento:</strong> ${terceirizado.data_nascimento}</p>
                <p><strong>Chave:</strong> ${terceirizado.chave}</p>
            `;
        }
    }

    function deleteTerceirizado(id) {
        if (confirm('Tem certeza que deseja excluir este terceirizado?')) {
            fetch(`/professores/terceirizados/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Terceirizado excluído com sucesso!') {
                    const card = document.querySelector(`[data-id='${id}']`);
                    if (card) {
                        card.remove();
                    }
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editTerceirizadoModal'));
                    modal.hide();
                }
            })
            .catch(error => console.error('Erro:', error));
        }
    }
</script>

</body>
</html>
