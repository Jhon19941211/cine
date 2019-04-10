@extends('app')
@section('content')
@if ($errors->any())
<div class="alert alert-danger" role="alert">

	@foreach ($errors->all() as $error)
	<span>{{ $error }}</span>
	@endforeach

</div>
@endif

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
  {{ session('error') }}
</div>
@endif
<form method="POST" action="{{route('user.update',[Auth::user()->id])}}">
	{{csrf_field()}} {{method_field('PUT')}}
	<div class="form-group">
		<label for="name">Nombre</label>
		<input type="text" class="form-control" name="name" id="name" placeholder="Nombre" value="{{ Auth::user()->name}}">
	</div>
	<div class="form-group">
		<label for="email">Correo Electrónico</label>
		<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="example@example.com" value="{{ Auth::user()->email}}">

	</div>
	<button type="submit" class="btn btn-primary">Editar</button>
</form>
@endsection
