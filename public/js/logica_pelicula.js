$.ajax({
    url: "https://api.themoviedb.org/3/discover/movie?api_key=c1dece2ed8e7859a019d7ccb2d343be6&language=es-CO&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&year=2019",
    type: "GET",
    success: function(peliculas) {

        var send = {
            peliculas: peliculas.results,
        };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'pelicula',
            dataType: 'json',
            type: 'POST',
            data: send,
            success: function(data) {
                console.log(data);
            }
        });
    }
});