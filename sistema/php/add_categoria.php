<?php session_start(); ?>
<?php 
	// $usuario = "cristian";
	// $password = "betroox1229";
	// $servidor = "localhost";
	// $basededatos = "acuariosancud";

	$usuario = "ancud";
	$password = "(.(_+OT6fE5]";
	$servidor = "localhost";
	$basededatos = "acuariosancud";

	$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
	
	$query="INSERT categorias (nombre) values('$_POST[nombre]')";
	if ($conexion->query($query) === TRUE) 
	{
		header('Location: ../categorias.php');
	}

	else{}
	
?>