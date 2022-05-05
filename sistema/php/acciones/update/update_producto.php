<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");
    $target_path = "../../../img/productos/";

    if (!file_exists($target_path)) {
        mkdir($target_path, 0777, true);
    }

    $consulta = "SELECT * FROM productos where id_producto=$_POST[id]";
	$resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $imagen = "img/productos/".$_FILES['imagen']['name'];
        if(empty($_FILES['imagen']['name']))
        {
            $query="UPDATE productos SET codigo='$_POST[codigo]',id_categoria=$_POST[categoria],id_familia=$_POST[familia],id_ubicacion=$_POST[ubicacion],nombre='$_POST[nombre]',stock=$_POST[stock],precio=$_POST[precio],num_acuario=$_POST[acuario],destacado=$_POST[radio1],fec_edicion='$fecha', id_usuario_edicion=$id_usuario where id_producto=$_POST[id]";
            if (conectar()->query($query) === TRUE) 
            {
                $messages[] = "Producto editado satisfactoriamente.";
            }

            else
            {
                $errors []= "1".mysqli_error(conectar());
            }
        }
        else
        {
            if($columna['imagen'] == $imagen)
            {
                $query="UPDATE productos SET codigo='$_POST[codigo]',id_categoria=$_POST[categoria],id_familia=$_POST[familia],id_ubicacion=$_POST[ubicacion],nombre='$_POST[nombre]',stock=$_POST[stock],precio=$_POST[precio],num_acuario=$_POST[acuario],destacado=$_POST[radio1],fec_edicion='$fecha', id_usuario_edicion=$id_usuario where id_producto=$_POST[id]";
                if (conectar()->query($query) === TRUE) 
                {
                    $messages[] = "Equipo editado satisfactoriamente.";
                }

                else
                {
                    $errors []= "2".mysqli_error(conectar());
                }
            }
            else
            {
                $target = $target_path . basename( $_FILES['imagen']['name']);
                if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target))
                {
                    $query="UPDATE productos SET codigo='$_POST[codigo]',id_categoria=$_POST[categoria],id_familia=$_POST[familia],id_ubicacion=$_POST[ubicacion],nombre='$_POST[nombre]',stock=$_POST[stock],precio=$_POST[precio],num_acuario=$_POST[acuario],destacado=$_POST[radio1],fec_edicion='$fecha', id_usuario_edicion=$id_usuario, imagen='img/productos/".$_FILES['imagen']['name']."' where id_producto=$_POST[id]";
                    if (conectar()->query($query) === TRUE) 
                    {
                        $messages[] = "Producto editado satisfactoriamente.";
                    }

                    else
                    {
                        $errors []= "3".mysqli_error(conectar());
                    }
                }
            }
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