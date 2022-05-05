<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");

    $target_path = "../../../img/equipos/";

    if (!file_exists($target_path)) {
        mkdir($target_path, 0777, true);
    }

    $target = $target_path . basename( $_FILES['imagen']['name']);

    $consulta = "SELECT max(id_producto) as correlativo FROM productos";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }
    
    
    if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target))
    {
        $query="INSERT INTO productos (id_producto,codigo,nombre,id_categoria,id_familia,id_ubicacion,imagen,stock,precio,num_acuario,destacado,fec_registro,id_usuario_registro) values($contador,'$_POST[codigo0]','$_POST[nombre0]',$_POST[categoria0],$_POST[familia0],$_POST[ubicacion0],'img/equipos/".$_FILES['imagen']['name']."',$_POST[stock0],$_POST[precio0],$_POST[acuario0],$_POST[radio],'$fecha',$id_usuario)";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "El producto se guardo satisfactoriamente.";
        }

        else
        {
            $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
        }
    }

    else
    {
        $query="INSERT INTO productos (id_producto,codigo,nombre,id_categoria,id_familia,id_ubicacion,stock,precio,num_acuario,destacado,fec_registro,id_usuario_registro) values($contador,'$_POST[codigo0]','$_POST[nombre0]',$_POST[categoria0],$_POST[familia0],$_POST[ubicacion0],$_POST[stock0],$_POST[precio0],$_POST[acuario0],$_POST[radio],'$fecha',$id_usuario)";
        if (conectar()->query($query) === TRUE) 
        {
            $messages[] = "El equipo se guardo satisfactoriamente.";
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