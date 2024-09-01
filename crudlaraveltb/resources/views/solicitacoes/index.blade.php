@extends('layouts.app-master')
@section('content')
<div class="bg-light p-4 rounded">
<h1>Solicitações</h1>
<div class="lead">
Gerenciamento de solicitações
<br/>
<a href="{{ route('solicitacoes.create') }}"
	class="btn btn-primary btn-sm float-left">
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
<th scope="col">Título</th>
<th scope="col" width="15%">Status</th>
<th scope="col" width="15%">Data</th>
<th scope="col" width="1%" colspan="3">Ações</th>
</tr>
</thead>
<tbody>
@foreach($solicitacoes as $solicitacao)
<tr>
<th scope="row">{{ $solicitacao->id }}</th>
<td>{{ $solicitacao->titulo }}</td>
<td>{{ $solicitacao->status }}</td>
<td>{{ date('d/m/Y', strtotime($solicitacao->data)) }}</td>
<td><a href="{{ route('solicitacoes.show', $solicitacao->id) }}" class="btn btn-warning btn-sm">Ver</a></td>
					<td><a href="{{ route('solicitacoes.edit', $solicitacao->id) }}" class="btn btn-secondary btn-sm">Editar</a></td>
<td>
	{!! Form::open(['method' => 'DELETE','route' => ['solicitacoes.destroy', $solicitacao->id],'style'=>'display:inline']) !!}
	{!! Form::submit('Remover', ['class' => 'btn btn-danger btn-sm']) !!}
	{!! Form::close() !!}
</td>
</tr>
@endforeach
</tbody>
</table>
<div class="d-flex">
{!! $solicitacoes->links() !!}
</div>
</div>
@endsection

