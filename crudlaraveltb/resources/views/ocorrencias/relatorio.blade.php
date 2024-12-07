<!doctype html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
            background-color: #fff;
        }

        h1 {
            text-align: center;
            color: #d9534f;
            margin-bottom: 20px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 15px;
            background-color: #fff;
        }

        .card-header {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 2px solid #d9534f;
            color: #333;
        }

        .card-header div {
            margin-bottom: 8px;
        }

        .card-header div:last-child {
            margin-bottom: 0;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col {
            flex: 1;
            margin: 5px;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .card {
                border: none;
                box-shadow: none;
            }

            .card-header {
                border-bottom: none;
            }
        }
    </style>
</head>

<body>
    <h1>{{ $title }}</h1>

    @foreach ($ocorrencias as $ocorrencia)
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div><strong>Título:</strong> {{ $ocorrencia->titulo }}</div>
                        <div><strong>Descrição:</strong> {{ $ocorrencia->descricao }}</div>
                        <div><strong>Participantes:</strong>
                            @if(is_array($ocorrencia->participantes) && !empty($ocorrencia->participantes))
                                <ul>
                                    @foreach($ocorrencia->participantes as $participante)
                                        @if(is_array($participante) && isset($participante['nome'], $participante['curso'], $participante['turma']))
                                            <li>{{ $participante['nome'] }} ({{ $participante['curso'] }}, {{ $participante['turma'] }})
                                            </li>
                                        @else
                                            <li>Participante inválido ou estrutura inesperada.</li>
                                        @endif
                                    @endforeach
                                </ul>
                            @else
                                <span>Nenhum participante registrado.</span>
                            @endif
                        </div>
                        <div><strong>Turma:</strong> {{ $ocorrencia->turma }}</div>
                        <div><strong>Data:</strong> {{ $ocorrencia->data }}</div>
                        <div><strong>Status:</strong> {{ $ocorrencia->status }}</div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</body>

</html>