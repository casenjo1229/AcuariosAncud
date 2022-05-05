function load(page){
    var fecha=$("#fec").val();
    var parametros = {"action":"ajax","page":page,"fecha":fecha};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'ajax/listar_gastos.php',
        data: parametros,
         beforeSend: function(objeto){
        $("#loader").html("<img src='img/loader.gif'>");
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $("#loader").html("");
        }
    })
}

$( "#guardarDatos" ).submit(function( event ) {
    event.preventDefault();
    var form = $('#guardarDatos')[0];
    var data = new FormData(form);

    $.ajax({
      type: "POST",
      url: "php/acciones/add/add_gasto.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      beforeSend: function (objeto) {
        $(".datos_ajax_delete").html("Mensaje: Cargando...");
      },
      success: function (data) {
        $(".datos_ajax_delete").show();
        $(".datos_ajax_delete").html(data);
        setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
        $('#descripcion0').val('')
        $('#total0').val('')
        $('#dataRegister').modal('hide');

        load(1);
      }
    });
      
    event.preventDefault();
});

$('#dataDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botón que activó el modal
    var id = button.data('id') // Extraer la información de atributos de datos
    var descripcion = button.data('descripcion') // Extraer la información de atributos de datos

    var modal = $(this)
    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #descripcion').text(descripcion)
})

$( "#eliminarDatos" ).submit(function( event ) {
    var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "php/acciones/delete/delete_gasto.php",
            data: parametros,
            beforeSend: function(objeto){
                $(".datos_ajax_delete").html("Mensaje: Cargando...");
            },
            success: function(datos){
                $(".datos_ajax_delete").show();
                $(".datos_ajax_delete").html(datos);
                setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
                $('#dataDelete').modal('hide');
                load(1);
            }
        });
    event.preventDefault();
});