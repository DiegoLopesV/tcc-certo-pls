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
                        @foreach (['Info 1', 'Info 2', 'Info 3', 'Info 4', 'Pg 1', 'Pg 2', 'Pg 3', 'Adm 1', 'Adm 2', 'Adm 3', 'Jogos 1', 'Jogos 2', 'Jogos 3', 'Jogos 4', 'Mecânica 1', 'Mecânica 2', 'Mecânica 3', 'Eletrônica 1', 'Eletrônica 2', 'Eletrônica 3', 'Contabilidade 1', 'Contabilidade 2', 'Contabilidade 3', 'Pf 1', 'Pf 2', 'Pf 3'] as $turma)
                        <div>
                            <input type="checkbox" name="turmas[]" value="{{ $turma }}" {{ in_array($turma, request('turmas', [])) ? 'checked' : '' }}>
                            <label>{{ $turma }}</label>
                        </div>
                        @endforeach
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
        const turmaColors = {
    'Info 1': 'rgba(75, 192, 192, 0.2)',  // Verde
    'Info 2': 'rgba(75, 192, 192, 0.4)',  // Verde mais escuro
    'Info 3': 'rgba(75, 192, 192, 0.6)',  // Verde ainda mais escuro
    'Info 4': 'rgba(75, 192, 192, 0.8)',  // Verde mais intenso
    'Pg 1': 'rgba(255, 99, 132, 0.2)',    // Vermelho
    'Pg 2': 'rgba(255, 99, 132, 0.4)',    
    'Pg 3': 'rgba(255, 99, 132, 0.6)',    
    'Adm 1': 'rgba(153, 51, 204, 0.2)',   // Roxo
    'Adm 2': 'rgba(153, 51, 204, 0.4)',    
    'Adm 3': 'rgba(153, 51, 204, 0.6)',    
    'Jogos 1': 'rgba(255, 105, 180, 0.2)', // Rosa
    'Jogos 2': 'rgba(255, 105, 180, 0.4)', 
    'Jogos 3': 'rgba(255, 105, 180, 0.6)', 
    'Jogos 4': 'rgba(255, 105, 180, 0.8)', 
    'Eletrônica 1': 'rgba(255, 206, 86, 0.2)', // Amarelo
    'Eletrônica 2': 'rgba(255, 206, 86, 0.4)', 
    'Eletrônica 3': 'rgba(255, 206, 86, 0.6)', 
    'Mecânica 1': 'rgba(54, 162, 235, 0.2)',   // Azul
    'Mecânica 2': 'rgba(54, 162, 235, 0.4)', 
    'Mecânica 3': 'rgba(54, 162, 235, 0.6)', 
    'Contabilidade 1': 'rgba(255, 165, 0, 0.2)', // Laranja
    'Contabilidade 2': 'rgba(255, 165, 0, 0.4)', 
    'Contabilidade 3': 'rgba(255, 165, 0, 0.6)', 
    'Pf 1': 'rgba(0, 0, 0, 0.2)', // Preto
    'Pf 2': 'rgba(0, 0, 0, 0.4)', 
    'Pf 3': 'rgba(0, 0, 0, 0.6)'  
};

const borderColors = {
    'Info 1': 'rgba(75, 192, 192, 1)',  // Verde
    'Info 2': 'rgba(75, 192, 192, 1)',  
    'Info 3': 'rgba(75, 192, 192, 1)',  
    'Info 4': 'rgba(75, 192, 192, 1)',  
    'Pg 1': 'rgba(255, 99, 132, 1)',    // Vermelho
    'Pg 2': 'rgba(255, 99, 132, 1)',    
    'Pg 3': 'rgba(255, 99, 132, 1)',    
    'Adm 1': 'rgba(153, 51, 204, 1)',   // Roxo
    'Adm 2': 'rgba(153, 51, 204, 1)',    
    'Adm 3': 'rgba(153, 51, 204, 1)',    
    'Jogos 1': 'rgba(255, 105, 180, 1)', // Rosa
    'Jogos 2': 'rgba(255, 105, 180, 1)', 
    'Jogos 3': 'rgba(255, 105, 180, 1)', 
    'Jogos 4': 'rgba(255, 105, 180, 1)', 
    'Eletrônica 1': 'rgba(255, 206, 86, 1)', // Amarelo
    'Eletrônica 2': 'rgba(255, 206, 86, 1)', 
    'Eletrônica 3': 'rgba(255, 206, 86, 1)', 
    'Mecânica 1': 'rgba(54, 162, 235, 1)',   // Azul
    'Mecânica 2': 'rgba(54, 162, 235, 1)', 
    'Mecânica 3': 'rgba(54, 162, 235, 1)', 
    'Contabilidade 1': 'rgba(255, 165, 0, 1)', // Laranja
    'Contabilidade 2': 'rgba(255, 165, 0, 1)', 
    'Contabilidade 3': 'rgba(255, 165, 0, 1)', 
    'Pf 1': 'rgba(0, 0, 0, 1)', // Preto
    'Pf 2': 'rgba(0, 0, 0, 1)', 
    'Pf 3': 'rgba(0, 0, 0, 1)'  
};

        // Dados do backend
        const dataFromBackend = @json($data);

        // Preparando os dados para o gráfico
        const labels = [];
        const datasets = [];

        dataFromBackend.forEach((entry) => {
            // Verifica se os valores são válidos e define valores padrão
            const month = entry.month;
            const label = `${month}`;

            if (!labels.includes(label)) {
                labels.push(label);
            }

            let dataset = datasets.find(ds => ds.label === entry.turma);
            if (!dataset) {
                dataset = {
                    label: entry.turma,
                    data: Array(labels.length).fill(0), // Preenche com zeros inicialmente
                    backgroundColor: turmaColors[entry.turma] || 'rgba(201, 203, 207, 0.2)',
                    borderColor: borderColors[entry.turma] || 'rgba(201, 203, 207, 1)',
                    borderWidth: 1
                };
                datasets.push(dataset);
            }

            const labelIndex = labels.indexOf(label);
            dataset.data[labelIndex] = entry.total; // Preenche com o total correto
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
