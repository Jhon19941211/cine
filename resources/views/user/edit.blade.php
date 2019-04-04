@extends('app')
	@section('content')
		<form method="POST" action="{{route('user.update',[Auth::user()->id])}}">
		 {{csrf_field()}} {{method_field('PUT')}}
		 <div class="form-group">
		    <label for="exampleInputPassword1">Nombre</label>
		    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nombre" value="{{ Auth::user()->name}}">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Correo Electrónico</label>
		    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@example.com" value="{{ Auth::user()->email}}">
		   
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Contraseña</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Digite su contraseña" value=" Auth::user()->password">
		  </div>
		  <button type="submit" class="btn btn-primary">Editar</button>
		</form>
	@endsection
