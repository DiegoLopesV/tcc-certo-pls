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
                        <input type="text" class="form-control" id="curso" placeholder="curso" name="curso">
                        <label for="curso">Curso</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="turma" placeholder="turma" name="turma">
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
            `;
        }
    }

    function editAluno(id) {
        fetch(`/alunos/${id}/edit`)

            .then(response => response.json())
            .then(aluno => {
                document.getElementById('nome').value = aluno.nome;
                document.getElementById('curso').value = aluno.curso;
                document.getElementById('turma').value = aluno.turma;
                document.getElementById('cpf').value = aluno.cpf;
                document.getElementById('nome_pais').value = aluno.nome_pais;
                document.getElementById('telefone').value = aluno.telefone;
                document.getElementById('telefone_pais').value = aluno.telefone_pais;
                document.getElementById('email').value = aluno.email;
                document.getElementById('email_pais').value = aluno.email_pais;

                let deleteButton = document.querySelector('.btn-danger');
                if (!deleteButton) {
                    deleteButton =
                        `<button type="button" class="btn btn-danger" onclick="deleteAluno(${id})">Excluir</button>`;
                    document.getElementById('infoForm').insertAdjacentHTML('beforeend', deleteButton);
                }

                document.getElementById('infoForm').setAttribute('data-id', id);

                const alunoModal = new bootstrap.Modal(document.getElementById('alunoModal'));
                alunoModal.show();
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
                        const card = document.querySelector(`[data-id='${id}']`);
                        if (card) {
                            card.remove();
                        }
                        const alunoModal = bootstrap.Modal.getInstance(document.getElementById('alunoModal'));
                        alunoModal.hide();
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
