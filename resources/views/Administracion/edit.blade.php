@extends('app')
@section('content')
<div>
<a type="button" href="{{route('proyeccion.index')}}" class="btn btn-primary">Crear Proyección</a>
<a type="button" href="{{route('list')}}" class="btn btn-secondary">Ver Proyecciones</a>
</div>
<hr>
<form method="POST" action="{{route('proyeccion.store')}}">
{{csrf_field()}} 
  <div class="form-group">
      <label for="sala">Sala</label>
      <select class="form-control" id="sala" name="sala">
      <option selected>Seleccione</option>
        @foreach ($salas as $sala)
          <option>{{$sala->id}}</option>
        @endforeach
      
      </select>
  </div>

  <div class="form-group">
    <label for="pelicula">Pelicula</label>
    <select class="form-control" id="pelicula" name="pelicula">
    <option>Seleccione</option>
    @foreach($peliculas as $movie)
      @if($proyeccion->pelicula->nombre==$movie->nombre)
      <option selected>{{$movie->nombre}}</option>
      @endif
      <option>{{$movie->nombre}}</option>
    @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="fecha">Fecha</label>
    <input type="date" class="form-control" id="fecha" name="fecha">
  </div>

  <div class="form-group">
    <label for="hora">Hora</label>
    <select class="form-control" id="hora" name="hora">   
       <option selected="true">Seleccione</option>
       <option>06:00 PM</option>
       <option>08:00 PM</option>
       <option>10:00 PM</option>
     </select>
  </div>

  <button type="submit" class="btn btn-success">Guardar proyección</button>
</form>
@endsection
