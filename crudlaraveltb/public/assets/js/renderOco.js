function renderOcorrencia(id, formData) {
    const infoBox = document.createElement('div');
    infoBox.className = 'aluno-card rounded text-center border border-dark border-2 excesso';
    infoBox.setAttribute('data-id', id);

    infoBox.innerHTML = `
        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-warning m-2" onclick="editOcorrencia(${id})">Editar</button>
        </div>
        <p><strong>Título:</strong> ${formData.get('titulo')}</p>
        <p><strong>Descrição:</strong> ${formData.get('descricao')}</p>
        <p><strong>Participantes:</strong> ${formData.get('participantes')}</p>
        <p><strong>Turma:</strong> ${formData.get('turma')}</p>
        <p><strong>Data:</strong> ${formData.get('data')}</p>
        <p><strong>Status:</strong> ${formData.get('status')}</p>
    `;

    document.getElementById('ocorrenciaContainer').appendChild(infoBox);
}

function updateOcorrencia(id, formData) {
    const card = document.querySelector(`[data-id='${id}']`);
    if (card) {
        card.innerHTML = `
            <div class="d-flex justify-content-end">
                <button class="btn btn-sm btn-warning m-2" onclick="editOcorrencia(${id})">Editar</button>
            </div>
            <p><strong>Título:</strong> ${formData.get('titulo')}</p>
            <p><strong>Descrição:</strong> ${formData.get('descricao')}</p>
            <p><strong>Participantes:</strong> ${formData.get('participantes')}</p>
            <p><strong>Turma:</strong> ${formData.get('turma')}</p>
            <p><strong>Data:</strong> ${formData.get('data')}</p>
            <p><strong>Status:</strong> ${formData.get('status')}</p>
        `;
    }
}
