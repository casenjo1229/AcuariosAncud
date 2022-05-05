<?php 
    include('php/funciones.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('head.php');?>
</head>
<body>
    <?php include("modals/ventas/buscar.php");?>
    <?php include("modals/ventas/eliminar.php");?>
    <?php include("modals/ventas/pagar.php");?>
    <?php include('nav.php');?>

    <div class="container-fluid">
        <div class="error"></div>
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-sm-5 col-md-5 col-xl-3">
                <h1>Modulo Ventas</h1>
                <label class="mt-4" for="cliente">Cliente:</label>
                <select class="selectpicker form-control" data-live-search="true" name="cliente" id="cliente" onchange="descuento();">
                    <?php 
                        $consulta = "call consulta_cliente_todos()";
                        $resultado = mysqli_query(conectar(), $consulta );
                        while ($columna = mysqli_fetch_array( $resultado ))
                        { 
                            echo    "<option value='".$columna['id_cliente']."'>".$columna['nombre']."</option>";
                        }
                    ?>
                </select>
                <input type="hidden" id="desc" name="desc">
            </div>
            <div class="col-sm-5 col-md-5 col-xl-3">
                <div class="cliente d-flex justify-content-center align-items-center">
                    <p class="">Venta N°: <span class="venta"></span></p>
                </div> 
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 p-0 mt-5">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Precio unitario</th>
                                <th scope="col">cantidad</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody class="datos_ajax_delete">
                            
                        </tbody> 
                    </table> 
                </div> 
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-12 pl-0 d-flex">
                            <div class="col-4 pl-0">
                                <form id="BuscarCodigo">
                                    <input class="form-control" type="text" id="codigo" name="codigo" placeholder="Leer codigo de barra">
                                </form>
                            </div> 
                            <div class="col-4 pl-0">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1" id="buscar">Buscar producto</button>
                            </div>
                            <div class="col">
                                <p class="ml-5 mt-2" style="font-size: 2rem;">Total: $<span class="total"></span></p>
                            </div>
                        </div>     
                    </div>
                </div>   
                <div class="container-fluid">
                    <div class="row">
                        <form id="pagar">
                            <button type="submit" class="btn btn-primary agregar" data-toggle="modal" data-target="#exampleModal">
                            Pagar
                            </button>       
                        </form>
                        <button type="submit" class="btn btn-primary ml-5" data-toggle="modal" data-target="#Limpiar">
                            Limpiar
                            </button> 
                    </div>
                </div>    
            </div>     
        </div>
    </div>

    <form id="LimpiarVenta">
        <div class="modal fade" id="Limpiar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Esta acción eliminará de forma permanente el listado de productos de la venta</p>
                        <b id="nombre"></b>
                        <p>Deseas continuar?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php include('footer.php');?>
    <script src="js/funciones/ventas.js"></script>
    <script>
		$(document).ready(function(){
            venta(1);
            descuento();
		});
	</script>
    <script>
        $("#buscar").click( function()
        {
            buscar(1);
        }
        );
    </script>
    <script>
        $('#paga').on('input', function() {
            var total = $('#total').val();
            var paga = $('#paga').val();
            var vuelto = paga - total;
            $('#vuelto').val(vuelto);
        });
    </script>
    <script>
        $('#abono').on('input', function() {
            var total = $('#totalhidden').val();
            var abono = $('#abono').val();
            var to = total - abono;
            $('#total').val(to);
        });
    </script>
    <script>
        function miles(input)
        {
            var num = input.value.replace(/\./g,'');
            if(!isNaN(num)){
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1');
                num = num.split('').reverse().join('').replace(/^[\.]/,'');
                input.value = num;
            }
            else{ alert('Solo se permiten numeros');
                input.value = input.value.replace(/[^\d\.]*/g,'');
            }
        }
    </script>
    <script>
        function format(input)
        {
            var num = input.value.replace(/\./g,'');
            if(!isNaN(num)){
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1');
                num = num.split('').reverse().join('').replace(/^[\.]/,'');
                input.value = num;
                var rate_value = document.querySelector('input[name="tipo_descuento"]:checked').value;
                if(rate_value=="porcentaje")
                {
                    var descuento = $('#descuento').val();
                    var subtotal = $('#subtotal').val();
                    var resultado = Math.round((subtotal * descuento) / 100);
                    var total = subtotal - resultado;
                    $('#total').val(total);
                    $('#totalhidden').val(total);
                }
                else
                {
                    var descuento = $('#descuento').val();
                    var subtotal = $('#subtotal').val();
                    var total = parseInt(subtotal) - parseInt(descuento);
                    $('#total').val(parseInt(total));
                    $('#totalhidden').val(total);
                }
            }
            
            else{ alert('Solo se permiten numeros');
            input.value = input.value.replace(/[^\d\.]*/g,'');
            }
        }
    </script>
    <script>
        function val() {
            d = document.getElementById("tipo_pago").value;
            if(d == 1)
            {
                $('#paga').attr('readonly', false);
                $('#abono').val('');
                $('#ab').addClass("d-none");
            }
            else
            {
                $('#paga').attr('readonly', true);
                $('#abono').val('');
                $('#ab').removeClass("d-none");
            }
        }
    </script>
    <script>
        function descuento() {
            var cliente=$("#cliente").val();
            var parametros = { "action": "ajax", "cliente": cliente };
            $.ajax({
                url: 'ajax/descuento.php',
                data: parametros,
                success: function (data) {
                    $('#desc').val(data);
                }
            })
        }
    </script>
</body>
</html>


