function load(page){
    var query=$("#q").val();
    var parametros = {"action":"ajax","page":page,'query':query};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'ajax/listar_clientes.php',
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

    $('#dataUpdate').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var nombre = button.data('nombre') 
        var rut = button.data('rut') 
        var correo = button.data('correo') 
        var ciudad = button.data('ciudad')
        var direccion = button.data('direccion')
        var telefono = button.data('telefono')
        var tipo = button.data('tipo')
        var descuento = button.data('descuento')
        var ingreso = button.data('ingreso')      

        var modal = $(this)
        modal.find('.modal-title').text('Editar : '+nombre)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #nombre').val(nombre)
        modal.find('.modal-body #rut').val(rut)
        modal.find('.modal-body #email').val(correo)
        modal.find('.modal-body #ciudad').val(ciudad)
        modal.find('.modal-body #direccion').val(direccion)
        modal.find('.modal-body #telefono').val(telefono)
        modal.find('.select[id=tipo]').val(tipo)
        modal.find('.modal-body #descuento').val(descuento)
        modal.find('.modal-body #fec_ingreso').val(ingreso)
        $('.selectpicker').selectpicker('refresh');
        $('.alert').hide();
    })
  
    $('#dataDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var id = button.data('id') 
        var nombre = button.data('nombre')

        var modal = $(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #nombre').text(nombre)
    })

    $( "#guardarDatos" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#guardarDatos')[0];
        var data = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "php/acciones/add/add_cliente.php",
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
            $('#nombre').val('')
            $('#email').val('')
            $('#rut').val('')
            $('#ciudad').val('')
            $('#direccion').val('')
            $('#telefono').val('')
            $('#descuento').val('')
            $('#fec_ingreso').val('')
            $('#tipo').val(1)
            $('#dataRegister').modal('hide');

            load();
          }
        });
          
        event.preventDefault();
    });

    $( "#actualidarDatos" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#actualidarDatos')[0];
        var data = new FormData(form);
  
        $.ajax({
          type: "POST",
          url: "php/acciones/update/update_cliente.php",
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
            $('#dataUpdate').modal('hide');
  
            load();
          }
        });
          event.preventDefault();
      });

    $( "#eliminarDatos" ).submit(function( event ) {
        var parametros = $(this).serialize();
             $.ajax({
                    type: "POST",
                    url: "php/acciones/delete/delete_cliente.php",
                    data: parametros,
                     beforeSend: function(objeto){
                        $(".datos_ajax_delete").html("Mensaje: Cargando...");
                      },
                    success: function(datos){
                      $(".datos_ajax_delete").show();
                      $(".datos_ajax_delete").html(datos);
                      setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
                      $('#dataDelete').modal('hide');
                      load();
                  }
            });
          event.preventDefault();
        });