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
	$consulta = "SELECT id_producto FROM productos order by id_producto asc";
	$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	while ($columna = mysqli_fetch_array( $resultado ))
	{ 
		$contador = $columna['id_producto'] + 1;
	}

	$consulta = "SELECT * FROM categorias where id_categoria=$_POST[categoria]";
	$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	while ($columna = mysqli_fetch_array( $resultado ))
	{ 
		$nom_categoria = $columna['nombre'];
	}

	$target_path = "../../img/categorias/".$nom_categoria."/";
	if (!file_exists($target_path)) {
	    mkdir($target_path, 0777, true);
	}
	$target = $target_path . basename( $_FILES['imagen']['name']);
	if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target))
	{
			$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
			$acentos = $conexion->query("SET NAMES 'utf8'");
			$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );

			$query="INSERT into productos (id_producto,nombre,precio,id_categoria,detalle, titulo, descripcion, imagen, codigo, destacado, nombre_cientifico) values($contador,'$_POST[nombre]',$_POST[precio],$_POST[categoria],'$_POST[detalle]','$_POST[titulo]','$_POST[descripcion]','img/categorias/".$nom_categoria."/".$_FILES['imagen']['name']."','$_POST[codigo]','$_POST[destacado1]','$_POST[cientifico]')";

			if ($conexion->query($query) === TRUE) 
			{
				header('Location: ../productos.php');
			}
	} 

?>