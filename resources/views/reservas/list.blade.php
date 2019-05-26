@extends('app')
@section('content')
<table class="table table-striped table-bordered table-sm" id="table_reserva"  style="width:100%">
<thead>
  <tr class="bg-secondary">

     <th scope="col">Pelicula</th> 
    <th scope="col">Fecha</th>
     <th scope="col">Hora</th>
     <th scope="col">Valor</th>
    <th scope="col">Acciones</th>
  </tr>
</thead>

<tbody>
@foreach($reservas as $key => $value)
  <tr>
      <td>{{$value->nombre}}</td>
      <td>{{$value->fecha}}</td>
      <td>{{$value->hora}}</td>
      <td>$ 8.000</td>
      <td> <a  href="{{ route('pdf',$value->id) }}" ><img src="img/pdf.png" width="30" height="30"></a></td>
    </tr>
@endforeach
</tbody>
</table>
@endsection