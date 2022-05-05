<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css"href="css/ventas.css">
    <style>
        html { margin: 5px !important;}
        body{font-size:12px;}
        
    </style>
</head>

<?php 
    $consulta = "SELECT * FROM venta WHERE id_venta = $_GET[id]";
    $resultado = mysqli_query( conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    if ($columna = mysqli_fetch_array( $resultado ))
    { 
        $venta = $columna['id_venta'];
        $fecha = $columna['fecha'];
    }
?>

<body class="bl p-0 m-0">
    <div class="mt-2">
        <div class="d-flex" style="width:32%;">
            <div>
                <h2 class="font-weight-bold">Nº Venta</h2>
                <h1 class="font-weight-bold ml-4"><?php echo $venta;?></h1>   
            </div>
            <img src="../../../img/logo.png" class="position-absolute float-right" style="width: 80px;">
        </div>
        <h5 class="mt-3 font-weight-bold"><?php echo $fecha;?></h5>
    </div>

    <table class="table tab table-bordered tab-cot mt-4" style="width:32%;">
        <thead>
            <tr>
                <th scope="col" class="bor font-weight-bold" style="white-space:nowrap;">Producto</th>
                <th scope="col" class="bor font-weight-bold" style="white-space:nowrap;text-align:center;">Cant</th>
                <th scope="col" class="bor font-weight-bold" style="white-space:nowrap;text-align:center;">Precio</th>
            </tr>
        </thead>
        <tbody>
            <?php 

                $consulta = "call consulta_venta_detalle($_GET[id])";
                $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while ($columna = mysqli_fetch_array( $resultado ))
                {
                    ?>
                        <tr>
                            <td class="font-weight-bold"><?php echo $columna['Producto'];?></td>
                            <td class="font-weight-bold"><?php echo $columna['Cantidad'];?></td>
                            <td class="font-weight-bold"><?php echo '$'.number_format($columna['Precio'], 0, ",", ".");?></td>
                        </tr>

                    <?php
                }

            ?>
                    
        </tbody>
    </table>

    <table class="table tab table-bordered tab-cot mt-4" style="width:32%;">
        <tbody>
            <?php 
                $consulta = "call consulta_print_venta($_GET[id])";
                $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                if ($columna = mysqli_fetch_array( $resultado ))
                {
                    ?>
                        <tr>
                            <td scope="col" class="bor font-weight-bold" style="white-space:nowrap;">SubTotal</td>
                            <td class="font-weight-bold"><?php echo '$'.number_format($columna['SubTotal'], 0, ",", ".");?></td>
                        </tr>
                        <tr>
                            <td scope="col" class="bor font-weight-bold" style="white-space:nowrap;">Descuento</td>
                            <td class="font-weight-bold">
                                <?php
                                    if($columna['Tipo'] == "porcentaje")
                                    {
                                        echo number_format($columna['Descuento'], 0, ",", ".")."%";
                                    }
                                    else
                                    {
                                        echo '$'.number_format($columna['Descuento'], 0, ",", ".");
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="col" class="bor font-weight-bold" style="white-space:nowrap;">Abono</td>
                            <td class="font-weight-bold"><?php echo '$'.number_format($columna['Abono'], 0, ",", ".");?></td>
                        </tr>
                        <tr>
                            <td scope="col" class="bor font-weight-bold" style="white-space:nowrap;;">A Pagar</td>
                            <td class="font-weight-bold"><?php echo '$'.number_format($columna['Total'], 0, ",", ".");?></td>
                        </tr>

                    <?php
                }

            ?>
                    
        </tbody>
    </table>
</body>
</html>