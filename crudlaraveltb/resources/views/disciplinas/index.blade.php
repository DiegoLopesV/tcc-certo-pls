@extends('layouts.app-master')
 
@section('content')

<div class="bg-light p-4 rounded">
    <h1>Professores</h1>
    <div class="lead">
        Gerenciamento de Professores
        <br/>
        <a
        	href="{{ route('professores.create') }}"
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
            <th scope="col" width="15%">CPF</th>
            <th scope="col" width="15%">Data de nascimento</th>
            <th scope="col" width="10%">E-mail</th>
            <th scope="col" width="10%">Relatório disciplinas</th>
            <th scope="col" width="20%" colspan="3">Ações</th>    
              
        </tr>
        </thead>
        <tbody>
            @foreach($professors as $professor)
                <tr>
                    <th scope="row">{{ $professor->id }}</th>
                    <td>{{ $professor->nome }}</td>
                    <td>{{ $professor->cpf }}</td>
                    <td>{{ date('d/m/Y', strtotime($professor->data_nascimento)) }}</td>
                    <td>{{ $professor->email }}</td>
                    <td>
                    <a href="{{route('disciplinas.pdf', $professor->id)}}" class="btn btn-dark btn-sm float-left">Disciplinas</a>
                    </td>
                    
                    <td>
						
                    	<a href="{{ route('professores.show', $professor->id) }}" class="btn btn-secondary btn-sm ">Ver</a>
                    </td>
                    
                    <td>
                    	<a href="{{ route('professores.edit', $professor->id) }}" class="btn btn-info btn-sm ">Editar</a>
                    	<a href="{{ route('professoresMail.index', $professor->id) }}" class="btn btn-warning btn-sm ">Notificar</a>
                    </td>
                    
                    <td>
                        {!! Form::open(['method' => 'DELETE','route' => ['professores.destroy', $professor->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Remover', ['class' => 'btn btn-danger btn-sm ']) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex">
        {!! $professors->links() !!}
    </div>

</div>


@endsection

alguem cala a boca do albini
<!-- kkkkkk, ele n vai parar de falar agora
nao
f
ffffffffffffffffffffffffffffffffffffffffffffffffffffffff
enfim kk