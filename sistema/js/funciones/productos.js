function load(page){
    var query=$("#q").val();
    var parametros = {"action":"ajax","page":page,'query':query};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'ajax/listar_productos.php',
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

    $('#dataRegister').on('show.bs.modal', function (event) {
      $('#imagenmuestra1').attr("src", '')
      $('#file-input').val('')
    })

    $('#dataUpdate').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')
      var codigo = button.data('codigo')
      var nombre = button.data('nombre')
      var categoria = button.data('categoria')
      var familia = button.data('familia')
      var ubicacion = button.data('ubicacion')
      var stock = button.data('stock')
      var precio = button.data('precio')
      var acuario = button.data('acuario')
      var destacado = button.data('destacado')
      var imagen = button.data('imagen')
      var img = button.data('img')
      
      var modal = $(this)
      modal.find('.modal-title').text('Editar : '+nombre)
      modal.find('.modal-body #id').val(id)
      modal.find('.modal-body #codigo').val(codigo)
      modal.find('.modal-body #nombre').val(nombre)
      modal.find('select[id=categoria]').val(categoria)
      modal.find('select[id=familia]').val(familia)
      modal.find('select[id=ubicacion]').val(ubicacion)
      modal.find('.modal-body #stock').val(stock)
      modal.find('.modal-body #precio').val(precio)
      modal.find('.modal-body #acuario').val(acuario)
      modal.find('.modal-body #img').attr("src", imagen)
      modal.find('.modal-body #img').val(img)
      modal.find('.modal-body #img-edit').val('')

      if(destacado == 0)
      {
        modal.find('.modal-body #inlineCheckbox11').prop("checked", true);
      }
      else
      {
        modal.find('.modal-body #inlineCheckbox22').prop("checked", true);
      }

      $('.selectpicker').selectpicker('refresh');
      $('.alert').hide();//Oculto alert
    })

    $('#Imagen').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var imagen = button.data('imagen')
      var nombre = button.data('nombre')
      var precio = button.data('precio')
      var categoria = button.data('categoria')
      var detalle = button.data('detalle')
      var titulo = button.data('titulo')
      var descripcion = button.data('descripcion')

      var modal = $(this)
      modal.find('.modal-body #imagen').attr("src", imagen)
      modal.find('.modal-body #nombre').text(nombre)
      modal.find('.modal-body #precio').text(precio)
      modal.find('.modal-body #categoria').text(categoria)
      modal.find('.modal-body #detalle_prev').html(detalle)
      modal.find('.modal-body #titulo').text(titulo)
      modal.find('.modal-body #descripcion').html(descripcion)
    })
    
    $('#dataDelete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')
      var nombre = button.data('nombre') 

      var modal = $(this)
      modal.find('.modal-body #id').val(id)
      modal.find('.modal-body #nombre').text(nombre)
    })

    $('#dataDetalle').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')
      var detalle = button.data('detalle')
      var titulo = button.data('titulo')
      var descripcion = button.data('descripcion')

      var modal = $(this)
      modal.find('.modal-body #id').val(id)
      tinyMCE.get('detalle').setContent(detalle);
      modal.find('.modal-body #titulo').val(titulo)
      tinyMCE.get('descripcion').setContent(descripcion);
    })

    $( "#actualidarDatos" ).submit(function( event ) {
      event.preventDefault();
      var form = $('#actualidarDatos')[0];
      var data = new FormData(form);

      $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "php/acciones/update/update_producto.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function (objeto) {
          $(".datos_ajax").html("Mensaje: Cargando...");
        },
        success: function (data) {
          $(".datos_ajax_delete").show();
          $(".datos_ajax_delete").html(data);
          setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
          $('#dataUpdate').modal('hide');
          $('#file-input').val('');
          load();
          consulta_cuadros(1);
        }
      });
        event.preventDefault();
    });
    
    $( "#guardarDatos" ).submit(function( event ) {
      event.preventDefault();
      var form = $('#guardarDatos')[0];
      var data = new FormData(form);

      $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "php/acciones/add/add_producto.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function (objeto) {
          $(".datos_ajax_register").html("Mensaje: Cargando...");
        },
        success: function (data) {
          $(".datos_ajax_delete").show();
          $(".datos_ajax_delete").html(data);
          setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
          $('#dataRegister').modal('hide');

          $('#codigo0').val('')
          $('#nombre0').val('')
          $('#stock0').val('')
          $('#precio0').val('')
          $('#acuario0').val(0)
          $('#imagenmuestra1').attr("src", '')

          load();
          consulta_cuadros(1);
        }
      });
      
      event.preventDefault();
    });

    $( "#guardarDetalle" ).submit(function( event ) {
      tinyMCE.triggerSave();
      event.preventDefault();
      var form = $('#guardarDetalle')[0];
      var data = new FormData(form);

      $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "php/acciones/add/add_detalle_producto.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function (objeto) {
          $(".datos_ajax_register").html("Mensaje: Cargando...");
        },
        success: function (data) {
          $(".datos_ajax_delete").show();
          $(".datos_ajax_delete").html(data);
          setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 3000);
          $('#dataDetalle').modal('hide');

          $('#detalle').val('')
          $('#titulo').val('')
          $('#descripcion').val('')

          load();
          consulta_cuadros(1);
        }
      });
      
      event.preventDefault();
    });
    
    $( "#eliminarDatos" ).submit(function( event ) {
    var parametros = $(this).serialize();
         $.ajax({
                type: "POST",
                url: "php/acciones/delete/delete_producto.php",
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
                  consulta_cuadros(1);
              }
        });
      event.preventDefault();
    });

    function consulta_cuadros(page) {
      var parametros = { "action": "ajax", "page": page };
      $.ajax({
          url: 'ajax/cuadros_productos.php',
          data: parametros,
          dataType: "json",
          success: function (data) {
              $(".pro-stock").html(data[0]);
              $(".pro-total").html(data[1]);
              
          }
      })
  }

  