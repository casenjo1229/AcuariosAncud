<?php
    session_start();
    include("php/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <title>Imprimir</title>
</head>
<body>
    <?php 
        for($c=1; $c<=55;$c++)
        {
    ?>
            <img data-value="<?php echo $_GET["id"];?>" data-text="<?php echo $_GET["id"];?>" class="codigo" style="width:120px;"/>
    <?php        
        }
    ?>
    
    <script>
        JsBarcode(".codigo").init();
    </script>
</body>
</html>