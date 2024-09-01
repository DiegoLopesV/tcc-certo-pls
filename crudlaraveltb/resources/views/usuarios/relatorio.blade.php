<!doctype html>
<html>
<body>
	<h1>{{ $title }}</h1>

	@foreach ( $users as $user )
	<div class="row row-cols-1 row-cols-md-2 g-4">
		<div class="col">
			<div class="card">
				<div class="card-header">Nome: {{ $user->nome }}</div>
				<div class="card-body">
					Email: {{ $user->email }} <br /> Regra: {{ $user->role }}
				</div>
			</div>
		</div>
	</div>
	@endforeach
</body>
</html>