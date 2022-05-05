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

	$target_path = "../../img/categorias/".$_POST['categoria_nombre']."/";
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

		    $query="UPDATE productos set nombre='$_POST[nombre]', precio='$_POST[precio]', id_categoria ='$_POST[categoria]', detalle='$_POST[detalle]',
		    imagen='img/categorias/".$_POST['categoria_nombre']."/".$_FILES['imagen']['name']."',titulo='$_POST[titulo]', descripcion='$_POST[descripcion]',codigo='$_POST[codigo]', destacado='$_POST[destacado]', nombre_cientifico='$_POST[cientifico]' where id_producto=$_POST[id]";
			if ($conexion->query($query) === TRUE) 
			{
				header('Location: ../productos.php');
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
			$query="UPDATE productos set nombre='$_POST[nombre]', precio='$_POST[precio]', id_categoria ='$_POST[categoria]', detalle='$_POST[detalle]',titulo='$_POST[titulo]', descripcion='$_POST[descripcion]',codigo='$_POST[codigo]',destacado='$_POST[destacado]', nombre_cientifico='$_POST[cientifico]' where id_producto=$_POST[id]";
			if ($conexion->query($query) === TRUE) 
			{
				header('Location: ../productos.php');
			}
		}
		else
		{
			$query="UPDATE productos set nombre='$_POST[nombre]', precio='$_POST[precio]', id_categoria ='$_POST[categoria]', detalle='$_POST[detalle]',imagen='img/categorias/".$_POST['categoria_nombre']."/".$_FILES['imagen']['name']."',titulo='$_POST[titulo]', descripcion='$_POST[descripcion]',codigo='$_POST[codigo]',destacado='$_POST[destacado]', nombre_cientifico='$_POST[cientifico]' where id_producto=$_POST[id]";
			if ($conexion->query($query) === TRUE) 
			{
				header('Location: ../productos.php');
			}
		}
	}

	
?>