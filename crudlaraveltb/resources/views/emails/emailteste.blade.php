<!DOCTYPE html>
<html>

<head>
    <title>IFPR</title>
</head>

<body>
    
    <h1>{{ $mailData['title'] }}</h1>

    <p>{{ $mailData['body'] }}</p>

    <p>Segue abaixo um relatório de suas disciplinas:</p>

    <!-- Lista não ordenada (ul) para mostrar as disciplinas -->
    <ul>
        @foreach($mailData['disciplinas'] as $disciplina)
            <li>{{ $disciplina->nome }}</li>
        @endforeach
    </ul>

    <p>Obrigado</p>

</body>

</html>
