@extends('layouts.app-master')
@section('content')
<div class="bg-light p-4 rounded">
<h1>Solicitação</h1>
<div class="lead">
Dados do solicitação
</div>
<div class="mt-2">
@include('layouts.partials.messages')
</div>
	<div class="container mt-4">
<form method="POST" action="{{ route('solicitacoes.store') }}">
@csrf
<div class="mb-3">
<label for="titulo" class="form-label">Título</label>
<input value="{{ old('titulo') }}"
type="text"
class="form-control"
name="titulo"
placeholder="Título" required>
@if ($errors->has('titulo'))
<span class="text-danger text-left">{{ $errors->first('titulo') }}</span>
@endif
</div>
<div class="mb-3">
<label for="texto" class="form-label">Texto</label>
<textarea
	class="form-control"
name="texto"
rows="5"
cols="80"
required>
{{ old('texto') }}
</textarea>
@if ($errors->has('texto'))
<span class="text-danger text-left">{{ $errors->first('texto') }}</span>
@endif
</div>
<button type="submit" class="btn btn-success">
	Salvar
</button>
<a href="{{ route('solicitacoes.index') }}" class="btn btn-danger">Cancelar</a>
</form>
</div>
	
</div>
@endsection

