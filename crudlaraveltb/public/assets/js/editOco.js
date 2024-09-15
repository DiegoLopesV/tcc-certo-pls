function editOcorrencia(id) {
    fetch(`/ocorrencias/${id}/edit`)
        .then(response => response.json())
        .then(ocorrencia => {
            // Preenche os campos do formulário com os dados da ocorrência
            document.getElementById('titulo').value = ocorrencia.titulo;
            document.getElementById('descricao').value = ocorrencia.descricao;
            document.getElementById('participantes').value = ocorrencia.participantes;
            document.getElementById('turma').value = ocorrencia.turma;
            document.getElementById('data').value = ocorrencia.data;
            document.getElementById('status').value = ocorrencia.status;

            // Adiciona o botão de exclusão se ainda não existir
            let deleteButton = document.querySelector('.btn-danger');
            if (!deleteButton) {
                deleteButton = `<button type="button" class="btn btn-danger" onclick="deleteOcorrencia(${id})">Excluir</button>`;
                document.getElementById('infoForm').insertAdjacentHTML('beforeend', deleteButton);
            }

            // Atribui o ID da ocorrência ao formulário
            document.getElementById('infoForm').setAttribute('data-id', id);

            // Mostra o modal para edição
            const infoModal = new bootstrap.Modal(document.getElementById('infoModal'));
            infoModal.show();
        })
        .catch(error => console.error('Erro ao buscar a ocorrência:', error));
}


function deleteOcorrencia(id) {
    if (confirm('Tem certeza que deseja excluir esta ocorrência?')) {
        fetch(`/ocorrencias/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.message.includes('sucesso')) {
                document.querySelector(`[data-id='${id}']`).remove();
                const infoModal = bootstrap.Modal.getInstance(document.getElementById('infoModal'));
                infoModal.hide();
                document.getElementById('infoForm').reset();
                document.getElementById('infoForm').removeAttribute('data-id');
                document.querySelector('.btn-danger')?.remove();
            }
        })
        .catch(error => console.error('Erro:', error));
    }
}


