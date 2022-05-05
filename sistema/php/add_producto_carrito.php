<?php session_start(); ?>
<?php 
	// include("../../add_cart.php");
	// $usuario = "cristian";
	// $password = "betroox1229";
	// $servidor = "localhost";
	// $basededatos = "acuariosancud";

	$usuario = "ancud";
	$password = "(.(_+OT6fE5]";
	$servidor = "localhost";
	$basededatos = "acuariosancud";

	$id= $_GET['id'];
	$enlace =$_GET['en'];
	$ip= get_real_ip();
	$fecha = date("Y-m-d");
	$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
	$acentos = $conexion->query("SET NAMES 'utf8'");
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );

	$consulta = "SELECT count(*) as total FROM carrito";
    $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    while ($columna = mysqli_fetch_array( $resultado ))
    { 
        $contador = $columna['total'] + 1;
        $query="INSERT carrito (id_cotizacion,id_producto,cantidad,id_estado,ip,fecha) values('$contador','$id','1','1','$ip','$fecha')";
        if ($conexion->query($query) === TRUE) 
        {
            header('Location:../../'.$enlace);
        }

        else{}
       
    }
	
?>