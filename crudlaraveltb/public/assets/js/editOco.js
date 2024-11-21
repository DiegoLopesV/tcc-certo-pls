document.addEventListener('DOMContentLoaded', function () {
    // Função para editar a ocorrência
    window.editOcorrencia = function (id) {
        fetch(`/ocorrencias/${id}/edit`)
            .then((response) => response.json())
            .then((ocorrencia) => {
                // Preenche os campos básicos
                const tituloInput = document.getElementById('titulo');
                if (tituloInput) tituloInput.value = ocorrencia.titulo;

                const descricaoInput = document.getElementById('descricao');
                if (descricaoInput) descricaoInput.value = ocorrencia.descricao;

                const statusInput = document.getElementById('status');
                if (statusInput) statusInput.value = ocorrencia.status;

                const dataInput = document.getElementById('data');
                if (dataInput) {
                    const dataFormatada = new Date(ocorrencia.data).toISOString().split('T')[0];
                    dataInput.value = dataFormatada;
                }

                // Limpa os participantes existentes
                const participantsContainer = document.getElementById('participantsContainer');
                if (participantsContainer) participantsContainer.innerHTML = '';

                // Adiciona os participantes
                ocorrencia.participantes.forEach((participante, index) => {
                    const participantGroup = document.createElement('div');
                    participantGroup.className = 'participant-group';

                    participantGroup.innerHTML = `
                        <h4>Participante ${index + 1}</h4>
                        <label for="nome">Nome:</label>
                        <input type="text" name="participantes[${index}][nome]" value="${participante.nome}" required>
                        
                        <label for="curso">Curso:</label>
                        <select name="participantes[${index}][curso]" id="curso_${index}" required></select>
                        
                        <label for="turma">Turma:</label>
                        <select name="participantes[${index}][turma]" id="turma_${index}" required></select>
                        
                        <button type="button" class="remove-btn" onclick="removeParticipant(this)">Remover</button>
                    `;

                    participantsContainer.appendChild(participantGroup);

                    // Preenche os cursos
                    const cursoDropdown = document.getElementById(`curso_${index}`);
                    if (cursoDropdown) {
                        populateCursos(cursoDropdown); // Preenche os cursos
                        cursoDropdown.value = participante.curso; // Seleciona o curso atribuído

                        // Preenche as turmas relacionadas ao curso selecionado
                        const turmaDropdown = document.getElementById(`turma_${index}`);
                        if (turmaDropdown) {
                            populateTurmas(turmaDropdown, participante.curso); // Preenche as turmas do curso
                            turmaDropdown.value = participante.turma; // Seleciona a turma atribuída
                        }

                        // Atualiza o dropdown de turmas quando o curso mudar
                        cursoDropdown.addEventListener('change', () => {
                            if (turmaDropdown) populateTurmas(turmaDropdown, cursoDropdown.value);
                        });
                    }
                });

                // Configura o formulário
                const infoForm = document.getElementById('infoForm');
                if (infoForm) infoForm.setAttribute('data-id', id);

                // Mostra o modal
                const infoModal = new bootstrap.Modal(document.getElementById('infoModal'));
                if (infoModal) infoModal.show();
            })
            .catch((error) => console.error('Erro ao buscar a ocorrência:', error));
    };

    // Função para preencher as turmas de acordo com o curso selecionado
    function populateTurmas(turmaDropdown, curso) {
        turmaDropdown.innerHTML = '<option value="">Selecione a Turma</option>'; // Limpa as opções

        if (curso && turmasPorCurso[curso]) {
            turmasPorCurso[curso].forEach((turma) => {
                const option = document.createElement('option');
                option.value = turma;
                option.textContent = turma;
                turmaDropdown.appendChild(option);
            });
        }
    }
});
