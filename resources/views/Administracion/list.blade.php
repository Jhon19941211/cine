@extends('app')
@section('content')

<table align="center" border="3" width="50%">
  <thead>
    <tr class="table-secondary">
      <th scope="col">Fecha Inicio</th>
      <th scope="col">Fecha Fin</th>
      <th scope="col">Hora</th>
      <th scope="col">Num. Sala</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody >
    
    @foreach($horarios as $horario)  
    <tr>  
        <td >{{$horario['fechaInicio']}}</td>
        <td >{{$horario['fechaFin']}}</td>
        <td >{{$horario['hora']}}</td>
        <td >{{$horario['sala']}}</td>
        <td >
          <a   type="button" class="btn btn-primary">Editar</a>
          <a   type="button" class="btn btn-danger">Eliminar</a>
        </td>
     </tr>
    @endforeach
   
  </tbody>
</table>

@endsection