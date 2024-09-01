@extends('layouts.app-master')
 
@section('content')

<div class="bg-light p-4 rounded">
    <h1>Disciplinas</h1>
    <div class="lead">
        Gerenciamento de Disciplinas
        <br/>
        <a
        	href="{{ route('disciplinas.create') }}"
        	class="btn btn-primary btn-sm float-right">
        	Criar novo
        </a>
    </div>
    
    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

	<table class="table table-striped">
        <thead>
        <tr>
            <th scope="col" width="1%">ID</th>
            <th scope="col">Nome</th>
            <th scope="col" width="15%">Curso</th>
            <th scope="col" width="15%">Sigla</th>
            <th scope="col" width="10%">Carga horária</th>
            <th scope="col" width="1%" colspan="3">Ações</th>    
        </tr>
        </thead>
        <tbody>
            @foreach($disciplinas as $disciplina)
                <tr>
                    <th scope="row">{{ $disciplina->id }}</th>
                    <td>{{ $disciplina->nome }}</td>
                    <td>{{ $disciplina->curso }}</td>
                    <td>{{ $disciplina->sigla }}</td>
                    <td>{{ $disciplina->carga_horaria }}</td>
                    <td>
                    	<a href="{{ route('disciplinas.show', $disciplina->id) }}" class="btn btn-secondary btn-sm">Ver</a>
                    </td>
                    <td>
                    	<a href="{{ route('disciplinas.edit', $disciplina->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE','route' => ['disciplinas.destroy', $disciplina->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Remover', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex">
        {!! $disciplinas->links() !!}
    </div>

</div>


@endsection