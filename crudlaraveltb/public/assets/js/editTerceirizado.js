document.getElementById('editTerceirizadoForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const terceirizadoId = document.getElementById('terceirizadoId').value; // ID do terceirizado

    const url = terceirizadoId ? `/terceirizados/${terceirizadoId}` : routeStore2;

    const method = terceirizadoId ? 'PUT' : 'POST'; // Método PUT ou POST

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
        if (data.message === 'Terceirizado salvo com sucesso!' || data.message === 'Terceirizado atualizado com sucesso!') {
            if (terceirizadoId) {
                updateTerceirizado(terceirizadoId, {
                    nome: formData.get('nome'),
                    cpf: formData.get('cpf'),
                    telefone: formData.get('telefone'),
                    email: formData.get('email'),
                    numeroDeContrato: formData.get('numeroDeContrato'),
                    data_nascimento: formData.get('data_nascimento'),
                    foto: formData.get('foto') ? formData.get('foto') : null,
                });
            } else {
                renderTerceirizado({
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

            const terceirizadoModal = bootstrap.Modal.getInstance(document.getElementById('editTerceirizadoModal'));
            terceirizadoModal.hide();
            document.getElementById('editTerceirizadoForm').reset();
            location.reload();
        }
    })
    .catch(error => console.error('Erro:', error));
});

function renderTerceirizado(terceirizado) {
    const terceirizadoBox = document.createElement('div');
    terceirizadoBox.className = 'terceirizado-card rounded text-center border border-dark border-2 excesso';
    terceirizadoBox.setAttribute('data-id', terceirizado.id);

    terceirizadoBox.innerHTML = `
        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-warning m-2" onclick="editTerceirizado(${terceirizado.id})">Editar</button>
            <button class="btn btn-sm btn-danger m-2" onclick="deleteTerceirizado(${terceirizado.id})">Excluir</button>
        </div>
        <p><strong>Nome:</strong> ${terceirizado.nome}</p>
        <p><strong>CPF:</strong> ${terceirizado.cpf}</p>
        <p><strong>Telefone:</strong> ${terceirizado.telefone}</p>
        <p><strong>Email:</strong> ${terceirizado.email}</p>
        <p><strong>Número de Contrato:</strong> ${terceirizado.numeroDeContrato}</p>
        <p><strong>Data de Nascimento:</strong> ${terceirizado.data_nascimento}</p>
        ${terceirizado.foto ? `<img src="${terceirizado.foto}" class="img-fluid" alt="Foto do Terceirizado" />` : ''}
    `;

    document.getElementById('terceirizadosContainer').appendChild(terceirizadoBox);
}

function updateTerceirizado(id, terceirizado) {
    const card = document.querySelector(`[data-id='${id}']`);
    if (card) {
        card.innerHTML = `
            <div class="d-flex justify-content-end">
                <button class="btn btn-sm btn-warning m-2" onclick="editTerceirizado(${id})">Editar</button>
                <button class="btn btn-sm btn-danger m-2" onclick="deleteTerceirizado(${id})">Excluir</button>
            </div>
            <p><strong>Nome:</strong> ${terceirizado.nome}</p>
            <p><strong>CPF:</strong> ${terceirizado.cpf}</p>
            <p><strong>Telefone:</strong> ${terceirizado.telefone}</p>
            <p><strong>Email:</strong> ${terceirizado.email}</p>
            <p><strong>Número de Contrato:</strong> ${terceirizado.numeroDeContrato}</p>
            <p><strong>Data de Nascimento:</strong> ${terceirizado.data_nascimento}</p>
            ${terceirizado.foto ? `<img src="${terceirizado.foto}" class="img-fluid" alt="Foto do Terceirizado" />` : ''}
        `;
    }
}

function editTerceirizado(id) {
    fetch(`/terceirizados/${id}/edit`)
        .then(response => response.json())
        .then(terceirizado => {
            document.getElementById('nome').value = terceirizado.nome;
            document.getElementById('cpf').value = terceirizado.cpf;
            document.getElementById('telefone').value = terceirizado.telefone;
            document.getElementById('email').value = terceirizado.email;
            document.getElementById('numeroDeContrato').value = terceirizado.numeroDeContrato;
            document.getElementById('data_nascimento').value = terceirizado.data_nascimento;
            document.getElementById('terceirizadoId').value = terceirizado.id;

            if (terceirizado.foto) {
                document.getElementById('imagePreview').src = terceirizado.foto;
                document.getElementById('imagePreview').style.display = 'block';
            }

            const terceirizadoModal = new bootstrap.Modal(document.getElementById('editTerceirizadoModal'));
            terceirizadoModal.show();
        })
        .catch(error => console.error('Erro:', error));
}

function deleteTerceirizado(id) {
    if (confirm('Tem certeza que deseja excluir este terceirizado?')) {
        fetch(`/terceirizados/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Terceirizado excluído com sucesso!') {
                const terceirizadoCard = document.querySelector(`[data-id='${id}']`);
                if (terceirizadoCard) {
                    terceirizadoCard.remove();
                }
                alert('Terceirizado excluído com sucesso!');
            }
        })
        .catch(error => console.error('Erro ao excluir o terceirizado:', error));
    }
}
