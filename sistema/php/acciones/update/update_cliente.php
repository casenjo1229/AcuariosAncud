<?php
    session_start();
    include ('../../conexion.php');

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d G:i:s");
    
    $query="UPDATE clientes SET nombre='$_POST[nombre]', rut='$_POST[rut]', correo='$_POST[email]',ciudad='$_POST[ciudad]', direccion ='$_POST[direccion]', telefono='$_POST[telefono]', id_tipo_acuario=$_POST[tipo], descuento=$_POST[descuento], fec_ingreso='$_POST[fec_ingreso]', fec_edicion='$fecha',id_usuario_edicion=$id_usuario where id_cliente=$_POST[id]";
    if (conectar()->query($query) === TRUE) 
    {
        $messages[] = "El cliente ha sido editado satisfactoriamente.";
    }

    else
    {
        $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
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