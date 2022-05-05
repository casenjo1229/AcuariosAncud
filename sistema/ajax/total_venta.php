<?php
    session_start();
	require_once("../php/conexion.php");

    $venta = $_SESSION['n_venta'];
    $consulta = "call consulta_total($venta)";
	$resultado1 = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna1 = mysqli_fetch_array( $resultado1 ))
	{ 
        echo number_format($columna1['total'], 0, ",", ".");
    }

?>

		  