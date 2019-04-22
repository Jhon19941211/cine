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

//FUNCION DE MODEL RESERVAR
var sala_id;
function modal_reservar(obj){
  let id = obj.id;
  $('#tabla').addClass('disable');
  $('#fh').empty().append('<option disabled selected="selected" value="">Selecciona...</option>')

  $.ajax({
  	url: 'pelicula/'+id,
  	dataType : 'json',
  	type: 'GET',	
  	success: function(data){
  		console.log(data);
      sala_id = data.sala.id;  
      var fh = data.fecha_horas;

      for (var i = 0; i < fh.length; i++) {
        $('#fh').append(
          '<option value="'+fh[i].id+'">'+fh[i].hora1+'</option>'
        ); 
      }  		 		
  	}
  });
}

//HABILITA EL DIV SILLAS
$("#fh").change(event =>{
  $('#tabla').removeClass('disable');     

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

  var hora = $('select[name="fh"] option:selected').text();

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
  });

  if (guardar.length > 0) {
    
    var objeto = {};
    objeto.datos = guardar;
    objeto.hora = hora;
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
          $("#exampleModalScrollable").hide();
        }
      });
    
    $("#exampleModalScrollable").modal("hide");
  }else{
    toastr.error('', 'Todos los servicios utilizados');
  }
  

});

// // imagenes
// // https://image.tmdb.org/t/p/w500/

// //generos
// // https://api.themoviedb.org/3/genre/movie/list?api_key=c1dece2ed8e7859a019d7ccb2d343be6&language=es-CO
