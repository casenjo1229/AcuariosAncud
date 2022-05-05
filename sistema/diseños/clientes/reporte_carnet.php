<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Carnet Cliente</title>
    <style>
        .contenedor{
            width:8.5cm;
            height:5.5cm;
            border:1px solid #000;
        }
        .img{
            position:absolute;
            width:20%;
            right:10px;
            top:7px;
        }
        .img1{
            position:absolute;
            width:25%;
            left:10px;
            margin-top:10px;
        }
        .head{
            height:80px;
            background:#154D92;
            position:relative;
        }
        .head1{
            height:60px;
            background:#154D92;
            position:relative;
        }
        .head1 h1{
            font-size:16px;
            text-align:center; 
            padding-top:20px;
        }
        h1{
            color:#fff;
            font-size:18px;
            margin:0px;
            padding:10px;
        }
        h3{font-size:11px;padding:0;padding-left:5px;margin:0;}
        .footer
        {
            height:40px;
            background:#154D92;
            position:absolute;
            bottom:592px;
        }
    </style>
</head>
<body>
    <?php
        $id = $_GET["id"];
        $consulta = "call consulta_cliente($id)";
        $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
        while ($columna = mysqli_fetch_array( $resultado ))
        {
            echo    "<div class='contenedor'>
                        <div class='head'>
                            <h1>ACUARIOS ANCUD</h1>
                            <h1 style='font-size:12px;'>CARNET DE TIENDA</h1>
                            <img class='img' src='../../../img/logo.png' alt=''>
                        </div>
                        <div style='margin-top:15px;'>
                            <div style='display:flex;'>
                                <div style='width:30%;'>
                                    <h3>RUT:</h3>
                                </div>
                                <div style='margin-left:80px;'>
                                    <h3>".$columna['rut']."</h3>
                                </div>
                            </div>
                            <div style='display:flex;'>
                                <div style='width:30%;'>
                                    <h3>NOMBRE:</h3>
                                </div>
                                <div style='margin-left:80px;'>
                                    <h3>".$columna['nombre']."</h3>
                                </div>
                            </div>
                            <div style='display:flex;'>
                                <div style='width:30%;'>
                                    <h3>TELÉFONO:</h3>
                                </div>
                                <div style='margin-left:80px;'>
                                    <h3>".$columna['telefono']."</h3>
                                </div>
                            </div> 
                            <div style='display:flex;'>
                                <div style='width:30%;'>
                                    <h3>CORREO:</h3>
                                </div>
                                <div style='margin-left:80px;'>
                                    <h3>".$columna['correo']."</h3>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class='contenedor' style='margin-top:20px;'>
                        <div class='head1'>
                            <h1>RAMIREZ 294 LOCAL 22 Y 23</h1>
                        </div>
                        <div style='position:absolute;'>
                            <img class='img1' src='../../../img/logo.png' alt=''>
                        </div>
                        <div style='position:relative;'>
                            <div class='footer'>
                                <h3 style='color:#fff;margin-top:5px;'>TIPO ACUARIO:</h3>
                                <h3 style='color:#fff;margin-top:5px;'>".$columna['acuario']."</h3>
                                <h3 style='position:absolute;right:15px;top:20px;color:#fff;font-size:14px;'>www.acuariosancud.cl</h3>
                            </div>
                        </div>
                    </div>";
        }
    ?>
    
</body>
</html>
    

    
