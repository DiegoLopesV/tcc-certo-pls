@include('layouts.partials.essentials')
@include('layouts.partials.navbarlogged')
<form id="passarDeAnoForm">
    @csrf
    <table class="table m-2">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Turma Atual</th>
                <th>Aprovado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alunos as $aluno)
            <tr>
                <td>{{ $aluno->nome }}</td>
                <td>{{ $aluno->turma }}</td>
                <td>
                    <input  id="checkbox" type="checkbox" name="alunos[{{ $aluno->id }}]" checked>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary m-2">Passar de Ano</button>
</form>

<script>
    document.getElementById('passarDeAnoForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Evita o envio padrão do formulário

        const formData = new FormData(this);

        fetch('{{ route('alunos.passarDeAno') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Alunos atualizados com sucesso!') {
                // Atualiza a UI diretamente após a resposta de sucesso
                alert(data.message);
                location.reload(); // Recarrega a página para refletir as mudanças
            }
        })
        .catch(error => console.error('Erro:', error));
    });
</script>
