<?php
    session_start();
    require_once("../php/conexion.php");
    
    $email = $_POST['correo'];

    $buscarUsuario = "call consulta_login('$email')";
    $result = conectar()->query($buscarUsuario);
    if ($columna = mysqli_fetch_array( $result ))
    { 
        $d=mt_rand(1111,9999);
        $hash = password_hash($d, PASSWORD_DEFAULT);
    
        $para  = $_POST['correo'];
        $título = 'Sistema Acuarios Ancud';
                
        $mensaje = "
                    <html> 
                        <body> 
                            <h1>Restablecer contraseña</h1> 
                            <p> 
                                <b>Se le asigno la siguiente contraseña temporal: ".$d."</b> 
                            </p> 
                            <p>
                                <b>Para acceder al Sistema de Acuarios Ancud, pinche en el siguiente enlace:</b> 
                            </p>
                            <p>
                                <a href='http://acuariosancud.cl/dashboard/index.php'>Sistema Acuarios Ancud</a>
                            </p>
                            <p>
                                Favor no responder este mensaje, Gracias!!.
                            </p>
                        </body> 
                    </html>";
        
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            
        $cabeceras .= 'From: Acuarios Ancud <acuariosancudchiloe@acuariosancud.cl>' . "\r\n";
            
        if(mail($para, $título, $mensaje, $cabeceras))
        {
            $consulta = "UPDATE usuarios set password='$hash' where email='$_POST[correo]'";
            $resultado = mysqli_query( conectar(), $consulta );
            if ($columna = mysqli_fetch_array( $resultado ))
            { 
                $messages[] = "Revise su correo para ver la contraseña temporal.";
            }
        }
            
        else{
            $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error(conectar());
        }
    }
    else{
        $errors []= "Correo ingresado no esta registrado en la base de datos.".mysqli_error(conectar());
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