@extends('app')
@section('content')
<table class="table table-striped table-bordered table-sm" id="table_horarios"  style="width:100%">
<thead>
  <tr class="bg-secondary">
    <th scope="col">Id</th>
    <th scope="col">Fecha</th>
    <th scope="col">Hora</th>
    <th scope="col">Pelicula</th>
    <th scope="col">Sala</th>
    <th scope="col">Acciones</th>
  </tr>
</thead>
</table>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="alert alert-danger" style="display:none"></div>
    <div class="alert alert-success" style="display:none"></div>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Proyección</h4>
      </div>
      <form >
      @csrf {{method_field('PATCH')}}
	      <div class="modal-body">
        <input type="hidden" class="form-control" id="id" name="id">  

        <label for="sala">Sala</label>
          <select class="form-control" id="sala" name="sala">
          
          </select>
          <label for="pelicula">Pelicula</label>
          <select class="form-control" id="pelicula" name="pelicula">
          
          </select>
             <br>
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha">  

            <label for="hora">Hora</label>
           <select class="form-control" id="hora" name="hora">
          
          </select>
            
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
	        <button  class="btn btn-success" id="ajaxSubmit">Guardar cambios</button>
	      </div>
      </form>
    </div>
  </div>
</div>

@endsection