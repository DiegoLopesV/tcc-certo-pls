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
                <form id="infoForm">
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
                        <input type="text" class="form-control" id="nome_pais" placeholder="Nome dos Pais"
                            name="nome_pais">
                        <label for="nome_pais">Nome dos Pais</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telefone" placeholder="Telefone"
                            name="telefone">
                        <label for="telefone">Telefone</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telefone_pais" placeholder="Telefone dos Pais"
                            name="telefone_pais">
                        <label for="telefone_pais">Telefone dos Pais</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email_pais" placeholder="Email dos Pais"
                            name="email_pais">
                        <label for="email_pais">Email dos Pais</label>
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
        'Jogos': ['Jogos 1', 'Jogos 2'],
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
    cursoDropdown.addEventListener('change', function () {
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
        const alunoId = this.getAttribute('data-id'); // Obtém o ID do aluno do atributo data-id

        const url = alunoId ? `/alunos/${alunoId}` : '{{ route('alunos.store') }}'; // URL para PUT ou POST
        const method = alunoId ? 'PUT' : 'POST'; // Método para PUT ou POST

        fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    nome: formData.get('nome'),
                    curso: formData.get('curso'),
                    turma: formData.get('turma'),
                    cpf: formData.get('cpf'),
                    nome_pais: formData.get('nome_pais'),
                    telefone: formData.get('telefone'),
                    telefone_pais: formData.get('telefone_pais'),
                    email: formData.get('email'),
                    email_pais: formData.get('email_pais'),
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Aluno salvo com sucesso!' || data.message ===
                    'Aluno atualizado com sucesso!') {
                    if (alunoId) {
                        updateAluno(alunoId, {
                            nome: formData.get('nome'),
                            curso: formData.get('curso'),
                            turma: formData.get('turma'),
                            cpf: formData.get('cpf'),
                            nome_pais: formData.get('nome_pais'),
                            telefone: formData.get('telefone'),
                            telefone_pais: formData.get('telefone_pais'),
                            email: formData.get('email'),
                            email_pais: formData.get('email_pais')
                        });
                    } else {
                        renderAluno({
                            id: data.id,
                            nome: formData.get('nome'),
                            curso: formData.get('curso'),
                            turma: formData.get('turma'),
                            cpf: formData.get('cpf'),
                            nome_pais: formData.get('nome_pais'),
                            telefone: formData.get('telefone'),
                            telefone_pais: formData.get('telefone_pais'),
                            email: formData.get('email'),
                            email_pais: formData.get('email_pais')
                        });
                    }

                    const alunoModal = bootstrap.Modal.getInstance(document.getElementById('alunoModal'));
                    alunoModal.hide();
                    document.getElementById('infoForm').reset();
                    document.getElementById('infoForm').removeAttribute('data-id');
                    document.querySelector('.btn-danger')?.remove(); // Remove o botão de excluir se existir
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
        `;

        const alunoContainer = document.getElementById('alunoContainer');
        alunoContainer.appendChild(infoBox);
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

                    const alunoModal = new bootstrap.Modal(document.getElementById('alunoModal'));
                    alunoModal.show();
                    document.getElementById('infoForm').setAttribute('data-id', id);

                    // Atualiza o dropdown de turmas com base no curso selecionado
                    const cursoDropdown = document.getElementById('curso');
                    cursoDropdown.value = data.curso;
                    cursoDropdown.dispatchEvent(new Event('change')); // Aciona o evento para atualizar as turmas
                }
            })
            .catch(error => console.error('Erro:', error));
    }
</script>

