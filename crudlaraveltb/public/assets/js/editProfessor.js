

document.getElementById('editProfessorForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const professorId = document.getElementById('professorId').value; // ID do professor

    const url = professorId ? `/professores/${professorId}` : routeStore;

    const method = professorId ? 'PUT' : 'POST'; // Método PUT ou POST

    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            nome: formData.get('nome'),
            cpf: formData.get('cpf'),
            telefone: formData.get('telefone'),
            email: formData.get('email'),
            numeroDeContrato: formData.get('numeroDeContrato'),
            data_nascimento: formData.get('data_nascimento'),
            foto: formData.get('foto') ? formData.get('foto') : null, // Verifica se tem foto
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Professor salvo com sucesso!' || data.message === 'Professor atualizado com sucesso!') {
            if (professorId) {
                updateProfessor(professorId, {
                    nome: formData.get('nome'),
                    cpf: formData.get('cpf'),
                    telefone: formData.get('telefone'),
                    email: formData.get('email'),
                    numeroDeContrato: formData.get('numeroDeContrato'),
                    data_nascimento: formData.get('data_nascimento'),
                    foto: formData.get('foto') ? formData.get('foto') : null,
                });
            } else {
                renderProfessor({
                    id: data.id,
                    nome: formData.get('nome'),
                    cpf: formData.get('cpf'),
                    telefone: formData.get('telefone'),
                    email: formData.get('email'),
                    numeroDeContrato: formData.get('numeroDeContrato'),
                    data_nascimento: formData.get('data_nascimento'),
                    foto: formData.get('foto') ? formData.get('foto') : null,
                });
            }

            const professorModal = bootstrap.Modal.getInstance(document.getElementById('editProfessorModal'));
            professorModal.hide();
            document.getElementById('editProfessorForm').reset();
            location.reload();
        }
    })
    .catch(error => console.error('Erro:', error));
});

function renderProfessor(professor) {
    const professorBox = document.createElement('div');
    professorBox.className = 'professor-card rounded text-center border border-dark border-2 excesso';
    professorBox.setAttribute('data-id', professor.id);

    professorBox.innerHTML = `
        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-warning m-2" onclick="editProfessor(${professor.id})">Editar</button>
        </div>
        <p><strong>Nome:</strong> ${professor.nome}</p>
        <p><strong>CPF:</strong> ${professor.cpf}</p>
        <p><strong>Telefone:</strong> ${professor.telefone}</p>
        <p><strong>Email:</strong> ${professor.email}</p>
        <p><strong>Número de Contrato:</strong> ${professor.numeroDeContrato}</p>
        <p><strong>Data de Nascimento:</strong> ${professor.data_nascimento}</p>
        ${professor.foto ? `<img src="${professor.foto}" class="img-fluid" alt="Foto do Professor" />` : ''}
    `;

    document.getElementById('professoresContainer').appendChild(professorBox);
}

function updateProfessor(id, professor) {
    const card = document.querySelector(`[data-id='${id}']`);
    if (card) {
        card.innerHTML = `
            <div class="d-flex justify-content-end">
                <button class="btn btn-sm btn-warning m-2" onclick="editProfessor(${id})">Editar</button>
            </div>
            <p><strong>Nome:</strong> ${professor.nome}</p>
            <p><strong>CPF:</strong> ${professor.cpf}</p>
            <p><strong>Telefone:</strong> ${professor.telefone}</p>
            <p><strong>Email:</strong> ${professor.email}</p>
            <p><strong>Número de Contrato:</strong> ${professor.numeroDeContrato}</p>
            <p><strong>Data de Nascimento:</strong> ${professor.data_nascimento}</p>
            ${professor.foto ? `<img src="${professor.foto}" class="img-fluid" alt="Foto do Professor" />` : ''}
        `;
    }
}

function editProfessor(id) {
    fetch(`/professores/${id}/edit`)
        .then(response => response.json())
        .then(professor => {
            document.getElementById('nome').value = professor.nome;
            document.getElementById('cpf').value = professor.cpf;
            document.getElementById('telefone').value = professor.telefone;
            document.getElementById('email').value = professor.email;
            document.getElementById('numeroDeContrato').value = professor.numeroDeContrato;
            document.getElementById('data_nascimento').value = professor.data_nascimento;
            document.getElementById('professorId').value = professor.id;

            // Previsualização da foto, se existir
            if (professor.foto) {
                document.getElementById('imagePreview').src = professor.foto;
                document.getElementById('imagePreview').style.display = 'block';
            }

            // Mostra o modal
            const professorModal = new bootstrap.Modal(document.getElementById('editProfessorModal'));
            professorModal.show();
        })
        .catch(error => console.error('Erro:', error));
}

document.getElementById('deleteProfessorButton').addEventListener('click', function() {
    const professorId = document.getElementById('professorId').value;

    if (confirm('Tem certeza que deseja excluir este professor?')) {
        fetch(`/professores/${professorId}`, {
            method: 'DELETE', // Usando o método DELETE
            headers: {
                'X-CSRF-TOKEN': csrfToken // Envia o token CSRF
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Professor excluído com sucesso!') {
                // Se a exclusão foi bem-sucedida, remova o card do professor da tela
                const professorCard = document.querySelector(`[data-id='${professorId}']`);
                if (professorCard) {
                    professorCard.remove();
                }

                // Fechar o modal
                const professorModal = bootstrap.Modal.getInstance(document.getElementById('editProfessorModal'));
                professorModal.hide();

                alert('Professor excluído com sucesso!');
                location.reload();
            }
        })
        .catch(error => console.error('Erro ao excluir o professor:', error));
    }
});
