<?php
    session_start();
	require_once("../php/conexion.php");

    $cliente = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['cliente'], ENT_QUOTES)));
    
    $_SESSION["cliente"] = $cliente;
    $consulta = "call consulta_cliente($cliente)";
	$resultado1 = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna1 = mysqli_fetch_array( $resultado1 ))
	{ 
        echo $columna1['descuento'];
    }

?>