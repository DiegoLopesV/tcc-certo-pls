@include('layouts.partials.essentials')

<!-- Modal -->
<div class="modal fade" id="alunoModal" tabindex="-1" aria-labelledby="alunoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alunoModalLabel">Formulário de Cadastro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="infoForm" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome">
                        <label for="nome">Nome</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="curso" class="form-select" name="curso">
                            <option value="">Selecione o Curso</option>
                            <!-- Aqui será preenchido via JavaScript -->
                        </select>
                        <label for="curso">Curso</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="turma" class="form-select" name="turma">
                            <option value="">Selecione a Turma</option>
                            <!-- Aqui será preenchido via JavaScript -->
                        </select>
                        <label for="turma">Turma</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="cpf" placeholder="CPF" name="cpf">
                        <label for="cpf">CPF</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nome_pais" placeholder="Nome dos Pais" name="nome_pais">
                        <label for="nome_pais">Nome dos Pais</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telefone" placeholder="Telefone" name="telefone">
                        <label for="telefone">Telefone</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telefone_pais" placeholder="Telefone dos Pais" name="telefone_pais">
                        <label for="telefone_pais">Telefone dos Pais</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email_pais" placeholder="Email dos Pais" name="email_pais">
                        <label for="email_pais">Email dos Pais</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                        <label for="foto">Foto</label>
                        <div id="fotoPreview" class="mt-2">
                            <!-- A imagem será exibida aqui -->
                            <img id="fotoPreviewImg" src="default-photo.jpg" alt="Pré-visualização da Foto" style="width: 100px; height: 100px; border-radius: 50%;">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Container para adicionar o novo conteúdo -->
<div id="alunoContainer" class="mt-4"></div>

