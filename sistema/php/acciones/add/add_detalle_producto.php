<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");
    
    $consulta = "SELECT * FROM detalle_producto where id_producto=$_POST[id]";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $query="UPDATE detalle_producto set detalle='$_POST[detalle]',titulo='$_POST[titulo]',descripcion='$_POST[descripcion]',fec_edicion='$fecha',id_usuario_edicion=$id_usuario where id_producto = $_POST[id]";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "El detalle del producto se actualizo satisfactoriamente.";
        }

        else
        {
            $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
        }
    }
    else
    {
        $consulta = "SELECT max(id_registro) as correlativo FROM detalle_producto";
        $resultado = mysqli_query( conectar(), $consulta );
        if ($columna = mysqli_fetch_array( $resultado ))
        { 
            $contador = $columna['correlativo'] + 1;
        }
        else
        {
            $contador = 1;
        }
        
        $query="INSERT INTO detalle_producto (id_registro,id_producto,detalle,titulo,descripcion,fec_registro,id_usuario_registro) values($contador,$_POST[id],'$_POST[detalle]','$_POST[titulo]','$_POST[descripcion]','$fecha',$id_usuario)";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "El detalle del producto se guardo satisfactoriamente.";
        }

        else
        {
            $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
        }
    }


    
    

    if (isset($errors)){
			
    ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> 
                <?php
                    foreach ($errors as $error) {
                            echo $error;
                        }
                    ?>
        </div>
        <?php
        }
        if (isset($messages)){
            
            ?>
            <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong>
                    <?php
                        foreach ($messages as $message) {
                                echo $message;
                            }
                        ?>
            </div>
            <?php
        }
?>