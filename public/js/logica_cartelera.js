////////////TOAST/////////////////////////////////////////////
toastr.options = {
  "progressBar": true,
  "closeButton": true,
  "positionClass": "toast-bottom-right",
  "timeOut": "2000",
  "preventDuplicates": true,
};

//CARGA PELICULAS - CARTELERA Y ESTRENOS
$( window ).on( "load", function() {
  $.ajax({
    url: "https://api.themoviedb.org/3/movie/now_playing?api_key=c1dece2ed8e7859a019d7ccb2d343be6&language=es-CO&page=1",
    type: "GET",
    success: function(data){
      var peliculas = data.results;

      for (var j = 0; j < peliculas.length ; j++) {
        var pelicula = peliculas[j];

        $('.pelis').append(
          '<div class="card border-ligth">'+
          '<a href="#" id="'+pelicula.id+'" onclick="modal_reservar(this)" data-toggle="modal" data-target="#exampleModalScrollable"><img src="https://image.tmdb.org/t/p/w300/'+pelicula.backdrop_path+'" class="card-img-top"></a>'+
          '<div class="card-body">'+
          '<p class="card-title" style="font-size: 15px;">'+pelicula.title+'</p>'+				    
          '</div>'+
          '</div>'
        );
      }

      $('.pelis').slick({
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 3,			
      });		
    }
  });

  $.ajax({
    url: "https://api.themoviedb.org/3/movie/upcoming?api_key=c1dece2ed8e7859a019d7ccb2d343be6&language=es-CO&page=1",
    type: "GET",
    success: function(data){
      var peliculas = data.results;
      
      for (var j = 0; j < peliculas.length ; j++) {
       var pelicula = peliculas[j];

        $('.pelis1').append(
          '<div class="card border-ligth">'+
          '<a href="#" id="'+pelicula.id+'" data-toggle="modal" data-target="#exampleModalScrollable"><img src="https://image.tmdb.org/t/p/w300/'+pelicula.backdrop_path+'" class="card-img-top"></a>'+
          '<div class="card-body">'+
          '<p class="card-title" style="font-size: 15px;">'+pelicula.title+'</p>'+				    
          '</div>'+
          '</div>'
        );
      }

      $('.pelis1').slick({
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 3,			
      });		
    }
  });
});

//FUNCION DE MODEL RESERVAR - CARGA HORARIOS
var proyeccion;
let id;
var objeto_horarios = {};
function modal_reservar(obj){
  id = obj.id;
  $('#tabla').addClass('disable');
  $('#fh').empty().append('<option disabled selected="selected" value="">Selecciona...</option>')
  $('#f').empty().append('<option disabled selected="selected" value="">Selecciona...</option>')

  $('.mycheckbox').each(function(){
    $(this).parent().parent().removeClass('unselectable');
    $(this).parent().parent().removeClass('c');
    this.checked=false;    
  });

  $.ajax({
  	url: 'pelicula/'+id,
  	dataType : 'json',
  	type: 'GET',	
  	success: function(data){
  		console.log(data);
      proyeccion = data.proyeccion;  

      objeto_horarios = {};

      for (var i = 0; i < proyeccion.length; i++) {
        
        var horarios = [];

        var fecha1 = proyeccion[i].fecha_hora;
        horarios.push({
          'fecha': fecha1.fecha,
        });
        horarios.push({
          'hora': fecha1.hora,
        }); 

        for (var j = i+1; j < proyeccion.length; j++) {
          var fecha2 = proyeccion[j].fecha_hora;
          if (fecha1.fecha == fecha2.fecha) {
            horarios.push({
              'hora': fecha2.hora,
            }); 
            i++;
          }else{
            objeto_horarios[i]=horarios;
            break;
          }
        }
        objeto_horarios[i]=horarios;
      }
      
      console.log(objeto_horarios);

      $.each(objeto_horarios, function(i,item){
        $.each(item, function(i,item1){
          $('#f').append(
              '<option>'+item1.fecha+'</option>'
          );
          return false;
        });         
      });		 		
  	}
  });
}

//CARGA HORAS
$("#f").change(event =>{
  $('#tabla').addClass('disable'); 
  $('.mycheckbox').each(function(){
    $(this).parent().parent().removeClass('unselectable');
    $(this).parent().parent().removeClass('c');
    this.checked=false;
  });

  var selec = $('select[name="f"] option:selected').text();

  $('#fh').empty().append('<option disabled selected="selected" value="">Selecciona...</option>')

  $.each(objeto_horarios, function(i,item){
    if (item[0].fecha==selec) {
      for (var i = 1; i < item.length; i++) {
        $('#fh').append(
          '<option>'+item[i].hora+'</option>'
        );
      }
    }          
  });       
});

//HABILITA EL DIV SILLAS
$("#fh").change(event =>{
  $('#tabla').removeClass('disable'); 
  
  $('.mycheckbox').each(function(){
    $(this).parent().parent().removeClass('unselectable');
    $(this).parent().parent().removeClass('c');
    this.checked=false;      
  });

  var hora = $('select[name="fh"] option:selected').text();

  $.ajax({
    url: 'marcados/'+id+'/'+hora,
    dataType : 'json',
    type: 'GET',  
    success: function(data){
      console.log(data);

      for (var i = 0; i < data.length; i++) {
        var silla = data[i].silla;

        $('.mycheckbox').each(function(){
          var num = $(this)[0].id;  

          if(silla.fila == 2){
            if(silla.columna == num-5){
              $(this).parent().parent().addClass('unselectable');
            }
          }else{
            if(silla.columna == num){
              $(this).parent().parent().addClass('unselectable');
            }
          }
        }); 
      }
              
    }
  });
});

//SILLAS A RESERVAR
$(".mycheckbox").click(function(e){
  if( $(this).is(':checked') ){        
    $(this).parent().parent().addClass('c');
  }else{        
    $(this).parent().parent().removeClass('c');
  }
});


//BOTON RESERVAR
$("#reservar").click(function(e){  

  var sala_id;
  var proyeccion_id;
  var fecha_hora_id;

  var fecha = $('select[name="f"] option:selected').text();
  var hora = $('select[name="fh"] option:selected').text();

  //BUSCA LA PROYECCION SEGUN LA HORA
  for (var i = 0; i < proyeccion.length; i++) {
    var p = proyeccion[i];
    if (p.fecha_hora.hora == hora) {
      sala_id = p.sala_id;
      proyeccion_id = p.id;
    }
  }

  var guardar = [];
  $("input:checkbox:checked").each(function() {
    var ids = $(this).attr('id');
    var id=parseInt(ids);

    if (id > 5) {      
      guardar.push({
        'fila':2,
        'columna': id-5,
        'sala_id': sala_id
      }); 
    }else{
      guardar.push({
        'fila':1,
        'columna': id,
        'sala_id': sala_id
      }); 
    }

    $(this).parent().parent().removeClass('c');
    this.checked=false;
  });

  if (fecha != "" && hora!= "" && guardar.length > 0) {
    
    var objeto = {};
    objeto.datos = guardar;

    objeto.proyeccion_id = proyeccion_id;

    console.log(objeto);

    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      url: 'reserva',
      dataType : 'json',
      type: 'POST',
      data: objeto,     
      success: function(data){ 
          console.log(data);
      }
    });
    
    $("#exampleModalScrollable").modal("hide");
  }else{
    toastr.error('', 'Digite los campos solicitados');
  }
});

// // imagenes
// // https://image.tmdb.org/t/p/w500/

// //generos
// // https://api.themoviedb.org/3/genre/movie/list?api_key=c1dece2ed8e7859a019d7ccb2d343be6&language=es-CO
