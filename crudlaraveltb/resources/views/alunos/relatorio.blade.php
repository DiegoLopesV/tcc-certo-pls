<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Acompanhamento Discente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #000;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #000;
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #000;
            text-align: left;
            vertical-align: top;
        }

        th {
            font-weight: bold;
            width: 25%;
            /* Define a largura dos cabeçalhos para uma aparência uniforme */
        }

        .resposta {
            font-weight: normal;
            /* Remove o negrito das respostas */
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Ficha de Acompanhamento Discente</h1>
        <table>
            <!-- Linha 1: Bimestre e Aluno -->
            <tr>
                <th>Bimestre:</th>
                <td class="resposta">{{ $dados['bimestre'] }}</td>
                <th>Aluno(a):</th>
                <td class="resposta">{{ $dados['aluno'] }}</td>
            </tr>
            <!-- Linha 2: Curso e Turma, Disciplina -->
            <tr>
                <th>Curso e Turma:</th>
                <td class="resposta">{{ $dados['cursoTurma'] }}</td>
                <th>Disciplina:</th>
                <td class="resposta">{{ $dados['disciplina'] }}</td>
            </tr>
            <!-- Linha 3: Professor -->
            <tr>
                <th>Professor(a):</th>
                <td class="resposta" colspan="3">{{ $dados['professor'] }}</td>
            </tr>

            <tr>
                <th>Objetivos do aluno:</th>
                <td class="resposta" colspan="3">{{ $dados['objetivos_aluno'] ?? '' }}</td>
            </tr>
            <!-- Linha 4: Objetivos do bimestre -->
            <tr>
                <th>Objetivos do bimestre alcançados pelo estudante:</th>
                <td class="resposta" colspan="3">{{ $dados['objetivos'] }}</td>
            </tr>
            <!-- Linha 5: Nível de participação -->
            <tr>
                <th>Nível de participação do estudante nas atividades:</th>
                <td class="resposta" colspan="3">{{ $dados['participacao'] }}</td>
            </tr>
            <!-- Linha 6: Critérios e instrumentos de avaliação -->
            <tr>
                <th>Critérios e instrumentos de avaliação utilizados:</th>
                <td class="resposta" colspan="3">{{ $dados['avaliacao'] }}</td>
            </tr>
            <!-- Linha 7: Métodos que facilitaram a aprendizagem -->
            <tr>
                <th>Métodos que facilitaram a aprendizagem:</th>
                <td class="resposta" colspan="3">{{ $dados['metodos'] }}</td>
            </tr>
            <!-- Linha 8: Dificuldades -->
            <tr>
                <th>Dificuldades:</th>
                <td class="resposta" colspan="3">{{ $dados['dificuldades'] }}</td>
            </tr>
            <!-- Linha 9: Informações importantes -->
            <tr>
                <th>Informações importantes:</th>
                <td class="resposta" colspan="3">{{ $dados['informacoes'] }}</td>
            </tr>
        </table>
    </div>

</body>

</html>