<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Despacho</title>
    <style>
        .contenedor{
            width:100%;
            height:681px;
        }
        img{
            position:absolute;
            width:100%;
            right:10px;
            top:10px;
        }
        .rmt{
            position:absolute;
            right:10px;
        }
        h1{font-size:2.5rem;}
    </style>
</head>
<body>
    
    <div class="contenedor">
        <div style="width:70%;">
            <?php
                $id = $_GET["id"];
                $consulta = "call consulta_cliente($id)";
                $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while ($columna = mysqli_fetch_array( $resultado ))
                {
                    echo    "<h1 style='padding-left:10px'>".$columna['nombre']."</h1>
                            <h1 style='padding-left:10px'>".$columna['direccion']."</h1>
                            <h1 style='padding-left:10px'>".$columna['ciudad']."</h1>
                            <h1 style='padding-left:10px'>".$columna['telefono']."</h1>";
                }
            ?>
        </div>
        <div style="width:30%;">
            <img src="../../../img/logo.png" alt="">
        </div>
        <div style="width:100%;display:flex;flex-direction:column;">
            <h1 style="position:absolute;right:10px;bottom:-150px;">RMTE:</h1>
            <h1 style="position:absolute;right:10px;bottom:-210px;">ACUARIOS ANCUD CHILOE</h1>
            <h1 style="position:absolute;right:10px;bottom:-260px;">BAQUEDANO 309 ANCUD</h1>
            <h1 style="position:absolute;right:10px;bottom:-290px;">+56971226267</h1>
        </div>
    </div>
</body>
</html>
    

    
