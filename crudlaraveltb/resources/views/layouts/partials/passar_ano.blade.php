@include('layouts.partials.essentials')
@include('layouts.partials.navbarlogged')


<form class="m-3" action="{{ route('passar_ano') }}" method="POST">
    @csrf
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Curso</th>
                <th>Ano Atual</th>
                <th>Reprovar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alunos as $aluno)
                <tr>
                    <td>{{ $aluno->nome }}</td>
                    <td>{{ $aluno->curso }}</td>
                    <td>{{ $aluno->ano_atual }}</td>
                    <td>
                        <input type="checkbox" name="alunos_reprovados[]" value="{{ $aluno->id }}">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit">Promover Alunos</button>
</form>

