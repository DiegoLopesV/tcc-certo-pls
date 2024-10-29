<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h1 {
            text-align: center;
            font-size: 16px;
            color: #003366;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        td, th {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Relatório Napne</h1>

    <h3>Informações do Relatório</h3>
    <table>
        <tr>
            <th>Bimestre</th>
            <td>{{ $dados['bimestre'] }}</td>
        </tr>
        <tr>
            <th>Aluno(a)</th>
            <td>{{ $dados['aluno'] }}</td>
        </tr>
        <tr>
            <th>Curso e Turma</th>
            <td>{{ $dados['cursoTurma'] }}</td>
        </tr>
        <tr>
            <th>Disciplina</th>
            <td>{{ $dados['disciplina'] }}</td>
        </tr>
        <tr>
            <th>Professor(a)</th>
            <td>{{ $dados['professor'] }}</td>
        </tr>
        <tr>
            <th>Objetivos do Bimestre</th>
            <td>{{ $dados['objetivos'] }}</td>
        </tr>
        <tr>
            <th>Nível de Participação</th>
            <td>{{ $dados['participacao'] }}</td>
        </tr>
        <tr>
            <th>Avaliação</th>
            <td>{{ $dados['avaliacao'] }}</td>
        </tr>
        <tr>
            <th>Métodos que Facilitaram a Aprendizagem</th>
            <td>{{ $dados['metodos'] }}</td>
        </tr>
        <tr>
            <th>Dificuldades</th>
            <td>{{ $dados['dificuldades'] }}</td>
        </tr>
        <tr>
            <th>Informações Importantes</th>
            <td>{{ $dados['informacoes'] }}</td>
        </tr>
        <tr>
            <th>Data</th>
            <td>{{ $dados['data'] }}</td>
        </tr>
