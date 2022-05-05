<?php
    session_start();
    include ('../../conexion.php');

    use PHPMailer\PHPMailer\PHPMailer;
    require '../../../vendor/autoload.php';

    $id_usuario = $_SESSION['id_user'];
    date_default_timezone_set("America/Santiago");
    $fecha = date("Y-m-d G:i:s");

    $consulta = "SELECT max(id_usuario) as correlativo FROM usuarios";
	$resultado = mysqli_query( conectar(), $consulta );
	if ($columna = mysqli_fetch_array( $resultado ))
	{ 
        $contador = $columna['correlativo'] + 1;
    }
    else
    {
        $contador = 1;
    }
            
    $d=mt_rand(1111,9999);
    $hash = password_hash($d, PASSWORD_DEFAULT);
    
    $query="INSERT INTO usuarios (id_usuario,nombre,email,imagen,id_perfil,password,temporal,fec_registro,id_usuario_registro) values($contador,'$_POST[nombre0]','$_POST[email0]','img/perfil/perfil.png',$_POST[perfil0],'$hash',1,'$fecha',$id_usuario)";
    if (conectar()->query($query) === TRUE) 
    {
        $to = "acuariosancudchiloe@acuariosancud.cl";
        $subject = "Sistema Acuarios Ancud";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        $message = "
            <html> 
                <head> 
                    <title>Sistema Acuarios Ancud</title> 
                </head> 
                <body> 
                    <h1>Bienvenido ".$_POST['nombre0']."!</h1> 
                    <p> 
                        <b>Para acceder al Sistema de Acuarios Ancud, pinche en el siguiente enlace:</b> 
                    </p> 
                    <p>
                        <a href='http://acuariosancud.cl/dashboard/index.php'>Sistema Acuarios Ancud</a>
                    </p>
                    <p>
                        Contraseña temporal: ".$d."
                    </p>
                    <p>
                        Favor no responder este mensaje, Gracias!!.
                    </p>
                </body> 
            </html>";
  
        mail($to, $subject, $message, $headers);
        $messages[] = "Usuario guardado satisfactoriamente."; 
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