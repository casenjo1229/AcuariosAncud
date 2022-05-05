function load(page){
    var desde=$("#desde").val();
    var hasta=$("#hasta").val();
    var parametros = {"action":"ajax","page":page,'desde':desde,'hasta':hasta};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'ajax/listar_ventas.php',
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

$('#resumen').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botón que activó el modal
    var id = button.data('id')
    var fecha = button.data('fecha')
    var subtotal = button.data('subtotal')
    var descuento = button.data('descuento')
    var total = button.data('total')
    // Extraer la información de atributos de datos

    var modal = $(this)
    modal.find('.modal-body #id').text(id)
    modal.find('.modal-body #fecha').text(fecha)
    modal.find('.modal-body #subtotal').text(subtotal)
    modal.find('.modal-body #descuento').text(descuento)
    modal.find('.modal-body #total').text(total)
    modal.find('.modal-body #id_venta').val(id)

    $.ajax({
        url:'ajax/listar_detalle_venta.php',
        data: {id: id},
        success:function(data){
            $(".test").html(data);
        }
    })

  })

$('#dataDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botón que activó el modal
    var id = button.data('id') // Extraer la información de atributos de datos

    var modal = $(this)
    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #nombre').text(id)
})

$("#eliminarDatos").submit(function (event) {
    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "php/acciones/delete/delete_venta.php",
        data: parametros,
        success: function (datos) {
            $(".datos_ajax_delete").show();
            $(".datos_ajax_delete").html(datos);
            setTimeout(function () { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
            $('#dataDelete').modal('hide');
            load(1);
        }
    });
    event.preventDefault();
});

$("#reimprimir").on('click', function() {
    var id = $('#id_venta').val();
    window.open('php/acciones/search/reporte_venta_reimprimir.php?id='+id, '_blank');
});