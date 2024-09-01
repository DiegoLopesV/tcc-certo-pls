@extends('layouts.app-master')
@section('content')
<div class="bg-light p-4 rounded">
<h1>Alterar solicitação</h1>
<div class="lead">
</div>
<div class="container mt-4">
<form method="post" action="{{ route('solicitacoes.update', $solicitacao->id) }}">
@method('patch')
@csrf
<div class="mb-3">
<label for="titulo" class="form-label">Título</label>
<input value="{{ $solicitacao->titulo }}"
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
placeholder="texto" required>
{{ $solicitacao->texto }}
					</textarea>
@if ($errors->has('texto'))
<span class="text-danger text-left">{{ $errors->first('texto') }}</span>
@endif
</div>
<button type="submit" class="btn btn-success">Salvar</button>
<a href="{{ route('solicitacoes.index') }}" class="btn btn-danger">Cancelar</a>
</form>
</div>
</div>
@endsection



