//PELICULAS
$.ajax({
	url: "https://api.themoviedb.org/3/discover/movie?api_key=c1dece2ed8e7859a019d7ccb2d343be6&language=es-CO&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&year=2019",
	type: "GET",
	success: function(data){
		$.ajax({
			url: "https://api.themoviedb.org/3/genre/movie/list?api_key=c1dece2ed8e7859a019d7ccb2d343be6&language=es-CO",
			type: "GET",
			success: function(data1){
				asd(data.results,data1.genres);				
			}
		});
	}
});

//GENEROS


function asd(peliculas, generos){

	for (var i = 0; i < generos.length ; i++) {
		var id = generos[i].id;
		var name = generos[i].name;
		
		for (var j = 0; j < peliculas.length ; j++) {
			var pelicula = peliculas[j];
			if(pelicula.genre_ids[0]==id){
				if ( $("#"+name).length > 0) {
					$('#'+name+'1').append(
						'<div class="carousel-item">'+
						'<div class="container">'+
						'<div class="row justify-content-md-center">'	+								
						'<div class="card" style="width: 50%;">'+
						'<img src="https://image.tmdb.org/t/p/w500/'+pelicula.backdrop_path+'" class="d-block w-100" alt="...">'+
						'<div class="card-body">'+
						'<h5 class="card-title">'+pelicula.original_title+'</h5>'+
						'<p class="card-text">'+pelicula.overview+'</p>'+
						'<a href="#" id="'+pelicula.id+'" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">Ver horarios</a>'+						
						'</div>'+
						'</div>'+
						'</div>'+
						'</div>'+
						'</div>'
					);
				}else{
					$('#papa').append(
						'<div id="'+name+'" class="carousel slide" data-ride="carousel">'+
							'<div class="carousel-inner" id="'+name+'1">'+
								'<h3 class="text-center mt-5 mb-3">'+name+'</h3>'+		    							
								'<div class="carousel-item active">'+
									'<div class="container">'+
										'<div class="row justify-content-md-center">'	+								
											'<div class="card" style="width: 50%;">'+
												'<img src="https://image.tmdb.org/t/p/w500/'+pelicula.backdrop_path+'" class="d-block w-100" alt="...">'+
												'<div class="card-body">'+
													'<h5 class="card-title">'+pelicula.original_title+'</h5>'+
													'<p class="card-text">'+pelicula.overview+'</p>'+													
													'<a href="#" id="'+pelicula.id+'" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">Ver horarios</a>'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>'+		    							
							'</div>'+
							'<a class="carousel-control-prev" href="#'+name+'" role="button" data-slide="prev">'+
							'<i class="fas fa-backward" style="color: black; font-size: 40px;"></i>	'	+
							'</a>'+
							'<a class="carousel-control-next" href="#'+name+'" role="button" data-slide="next">'+
							'<i class="fas fa-forward" style="color: black; font-size: 40px;"></i>	'	+
							'</a>'+
						'</div>'
					);
				}
			}
		}
	}
};

// imagenes
// https://image.tmdb.org/t/p/w500/

//generos
// https://api.themoviedb.org/3/genre/movie/list?api_key=c1dece2ed8e7859a019d7ccb2d343be6&language=es-CO
