<?php
    require_once("../php/conexion.php");

    $consulta = "call consulta_producto_venta()";
    $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	while ($columna = mysqli_fetch_array( $resultado ))
	{
        $total = $columna['precio_venta'] * $columna['cantidad'];
		echo    "<tr>
                    <th scope='row'>".$columna['codigo']."</th>
                    <td>".$columna['nombre']."</td>
                    <td>".$columna['stock']."</td>
                    <td>$".number_format($columna['precio_venta'], 0, ",", ".")."</td>
                    <td>
                        <form id='UpdateCantidad".$columna['id_registro']."' class='d-flex'>
                            <input type='number' value='".$columna['cantidad']."' class='form-control w-50' name='cantidad' min='1' max='".$columna['stock']."'/>
                            <input type='hidden' value='".$columna['id_registro']."' name='id'/>
                            <button type='submit' class='btn btn-primary ml-1'><i class='fas fa-redo'></i></button>
                        </form>
                    </td>
                    <td>$".number_format($total, 0, ",", ".")."</td>
                    <td class='d-flex align-items-center justify-content-center'>
                        <button class='btn btn-primary badge-pill' data-toggle='modal' data-target='#dataDelete' data-id='".$columna['id_registro']."' data-nombre='".$columna['nombre']."'><img src='img/iconos/cruz.png' alt='' class='btn-accion align-self-center' style='width:17px;'></button>
                    </td>
                </tr>";

        echo    "<script>$('#UpdateCantidad".$columna['id_registro']."').submit(function (event) {
                    event.preventDefault();
                    var form = $('#UpdateCantidad".$columna['id_registro']."')[0];
                    var data = new FormData(form);

                    $.ajax({
                        type: 'POST',
                        url: 'php/acciones/update/update_cantidad.php',
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function (data) {
                            load(1);    
                            total(1);
                        }
                    });
                    event.preventDefault();
                            });
                </script>";
    }
    
    
?>