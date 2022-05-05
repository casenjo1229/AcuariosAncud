<?php
    session_start();
	require_once("../php/conexion.php");

    $consulta = "SELECT max(id_venta) as correlativo FROM venta";
	$resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }

    echo $contador;
    $_SESSION['n_venta'] = $contador;
?>

		  