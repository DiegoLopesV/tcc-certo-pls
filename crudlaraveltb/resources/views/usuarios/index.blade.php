@extends('layouts.app-master')


@section('content')

<div class="bg-light p-4 rounded">
    <h1>Usuários</h1>
    <div class="lead">
        Gerenciamento de Usuários
        <br/>
        <a href="{{ route('usuarios.create') }}"
        	class="btn btn-primary btn-sm float-left">
        	Criar novo 
        </a>
        <a href="{{route('usuarios.pdf',['download'=>'pdf'])}}" class="btn btn-secondary btn-sm float-left">PDF</a>       
    </div>
    
    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

	<table class="table table-striped">
        <thead>
        <tr>
            <th scope="col" width="1%">ID</th>
            <th scope="col">Nome</th>
            <th scope="col" width="15%">E-mail</th>
            <th scope="col" width="1%" colspan="3">Ações</th>    
        </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->nome }}</td>
                    <td>{{ $user->email }}</td>
                    <td><a href="{{ route('usuarios.show', $user->id) }}" class="btn btn-warning btn-sm">Ver</a></td>
					<td><a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-info btn-sm">Editar</a></td>
                    <td>
						{!! Form::open(['method' => 'DELETE','route' => ['usuarios.destroy', $user->id],'style'=>'display:inline']) !!}
						{!! Form::submit('Remover', ['class' => 'btn btn-danger btn-sm']) !!}
						{!! Form::close() !!}
					</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex">
        {!! $users->links() !!}
    </div>
</div>

@endsection

