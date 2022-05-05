<?php
    session_start();
    require_once("../php/conexion.php");

    $consulta = "call consulta_venta_detalle($_REQUEST[id])";
	$resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	while ($columna = mysqli_fetch_array( $resultado ))
	{ 
       echo "<tr>
                <td>".$columna['Producto']."</td>
                <td>".$columna['Cantidad']."</td>
                <td>$".number_format($columna['Precio'], 0, ",", ".")."</td>
            </tr>";
    }
?>