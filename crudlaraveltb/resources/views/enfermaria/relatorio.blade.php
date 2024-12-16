<!doctype html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #0056b3;
            margin-bottom: 20px;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            padding: 15px;
            background-color: #fff;
        }
        .card-header {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0056b3;
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

    @foreach ($enfermaria as $item)
    <div class="card">
        <div class="card-header">
            <div><strong>Responsável:</strong> {{ $item->responsavel }}</div>
            <div><strong>Descrição:</strong> {{ $item->descricao }}</div>
            <div><strong>Pessoas:</strong> {{ $item->pessoas }}</div>
            <div><strong>Turma:</strong> {{ $item->turma }}</div>
            <div><strong>Data:</strong> {{ $item->data }}</div>
            <div><strong>Status:</strong> {{ $item->status }}</div>
        </div>
    </div>
    @endforeach
</body>
</html>
