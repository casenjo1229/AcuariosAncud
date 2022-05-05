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

	$target_path = "../../img/anuncios/".$_POST['id']."/";
	if (!file_exists($target_path)) {
	    mkdir($target_path, 0777, true);
	}

	$target = $target_path . basename( $_FILES['imagen']['name']);
	if (!file_exists($target)) 
	{
	    if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target))
	    {
			$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
			$acentos = $conexion->query("SET NAMES 'utf8'");
			$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );

		    $query="UPDATE anuncios set titulo='$_POST[titulo]', descripcion='$_POST[descripcion]',imagen='img/anuncios/".$_POST['id']."/".$_FILES['imagen']['name']."' where id_anuncio=$_POST[id]";
			if ($conexion->query($query) === TRUE) 
			{
				header('Location: ../anuncios.php');
			}

			else{}
		} 
	}
	
	else
	{
	    $conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
	    $acentos = $conexion->query("SET NAMES 'utf8'");
		$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
		if(empty($_FILES['imagen']['name']))
		{
			$query="UPDATE anuncios set titulo='$_POST[titulo]', descripcion='$_POST[descripcion]' where id_anuncio=$_POST[id]";
			if ($conexion->query($query) === TRUE) 
			{
				header('Location: ../anuncios.php');
			}

			else{}
		}
		else
		{
			$query="UPDATE anuncios set titulo='$_POST[titulo]', descripcion='$_POST[descripcion]', imagen='img/anuncios/".$_POST['id']."/".$_FILES['imagen']['name']."' where id_anuncio=$_POST[id]";
			if ($conexion->query($query) === TRUE) 
			{
				header('Location: ../anuncios.php');
			}

			else{}
		}
	}

?>