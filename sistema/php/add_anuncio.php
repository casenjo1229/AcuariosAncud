<?php include('../../config.php'); ?>
<?php

	// $usuario = "cristian";
	// $password = "betroox1229";
	// $servidor = "localhost";
	// $basededatos = "acuariosancud";

	$usuario = "ancud";
	$password = "(.(_+OT6fE5]";
	$servidor = "localhost";
	$basededatos = "acuariosancud";

	date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");
	$user = $_SESSION["id_user"];

	$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
	$consulta = "SELECT count(*) as total FROM anuncios order by id_anuncio asc";
	$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	while ($columna = mysqli_fetch_array( $resultado ))
	{ 
		$contador = $columna['total'] + 1;
	}

	$target_path = "../../img/anuncios/".$contador."/";
	if (!file_exists($target_path)) {
	    mkdir($target_path, 0777, true);
	}

	$target = $target_path . basename( $_FILES['imagen']['name']);

	if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target))
	{
			$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
			$acentos = $conexion->query("SET NAMES 'utf8'");
			$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );

			$query="INSERT into anuncios (id_anuncio,titulo,descripcion,imagen,id_usuario,fecha) values($contador,'$_POST[titulo]','$_POST[descripcion]','img/anuncios/".$contador."/".$_FILES['imagen']['name']."','$user','$fecha')";

			if ($conexion->query($query) === TRUE) 
			{
				header('Location: ../anuncios.php');
			}

			else{}
	} 

	
?>