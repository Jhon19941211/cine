<!DOCTYPE html>

<html>

<head>

	<title>Hi</title>

</head>

<body>
<table>
    <tr> 
        <td> <img src="img/cine.png"  height="92" width="126"/>
        </td>
        <td>
        <strong>FECHA Y HORA: </strong> {{$fecha}} <br>
        <strong>ID RESERVA: </strong>{{$id}} <br>
         <strong>NOMBRE: </strong>{{$nombre}}<br>
          <strong>EMAIL: </strong>{{$email}}
        </td>
    </tr>
</table>
<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633"  style="width:100%">
<thead>
  <tr >

     <th scope="col">Pelicula</th> 
    <th scope="col">Fecha</th>
     <th scope="col">Hora</th>
     <th scope="col">Valor</th>
  </tr>
</thead>

<tbody>
  <tr>
      <td>{{$reserva->nombre}}</td>
      <td>{{$reserva->fecha}}</td>
      <td>{{$reserva->hora}}</td>
      <td>$ 8.000</td>
    </tr>
</tbody>
</table>

</body>

</html>