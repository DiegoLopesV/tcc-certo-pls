<!doctype html>
<html>
<body>
	<h1>{{ $title }}</h1>

	@foreach ( $disciplinas as $disciplina )
	<div class="row row-cols-1 row-cols-md-2 g-4">
		<div class="col">
			<div class="card">
				<div class="card-header">Nome: {{ $disciplina->nome }}</div>

			</div>

		</div>
	</div>
	@endforeach
</body>
</html>