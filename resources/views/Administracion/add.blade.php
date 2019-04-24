@extends('app')
@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
  {{ session('error') }}
</div>
@endif
<div>
<a type="button" href="{{route('proyeccion.index')}}" class="btn btn-primary">Crear Proyección</a>
<a type="button" href="{{route('listar')}}" class="btn btn-secondary">Ver Proyecciones</a>
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
    <option selected>Seleccione</option>
    @foreach($peliculas as $pelicula)
      <option>{{$pelicula->nombre}}</option>
    @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="fechainicio">Fecha inicio</label>
    <input type="date" class="form-control" id="fechainicio" name="fechainicio">
  </div>

  <div class="form-group">
    <label for="fechafin">Fecha Fin</label>
    <input type="date" class="form-control" id="fechafin" name="fechafin">
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
