@extends('app')

@section('content')

<style>
  .disable{
    pointer-events: none;
    opacity: 0.4;
  }

  .c{
    background: orange;
  }

  .unselectable{
    background-color: #ddd;
    pointer-events: none;
    cursor: not-allowed;
  }
</style>

<div class="container pl-5 pr-5 pt-5" id="papa">
  <h4>CARTELERA SEMANAL</h4>
  <div class="pelis">
  </div>

  <h4 class="mt-5">PREVENTA / PRÓXIMOS ESTRENOS</h4>
  <div class="pelis1">
  </div>
</div>

<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Reservar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
          <label for="f">Fecha de la función</label>          
          <select name="f" id="f" class="custom-select">

          </select>
          <label class="mt-2" for="fh">Hora de la función</label>          
          <select name="fh" id="fh" class="custom-select">
          </select>
        </div>        
        <div class="container mt-5 disable" id="tabla">
         <table class="table text-center">
           <tbody>
             <tr>
               <td>
                <label class="checkeable">
                 <input type="checkbox" class="mycheckbox" id="1" name="checkbox" style="display: none;">          
                 <i class="fas fa-couch"></i>
               </label>
             </td>
             <td>
               <label class="checkeable">
                 <input type="checkbox" class="mycheckbox" id="2" name="checkbox" style="display: none;">          
                 <i class="fas fa-couch"></i>
               </label>
             </td>
             <td>
              <label class="checkeable">
                <input type="checkbox" class="mycheckbox" id="3" name="checkbox" style="display: none;">          
                <i class="fas fa-couch"></i>
              </label>
            </td>
            <td>
              <label class="checkeable">
                <input type="checkbox" class="mycheckbox" id="4" name="checkbox" style="display: none;">          
                <i class="fas fa-couch"></i>
              </label>
            </td>
            <td>
              <label class="checkeable">
                <input type="checkbox" class="mycheckbox" id="5" name="checkbox" style="display: none;">          
                <i class="fas fa-couch"></i>
              </label>
            </td>
          </tr>
          <tr>
           <td>
             <label class="checkeable">
               <input type="checkbox" class="mycheckbox" id="6" name="checkbox" style="display: none;">          
               <i class="fas fa-couch"></i>
             </label>
           </td>
           <td>
             <label class="checkeable">
               <input type="checkbox" class="mycheckbox" id="7" name="checkbox" style="display: none;">          
               <i class="fas fa-couch"></i>
             </label>
           </td>
           <td>
            <label class="checkeable">
              <input type="checkbox" class="mycheckbox" id="8" name="checkbox" style="display: none;">          
              <i class="fas fa-couch"></i>
            </label>
          </td>
          <td>
            <label class="checkeable">
              <input type="checkbox" class="mycheckbox" id="9" name="checkbox" style="display: none;">          
              <i class="fas fa-couch"></i>
            </label>
          </td>
          <td>
            <label class="checkeable">
              <input type="checkbox" class="mycheckbox" id="10" name="checkbox" style="display: none;">          
              <i class="fas fa-couch"></i>
            </label>
          </td>
        </tr>
      </tbody>
    </table>
  </div>        
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="button" id="reservar" class="btn btn-primary">Reservar</button>
</div>
</div>
</div>
</div>

@endsection