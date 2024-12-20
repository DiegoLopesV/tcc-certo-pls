document.addEventListener('DOMContentLoaded', function () {
    const infoModalElement = document.getElementById('infoModal');
    const infoModal = new bootstrap.Modal(infoModalElement); // Inicia o modal

    document.getElementById('infoForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        const ocorrenciaId = form.getAttribute('data-id');
        const url = ocorrenciaId ? `/ocorrencias/${ocorrenciaId}` : '/ocorrencias'; // Verifica se é PUT ou POST

        // Converte os dados do formulário para JSON
        const data = {
            titulo: formData.get('titulo'),
            descricao: formData.get('descricao'),
            turma: formData.get('turma'),
            data: formData.get('data'),
            status: formData.get('status'),
            participantes: []
        };

        // Captura os participantes como array de objetos
        document.querySelectorAll('.participant-group').forEach((group, index) => {
            const nome = group.querySelector(`input[name="participantes[${index}][nome]"]`).value;
            const curso = group.querySelector(`select[name="participantes[${index}][curso]"]`).value; // Alterado para <select>
            const turma = group.querySelector(`select[name="participantes[${index}][turma]"]`).value; // Alterado para <select>

            data.participantes.push({ nome, curso, turma });
        });

        fetch(url, {
            method: ocorrenciaId ? 'PUT' : 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data) // Envia o objeto JSON convertido
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                // Atualiza ou cria o card
                if (ocorrenciaId) {
                    updateOcorrencia(ocorrenciaId, {
                        ...data,
                        participantes: Array.isArray(data.participantes) 
    ? data.participantes.map(p => `${p.nome} (${p.curso}, ${p.turma})`).join(', ') 
    : 'Nenhum participante'

                    });
                } else {
                    renderOcorrencia({
                        ...data,
                        participantes: Array.isArray(data.participantes) 
    ? data.participantes.map(p => `${p.nome} (${p.curso}, ${p.turma})`).join(', ') 
    : 'Nenhum participante'

                    });
                }

                // Fecha o modal e limpa o formulário
                const infoModalInstance = bootstrap.Modal.getInstance(infoModalElement);
                infoModalInstance.hide();

                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                document.body.classList.remove('modal-open');
                document.body.style = "";

                document.getElementById('infoForm').reset();
                document.getElementById('infoForm').removeAttribute('data-id');
                document.querySelector('.btn-danger')?.remove();
                location.reload();
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
