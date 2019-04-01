
$.ajax({
	url: "https://api.themoviedb.org/3/discover/movie?api_key=c1dece2ed8e7859a019d7ccb2d343be6&language=es-CO&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&year=2018",
	type: "GET",
	success: function(data){
		console.log(data);

		var active = "active";
		$.each(data.results, function(i, item) {
		    console.log(item);

			$('#accion1').append(
				'<div class="carousel-item '+active+'">'+
					'<div class="container">'+
						'<div class="row justify-content-md-center">'	+								
							'<div class="card" style="width: 50%;">'+
								'<img src="https://image.tmdb.org/t/p/w500/'+item.backdrop_path+'" class="d-block w-100" alt="...">'+
								'<div class="card-body">'+
									'<h5 class="card-title">'+item.original_title+'</h5>'+
									'<p class="card-text">'+item.overview+'</p>'+
									'<a href="#" class="btn btn-primary">Reservar</a>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'
			);
			active="no";
		});
		active="active";
	},
	error: function(data){

	}
})	

// imagenes
// https://image.tmdb.org/t/p/w500/

//generos
// https://api.themoviedb.org/3/genre/movie/list?api_key=c1dece2ed8e7859a019d7ccb2d343be6&language=es-CO