<script>
    // Dados das turmas por curso
    const turmasPorCurso = {
        'Informática': ['Info 1', 'Info 2', 'Info 3', 'Info 4'],
        'PG': ['PG 1', 'PG 2', 'PG 3'],
        'ADM': ['ADM 1', 'ADM 2', 'ADM 3'],
        'Jogos': ['Jogos 1', 'Jogos 2', 'Jogos 3', 'Jogos 4'],
        'Mecânica': ['Mecânica 1', 'Mecânica 2'],
        'Eletrônica': ['Eletrônica 1', 'Eletrônica 2'],
        'Contabilidade': ['Contabilidade 1', 'Contabilidade 2'],
        'Processos Fotográficos': ['Processos Fotográficos 1', 'Processos Fotográficos 2'],
    };

    // Preencher dropdown de cursos
    const cursoDropdown = document.getElementById('curso');
    Object.keys(turmasPorCurso).forEach(curso => {
        const option = document.createElement('option');
        option.value = curso;
        option.textContent = curso;
        cursoDropdown.appendChild(option);
    });

    // Atualizar dropdown de turmas com base no curso selecionado
    cursoDropdown.addEventListener('change', function() {
        const turmaDropdown = document.getElementById('turma');
        turmaDropdown.innerHTML = '<option value="">Selecione a Turma</option>'; // Limpa as opções anteriores

        const cursoSelecionado = this.value;
        if (cursoSelecionado && turmasPorCurso[cursoSelecionado]) {
            turmasPorCurso[cursoSelecionado].forEach(turma => {
                const option = document.createElement('option');
                option.value = turma;
                option.textContent = turma;
                turmaDropdown.appendChild(option);
            });
        }
    });

    document.getElementById('infoForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        const alunoId = this.getAttribute('data-id');
        const url = alunoId ? `/alunos/${alunoId}` : '{{ route('alunos.store') }}';
        const method = alunoId ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Aluno salvo com sucesso!' || data.message === 'Aluno atualizado com sucesso!') {
                if (alunoId) {
                    updateAluno(alunoId, data.aluno);
                } else {
                    renderAluno(data.aluno);
                }

                const alunoModal = bootstrap.Modal.getInstance(document.getElementById('alunoModal'));
                alunoModal.hide();
                document.getElementById('infoForm').reset();
                document.getElementById('infoForm').removeAttribute('data-id');
                document.querySelector('.btn-danger')?.remove();
            }
        })
        .catch(error => console.error('Erro:', error));
    });

    function renderAluno(aluno) {
        const infoBox = document.createElement('div');
        infoBox.className = 'aluno-card rounded text-center border border-dark border-2 excesso';
        infoBox.setAttribute('data-id', aluno.id);

        infoBox.innerHTML = `
            <div class="d-flex justify-content-end">
                <button class="btn btn-sm btn-warning m-2" onclick="editAluno(${aluno.id})">Editar</button>
            </div>
            <p><strong>Nome:</strong> ${aluno.nome}</p>
            <p><strong>Curso:</strong> ${aluno.curso}</p>
            <p><strong>Turma:</strong> ${aluno.turma}</p>
            <p><strong>CPF:</strong> ${aluno.cpf}</p>
            <p><strong>Nome dos Pais:</strong> ${aluno.nome_pais}</p>
            <p><strong>Telefone:</strong> ${aluno.telefone}</p>
            <p><strong>Telefone dos Pais:</strong> ${aluno.telefone_pais}</p>
            <p><strong>Email:</strong> ${aluno.email}</p>
            <p><strong>Email dos Pais:</strong> ${aluno.email_pais}</p>
            ${aluno.foto ? `<img src="${aluno.foto}" alt="Foto do Aluno" class="img-fluid mt-2" style="max-width: 150px;">` : ''}
        `;

        document.getElementById('alunoContainer').appendChild(infoBox);
    }

    function updateAluno(id, aluno) {
        const card = document.querySelector(`[data-id='${id}']`);
        if (card) {
            card.innerHTML = `
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-warning m-2" onclick="editAluno(${id})">Editar</button>
                </div>
                <p><strong>Nome:</strong> ${aluno.nome}</p>
                <p><strong>Curso:</strong> ${aluno.curso}</p>
                <p><strong>Turma:</strong> ${aluno.turma}</p>
                <p><strong>CPF:</strong> ${aluno.cpf}</p>
                <p><strong>Nome dos Pais:</strong> ${aluno.nome_pais}</p>
                <p><strong>Telefone:</strong> ${aluno.telefone}</p>
                <p><strong>Telefone dos Pais:</strong> ${aluno.telefone_pais}</p>
                <p><strong>Email:</strong> ${aluno.email}</p>
                <p><strong>Email dos Pais:</strong> ${aluno.email_pais}</p>
                ${aluno.foto ? `<img src="${aluno.foto}" alt="Foto do Aluno" class="img-fluid mt-2" style="max-width: 150px;">` : ''}
            `;
        }
    }

    function editAluno(id) {
        fetch(`/alunos/${id}/edit`, {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById('nome').value = data.nome;
                document.getElementById('curso').value = data.curso;
                document.getElementById('turma').value = data.turma;
                document.getElementById('cpf').value = data.cpf;
                document.getElementById('nome_pais').value = data.nome_pais;
                document.getElementById('telefone').value = data.telefone;
                document.getElementById('telefone_pais').value = data.telefone_pais;
                document.getElementById('email').value = data.email;
                document.getElementById('email_pais').value = data.email_pais;

                let deleteButton = document.querySelector('.btn-danger');
                if (!deleteButton) {
                    deleteButton = `<button type="button" class="btn btn-danger" onclick="deleteAluno(${id})">Excluir</button>`;
                    document.getElementById('infoForm').insertAdjacentHTML('beforeend', deleteButton);
                }

                document.getElementById('infoForm').setAttribute('data-id', id);

                const alunoModal = new bootstrap.Modal(document.getElementById('alunoModal'));
                alunoModal.show();

                // Atualiza o dropdown de turmas com base no curso selecionado
                const cursoDropdown = document.getElementById('curso');
                cursoDropdown.value = data.curso;
                cursoDropdown.dispatchEvent(new Event('change')); // Aciona o evento para atualizar as turmas

                // Atualiza o dropdown de turmas
                const turmaDropdown = document.getElementById('turma');
                turmaDropdown.value = data.turma;
            }
        })
        .catch(error => console.error('Erro:', error));
    }

    function deleteAluno(id) {
        if (confirm('Tem certeza que deseja excluir este aluno?')) {
            fetch(`/alunos/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Aluno excluído com sucesso!') {
                    // Remove o cartão do aluno
                    const card = document.querySelector(`[data-id='${id}']`);
                    if (card) {
                        card.remove();
                    }
                    
                    // Esconde o modal e limpa o formulário
                    const alunoModal = bootstrap.Modal.getInstance(document.getElementById('alunoModal'));
                    alunoModal.hide();
                    
                    // Limpa o ID do formulário e remove o botão de excluir
                    document.getElementById('infoForm').removeAttribute('data-id');
                    document.querySelector('.btn-danger')?.remove();
                }
            })
            .catch(error => console.error('Erro:', error));
        }
    }

    document.getElementById('alunoModal').addEventListener('hidden.bs.modal', function() {
        const backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(backdrop => backdrop.remove());
        document.body.classList.remove('modal-open');
        document.body.style.removeProperty('padding-right');
    });
</script>

