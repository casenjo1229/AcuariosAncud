<?php 
    session_start();

    if($_SESSION['captcha'] == $_POST['securityCode'])
    {
        $para  = "tiendacuarios@acuariosancud.cl";
        $título = 'Datos Contacto';

        $mensaje = '<html>
                        <head>
                            <style>
                                td, td  p{
                                    text-align: center; 
                                    vertical-align: middle;
                                }
                                .btn-rifa{
                                    margin-top:20px;
                                    padding: 15px;
                                    border-radius: 5px;
                                    background: #4DA6B7;
                                    color:#fff;
                                    text-decoration: none;
                                }
                                p, h1{color:#000}
                            </style>
                        </head>
                        <body>
                            <table cellspacing="0" style="width: 100%;"> 
                                <tr>
                                    <td><h1>Información</td>
                                </tr>
                                <tr>
                                    <td><p style="width: 20%; margin:5px auto; text-align:justify;">Correo enviado desde el sitio web acuariosancud.cl</p></td>
                                </tr>
                            </table> 
                            <table style="width: 0%;margin:auto;">
                                <tr>
                                    <td style="font-weight: 700;">Nombre:</td>
                                    <td style="font-weight: 700;">'.$_POST['nombre'].'</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 700;">Correo:</td>
                                    <td style="font-weight: 700;">'.$_POST['email'].'</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 700;">Teléfono:</td>
                                    <td style="font-weight: 700;">'.$_POST['telefono'].'</td>
                                </tr> 
                                <tr>
                                    <td style="font-weight: 700;">Ciudad:</td>
                                    <td style="font-weight: 700;">'.$_POST['ciudad'].'</td>
                                </tr> 
                                <tr>
                                    <td style="font-weight: 700;">Mensaje:</td>
                                    <td style="font-weight: 700;">'.$_POST['mensaje'].'</td>
                                </tr>   
                            </table>
                        </body>
                    </html>
        ';

        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $cabeceras .= 'From: Contacto pagina web <tiendacuarios@acuariosancud.cl>' . "\r\n";

        if(mail($para, $título, $mensaje, $cabeceras))
        {
            $messages[] = "Correo enviado satisfactoriamente.";
        }

        else{
            $errors []= "Lo siento algo ha salido mal intenta nuevamente.";
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
    }
    else
    {
        ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Error!</strong> 
                        Captcha no coincide con el de la imagen.
                </div>
                <?php
    }

    
?>