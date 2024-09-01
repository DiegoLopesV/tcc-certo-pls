@foreach($ocorrencias as $ocorrencia)
    <li>{{ $ocorrencia->turma }}: {{ $ocorrencia->descricao }}</li>
@endforeach