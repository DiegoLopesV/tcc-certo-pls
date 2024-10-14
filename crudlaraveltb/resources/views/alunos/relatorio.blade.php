<!doctype html>
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
        .header-logo {
            display: flex;
            justify-content: space-between;
        }
        .header-logo img {
            width: 150px;
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
        .observacao, .relatorio {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 20px;
        }
        .header-instituto {
            text-align: center;
        }
        .relatorio h3 {
            color: #003366;
        }
        .advertencias {
            color: red;
        }
    </style>
</head>
<body>

    <div class="header-logo">
        <img src="https://yt3.googleusercontent.com/ytc/AIdro_kIgUiyLLXkDK4vViYocnzvW1IdIepxg56axcnUrUa_dQ=s900-c-k-c0x00ffffff-no-rj" alt="Logo IFPR">
    </div>

    <h1>FICHA INDIVIDUAL DE ACOMPANHAMENTO DE ESTUDANTE</h1>

    <h3>DADOS DO ESTUDANTE</h3>
    <table>
        <tr>
            <th>Nome</th>
            <td>{{ $aluno->nome }}</td>
            <th>Matrícula</th>
            <td>{{ $aluno->matricula }}</td>
            <th>Nascimento</th>
            <td>{{ $aluno->data_nascimento }}</td>
        </tr>
        <tr>
            <th>Curso</th>
            <td colspan="5">{{ $aluno->curso }}</td>
        </tr>
        <tr>
            <th colspan="6">Contatos</th>
        </tr>
        <tr>
            <td colspan="6">
                Responsáveis: <br>
                {{ $aluno->telefone_pais }} ({{ $aluno->nome_pais }}) <br>
                {{ $aluno->telefone_pais }} ({{ $aluno->nome_pais }})
            </td>
        </tr>
    </table>

    <div class="observacao">
        <strong>OBSERVAÇÕES:</strong>
        <p>{{ $aluno->observacoes }}</p>
    </div>

    <div class="relatorio">
        <h3>RELATÓRIO MULTIPROFISSIONAL</h3>
        <p>{{ $aluno->relatorio }}</p>
    </div>

    <div class="advertencias">
        <h3>ADVERTÊNCIAS / SUSPENSÕES</h3>
        <p>{{ $aluno->advertencias }}</p>
    </div>

</body>
</html>
