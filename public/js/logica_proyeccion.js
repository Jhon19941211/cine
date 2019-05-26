var table_horario = $('#table_horarios').DataTable({
    language: {
        "emptyTable": "No hay datos disponibles en la tabla.",
        "info": "Del _START_ al _END_ de _TOTAL_ ",
        "infoEmpty": "Mostrando 0 registros de un total de 0.",
        "infoFiltered": "(filtrados de un total de _MAX_ registros)",
        "infoPostFix": "(actualizados)",
        "lengthMenu": "Mostrar _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "searchPlaceholder": "Dato para buscar",
        "zeroRecords": "No se han encontrado coincidencias.",
        "paginate": {
            "first": "Primera",
            "last": "Última",
            "next": "Siguiente",
            "previous": "Anterior"
        },
    },
    processing: true,
    serverSide: true,
    ajax: {
        url: 'listar',
        type: "GET"
    },
    columns: [
        { data: 'id' },
        { data: 'fecha_hora.fecha' },
        { data: 'fecha_hora.hora' },
        { data: 'pelicula.nombre' },
        { data: 'sala_id' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});

function btn_eliminar_proyeccion($id) {
    var id = $id;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: 'proyeccion/' + id,
        success: function(data) {
            table_horario.ajax.reload();
            console.log(data);
        }
    });
}


$('#edit').on('show.bs.modal', function(event) {

    $(".alert-danger").empty();
    jQuery('.alert-danger').hide();
    var button = $(event.relatedTarget)

    var fechaoriginal = button.data('fecha')
    var peliculaoriginal = button.data('pelicula')
    var salaoriginal = button.data('sala');
    var hora = button.data('hora');
    var id = button.data('id');


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#salaeditar").empty();
    $("#peliculaeditar").empty();
    $("#horaeditar").empty();

    $.ajax({
        type: "POST",
        url: 'proyeccion/listarSalas',
        success: function(data) {

            data.forEach(function(registro, index) {
                if (registro.id == salaoriginal) {
                    $("#salaeditar").append('<option selected=true value=' + registro.id + '>' + registro.id + '</option>');
                } else {
                    $("#salaeditar").append('<option  value=' + registro.id + '>' + registro.id + '</option>');

                }
            });
        }
    });
    $.ajax({
        type: "POST",
        url: 'proyeccion/listar',
        success: function(data) {
            data.forEach(function(registro, index) {
                if (registro.id == peliculaoriginal) {
                    $("#peliculaeditar").append('<option selected=true value=' + registro.id + '>' + registro.nombre + '</option>');
                } else {
                    $("#peliculaeditar").append('<option  value=' + registro.id + '>' + registro.nombre + '</option>');

                }
            });
        }
    });
    var aux = hora;
    peticionSelecteditar(salaoriginal, peliculaoriginal, fechaoriginal, aux);


    $("#salaeditar").change(function() {
        var sala = $(this).val();
        var fecha = jQuery('#fechaeditar').val();
        var pelicula = jQuery('#peliculaeditar').val();
        $("#horaeditar").empty();
        aux = "";
        if (sala == salaoriginal && fecha == fechaoriginal && pelicula == peliculaoriginal) {

            sala = salaoriginal;
            fecha = fechaoriginal;
            pelicula = peliculaoriginal;
            aux = hora;

        }
        peticionSelecteditar(sala, pelicula, fecha, aux);
    });

    $("#peliculaeditar").change(function() {

        $("#horaeditar").empty();
        aux = "";
        var pelicula = $(this).val();
        var sala = jQuery('#salaeditar').val();
        var fecha = jQuery('#fechaeditar').val();
        if (sala == salaoriginal && fecha == fechaoriginal && pelicula == peliculaoriginal) {
            sala = salaoriginal;
            fecha = fechaoriginal;
            pelicula = peliculaoriginal;
            aux = hora;

        }
        peticionSelecteditar(sala, pelicula, fecha, aux);
    });

    $("#fechaeditar").change(function() {

        $("#horaeditar").empty();
        var fecha = $(this).val();
        var sala = jQuery('#salaeditar').val();
        var pelicula = jQuery('#peliculaeditar').val();
        aux = "";

        if (sala == salaoriginal && fecha == fechaoriginal && pelicula == peliculaoriginal) {

            sala = salaoriginal;
            fecha = fechaoriginal;
            pelicula = peliculaoriginal;
            aux = hora;

        }
        peticionSelecteditar(sala, pelicula, fecha, aux);
    });
    var modal = $(this)
    modal.find('.modal-body #fechaeditar').val(fechaoriginal);
    modal.find('.modal-body #id').val(id);
    console.log(id)

});

