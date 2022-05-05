function load(page) {
    var parametros = { "action": "ajax", "page": page };
    $("#loader").fadeIn('slow');
    $.ajax({
        url: 'ajax/listar_temporal.php',
        data: parametros,
        success: function (data) {
            $(".datos_ajax_delete").html(data);
        }
    })
}

function buscar(page) {
    var query=$("#q").val();
    var parametros = {"action":"ajax","page":page,'query':query};
    $.ajax({
        url: 'ajax/listar_productos_buscar.php',
        data: parametros,
        success: function (data) {
            $(".datos_productos").html(data);
        }
    })
}

function venta(page) {
    var parametros = { "action": "ajax", "page": page };
    $.ajax({
        url: 'ajax/numero_venta.php',
        data: parametros,
        success: function (data) {
            $(".venta").html(data);
        }
    })
}

function total(page) {
    var parametros = { "action": "ajax", "page": page };
    $.ajax({
        url: 'ajax/total_venta.php',
        data: parametros,
        success: function (data) {
            $(".total").html(data);
        }
    })
}

$('#dataDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botón que activó el modal
    var id = button.data('id') // Extraer la información de atributos de datos
    var nombre = button.data('nombre') // Extraer la información de atributos de datos

    var modal = $(this)
    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #nombre').text(nombre)
})

$('#exampleModal1').on('shown.bs.modal', function() {
    $('#q').focus();
})

$('#exampleModal').on('shown.bs.modal', function() {
    var desc = $('#desc').val();
    var sub = $('#subtotal').val();
    $("#por").prop("checked", true);
    $('#descuento').val(desc);
    $('#abono').val('');
    $('#tipo_pago').val(1);
    $('#paga').attr('readonly', false);
    $('#ab').addClass("d-none");
    if(desc == 0)
    {
        $('#total').val(sub);    
    }
    else{
        var t = ($('#subtotal').val() * desc) / 100;
        var t1 =  $('#subtotal').val() - t;
        $('#total').val(t1);
    }
})

$("#pagar").submit(function (event) {
    event.preventDefault();
    var form = $('#pagar')[0];
    var data = new FormData(form);
    $.ajax({
        type: "POST",
        url: "ajax/total_pagar.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $('#subtotal').val(data);
            $('#total').val();
            $('#totalhidden').val(data);
            $('#descuento').val('');
            $('#paga').val('');
            $('#vuelto').val('');
        }
    });
    event.preventDefault();
});

$("#LimpiarVenta").submit(function (event) {
    event.preventDefault();
    var form = $('#LimpiarVenta')[0];
    var data = new FormData(form);
    $.ajax({
        type: "POST",
        url: "php/acciones/delete/delete_temporal.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            load(1);
            total(1);
            $('#Limpiar').modal('hide');
        }
    });
    event.preventDefault();
});


$("#BuscarCodigo").submit(function (event) {
    event.preventDefault();
    var form = $('#BuscarCodigo')[0];
    var data = new FormData(form);

    $.ajax({
        type: "POST",
        url: "php/acciones/search/codigo_producto.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $(".error").show();
            $(".error").html(data);
            setTimeout(function() { $('.error').fadeOut('fast'); }, 4000);
            load(1);
            total(1);
            $('#codigo').val('');
            $('#codigo').focus();
        }
    });
    event.preventDefault();
});

$("#eliminarDatos").submit(function (event) {
    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "php/acciones/delete/delete_producto_temporal.php",
        data: parametros,
        success: function (datos) {
            $('#dataDelete').modal('hide');
            load(1);
            total(1);
        }
    });
    event.preventDefault();
});

$("#guardarVenta").submit(function (event) {
    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "php/acciones/add/add_venta.php",
        data: parametros,
        success: function (datos) {
            $('#exampleModal').modal('hide');
            if(datos=='1'){
                window.open('php/acciones/search/reporte_venta.php', '_blank');
                load(1);
                venta(1);
                total(1);
            }else
            {
                $(".resultado").html(datos);
            }
        }
    });
    event.preventDefault();
});


