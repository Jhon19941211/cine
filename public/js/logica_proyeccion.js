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

    var button = $(event.relatedTarget)

    var fecha = button.data('fecha')
    var pelicula = button.data('pelicula')
    var sala = button.data('sala');
    var hora = button.data('hora');
    var id = button.data('id');
    console.log(id);

    //operacion para hora
    var res = hora.split(":");
    var aux = (res[0] - 12) < 10 ? "0" + (res[0] - 12) + ':00 PM' : (res[0] - 12) + ':00 PM';
    console.log(aux);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#sala").empty();
    $("#pelicula").empty();
    $("#hora").empty();

    $.ajax({
        type: "POST",
        url: 'proyeccion/listarSalas',
        success: function(data) {

            data.forEach(function(registro, index) {
                if (registro.id == sala) {
                    $("#sala").append('<option selected=true value=' + registro.id + '>' + registro.id + '</option>');
                } else {
                    $("#sala").append('<option  value=' + registro.id + '>' + registro.id + '</option>');

                }
            });
        }
    });
    $.ajax({
        type: "POST",
        url: 'proyeccion/listar',
        success: function(data) {
            data.forEach(function(registro, index) {
                if (registro.nombre == pelicula) {
                    $("#pelicula").append('<option selected=true value=' + registro.id + '>' + registro.nombre + '</option>');
                } else {
                    $("#pelicula").append('<option  value=' + registro.id + '>' + registro.nombre + '</option>');

                }
            });
        }
    });

    var horas = ['06:00 PM', '08:00 PM', '10:00 PM'];

    for (let i = 0; i < horas.length; i++) {

        if (horas[i] == aux) {
            $("#hora").append('<option selected=true >' + aux + '</option>');
        } else {
            $("#hora").append('<option  >' + horas[i] + '</option>');
        }

    }
    var modal = $(this)
    modal.find('.modal-body #fecha').val(fecha);
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
            hora: jQuery('#hora').val(),
            pelicula: jQuery('#pelicula').val(),
            fecha: jQuery('#fecha').val(),
            sala: jQuery('#sala').val(),
            id: jQuery('#id').val(),
        },
        success: function(result) {
            if (result.errors) {
                jQuery('.alert-danger').html('');

                jQuery.each(result.errors, function(key, value) {
                    jQuery('.alert-danger').show();
                    jQuery('.alert-danger').append('<li>' + value + '</li>');
                });
            } else {
                jQuery('.alert-danger').hide();
                $('#open').hide();
                $('#edit').modal('hide');
                table_horario.ajax.reload();


            }
        }
    });


});