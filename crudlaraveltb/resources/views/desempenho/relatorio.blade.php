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


        h6 {
            font-size: 18px;
            margin-top: 15px;
        }


        ul {
            padding-left: 20px;
        }


        ul li {
            font-size: 14px;
            margin-bottom: 5px;
        }
    </style>
</head>


<body>


    <div class="container">
        <h1>Ficha de Desempenho</h1>
        <table>
            <!-- Linha 1: Nome do Aluno -->
            <tr>
                <th>Nome:</th>
                <td class="resposta">{{ $aluno->nome }}</td>
            </tr>
            <!-- Linha 2: Curso e Turma -->
            <tr>
                <th>Curso e Turma:</th>
                <td class="resposta">{{ $aluno->curso }}</td>
            </tr>
            <!-- Linha 3: Contatos -->
            <tr>
                <th>Contatos:</th>
                <td class="resposta">
                    {{ $aluno->telefone_pais }}<br>
                    {{ $aluno->email_pais }}
                </td>
            </tr>
        </table>


        <!-- Relatório Pedagógico -->
        <h6>Ocorrências</h6>
        <ul id="ocorrenciasList">
            @if($aluno->ocorrencias && $aluno->ocorrencias->count() > 0)
                @foreach($aluno->ocorrencias as $ocorrencia)
                    <li>{{ $ocorrencia->titulo }} <br> Data: {{ $ocorrencia->data }} <br> Descrição:
                        {{ $ocorrencia->descricao }}
                    </li>
                @endforeach
            @else
                <li>Sem ocorrências registradas.</li>
            @endif
        </ul>


        <h6>Enfermaria</h6>
        <ul id="enfermariaList">
            @if($aluno->enfermarias && $aluno->enfermarias->count() > 0)
                @foreach($aluno->enfermarias as $enfermaria)
                    <li>{{ $enfermaria->data }} - {{ $enfermaria->titulo }} - {{ $enfermaria->descricao }}</li>
                @endforeach
            @else
                <li>Sem registros de enfermaria.</li>
            @endif
        </ul>




    </div>


</body>


</html>