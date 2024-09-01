<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @include('layouts.partials.essentials')
</head>
<body id="body">
    <!-- Navbar -->
    @include('layouts.partials.navbarlogged')

    <!-- Botão para abrir o modal de filtro -->
    <div class="p-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
            Filtrar por turma
        </button>
    </div>

    <!-- Modal com checkboxes para filtrar por turma -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="GET" action="{{ route('graficosEnf') }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterModalLabel">Filtrar por Turma</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <input type="checkbox" name="turmas[]" value="Info 1" {{ in_array('Info 1', request('turmas', [])) ? 'checked' : '' }}>
                            <label for="turma1">Info 1</label>
                        </div>
                        <div>
                            <input type="checkbox" name="turmas[]" value="Info 2" {{ in_array('Info 2', request('turmas', [])) ? 'checked' : '' }}>
                            <label for="turma2">Info 2</label>
                        </div>
                        <div>
                            <input type="checkbox" name="turmas[]" value="Info 3" {{ in_array('Info 3', request('turmas', [])) ? 'checked' : '' }}>
                            <label for="turma3">Info 3</label>
                        </div>
                        <div>
                            <input type="checkbox" name="turmas[]" value="Info 4" {{ in_array('Info 4', request('turmas', [])) ? 'checked' : '' }}>
                            <label for="turma4">Info 4</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Aplicar Filtro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Canvas para o gráfico -->
    <canvas class="d-flex mx-auto" style="max-width: 800px; max-height: 600px;" id="myChart"></canvas>
    
    <script>
        // Mapeamento de cores para cada turma
        const turmaColors = {
            'Info 1': 'rgba(255, 99, 132, 0.2)',  // Vermelho
            'Info 2': 'rgba(255, 206, 86, 0.2)',  // Amarelo
            'Info 3': 'rgba(54, 162, 235, 0.2)',  // Azul
            'Info 4': 'rgba(75, 192, 192, 0.2)'   // Verde
        };

        const borderColors = {
            'Info 1': 'rgba(255, 99, 132, 1)',  // Vermelho
            'Info 2': 'rgba(255, 206, 86, 1)',  // Amarelo
            'Info 3': 'rgba(54, 162, 235, 1)',  // Azul
            'Info 4': 'rgba(75, 192, 192, 1)'   // Verde
        };

        // Dados do backend
        const dataFromBackend = @json($data);

        // Preparando os dados para o gráfico
        const labels = [];
        const datasets = [];

        dataFromBackend.forEach((entry) => {
            if (!labels.includes(entry.month)) {
                labels.push(entry.month);
            }

            let dataset = datasets.find(ds => ds.label === entry.turma);
            if (!dataset) {
                dataset = {
                    label: entry.turma,
                    data: [],
                    backgroundColor: turmaColors[entry.turma] || 'rgba(201, 203, 207, 0.2)',
                    borderColor: borderColors[entry.turma] || 'rgba(201, 203, 207, 1)',
                    borderWidth: 1
                };
                datasets.push(dataset);
            }
            dataset.data.push(entry.total);
        });

        // Criando o gráfico
        const ctx = document.getElementById('myChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