$('#ajaxSubmit').click(function(e) {

    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });


    $.ajax({
        url: 'proyeccion/actualizar',
        method: 'POST',
        data: {
            hora: jQuery('#horaeditar').val(),
            pelicula: jQuery('#peliculaeditar').val(),
            fecha: jQuery('#fechaeditar').val(),
            sala: jQuery('#salaeditar').val(),
            id: jQuery('#id').val(),
        },
        success: function(result) {

            console.log(result);
            if (result.errors) {
                $(".alert-danger").empty();
                jQuery('.alert-danger').show();
                jQuery('.alert-danger').append('<h6> La fecha debe ser igual o mayor a la actual </h6>');

            } else {
                jQuery('.alert-danger').hide();
                $('#open').hide();
                $('#edit').modal('hide');
                table_horario.ajax.reload();


            }
        }
    });


});


$("#sala").change(function() {
    var sala = $(this).val();
    var fecha = jQuery('#fecha').val();
    var pelicula = jQuery('#pelicula').val();
    peticionSelect(sala, pelicula, fecha);
});

$("#pelicula").change(function() {

    var pelicula = $(this).val();
    var sala = jQuery('#sala').val();
    var fecha = jQuery('#fecha').val();
    peticionSelect(sala, pelicula, fecha);
});

$("#fecha").change(function() {

    var fecha = $(this).val();
    var sala = jQuery('#sala').val();
    var pelicula = jQuery('#pelicula').val();

    peticionSelect(sala, pelicula, fecha);

});

function peticionSelect(sala, pelicula, fecha) {

    if (sala != "Seleccione" && fecha != "" && pelicula != "Seleccione") {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: 'proyeccion/disponibles/' + sala + '/' + pelicula + '/' + fecha,
            success: function(result) {
                $("#hora").empty();
                horas = ['18:00:00', '20:00:00', '22:00:00'];
                if (result.length > 0) {
                    result.forEach(function(elemento) {
                        var index = horas.indexOf(elemento.hora);
                        if (index > -1) {
                            horas.splice(index, 1);
                        }
                    });


                }
                $("#hora").append('<option selected=true >' + 'Seleccione' + '</option>');
                for (let i = 0; i < horas.length; i++) {
                    $("#hora").append('<option  >' + horas[i] + '</option>');

                }
            },
            error: function(error) {
                console.log(error);
            }

        });
    }
}


function peticionSelecteditar(sala, pelicula, fecha, aux) {

    if (sala != "Seleccione" && fecha != "" && pelicula != "Seleccione") {


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: 'proyeccion/disponibles/' + sala + '/' + pelicula + '/' + fecha,
            success: function(result) {

                horas = ['18:00:00', '20:00:00', '22:00:00'];
                if (result.length > 0) {
                    result.forEach(function(elemento) {
                        var index = horas.indexOf(elemento.hora);
                        if (index > -1) {
                            horas.splice(index, 1);
                        }
                    });

                }
                hora = aux;
                $("#horaeditar").empty();
                if (aux) {
                    $("#horaeditar").append('<option selected=true>' + aux + '</option>');
                    console.log(aux);
                }
                for (let i = 0; i < horas.length; i++) {
                    $("#horaeditar").append('<option  >' + horas[i] + '</option>');

                }
            },
            error: function(error) {
                console.log(error);
            }

        });
    }
}