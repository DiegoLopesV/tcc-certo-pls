document.addEventListener('DOMContentLoaded', function() {
    const infoModalElement = document.getElementById('infoModal');
    const infoModal = new bootstrap.Modal(infoModalElement); // Inicia o modal

    document.getElementById('infoForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        const ocorrenciaId = form.getAttribute('data-id');
        const url = ocorrenciaId ? `/ocorrencias/${ocorrenciaId}` : '/ocorrencias'; // Verifica se é PUT ou POST

        fetch(url, {
            method: ocorrenciaId ? 'PUT' : 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                titulo: formData.get('titulo'),
                descricao: formData.get('descricao'),
                participantes: formData.get('participantes'),
                turma: formData.get('turma'),
                data: formData.get('data'),
                status: formData.get('status')
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                // Atualiza ou cria o card
                if (ocorrenciaId) {
                    updateOcorrencia(ocorrenciaId, {
                        titulo: formData.get('titulo'),
                        descricao: formData.get('descricao'),
                        participantes: formData.get('participantes'),
                        turma: formData.get('turma'),
                        data: formData.get('data'),
                        status: formData.get('status')
                    });
                } else {
                    renderOcorrencia({
                        id: data.id,
                        titulo: formData.get('titulo'),
                        descricao: formData.get('descricao'),
                        participantes: formData.get('participantes'),
                        turma: formData.get('turma'),
                        data: formData.get('data'),
                        status: formData.get('status')
                    });
                }

                const infoModal = bootstrap.Modal.getInstance(document.getElementById('infoModal'));
                infoModal.hide();
                document.getElementById('infoForm').reset();
                document.getElementById('infoForm').removeAttribute('data-id');
                document.querySelector('.btn-danger')?.remove();
            }
        })
        .catch(error => console.error('Erro ao salvar a ocorrência:', error));
    });

    // Função para atualizar o card da ocorrência
    function updateOcorrencia(id, ocorrencia) {
        const card = document.querySelector(`[data-id='${id}']`);
        if (card) {
            card.innerHTML = `
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-warning m-2" onclick="editOcorrencia(${id})">Editar</button>
                </div>
                <p><strong>Título:</strong> ${ocorrencia.titulo}</p>
                <p><strong>Descrição:</strong> ${ocorrencia.descricao}</p>
                <p><strong>Participantes:</strong> ${ocorrencia.participantes}</p>
                <p><strong>Turma:</strong> ${ocorrencia.turma}</p>
                <p><strong>Data:</strong> ${ocorrencia.data}</p>
                <p><strong>Status:</strong> ${ocorrencia.status}</p>
            `;
        }
    }

    // Função para criar um novo card
    function renderOcorrencia(ocorrencia) {
        const infoBox = document.createElement('div');
        infoBox.className = 'aluno-card rounded text-center border border-dark border-2 excesso';
        infoBox.setAttribute('data-id', ocorrencia.id);

        infoBox.innerHTML = `
            <div class="d-flex justify-content-end">
                <button class="btn btn-sm btn-warning m-2" onclick="editOcorrencia(${ocorrencia.id})">Editar</button>
            </div>
            <p><strong>Título:</strong> ${ocorrencia.titulo}</p>
            <p><strong>Descrição:</strong> ${ocorrencia.descricao}</p>
            <p><strong>Participantes:</strong> ${ocorrencia.participantes}</p>
            <p><strong>Turma:</strong> ${ocorrencia.turma}</p>
            <p><strong>Data:</strong> ${ocorrencia.data}</p>
            <p><strong>Status:</strong> ${ocorrencia.status}</p>
        `;

        document.getElementById('ocorrenciaContainer').appendChild(infoBox);
    }
});
