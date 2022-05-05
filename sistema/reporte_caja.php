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
    date_default_timezone_set("America/Santiago");
    $fec = date("Y-m-d");
    $efectivo = 0;

    $query = mysqli_query(conectar(),"CALL consulta_caja_chica('2020-11-09')");
    $query1 = mysqli_query(conectar(),"CALL consulta_caja_chica('2020-11-09')");
    if($row1 = mysqli_fetch_array($query1))
    {
        $total1 = $row1['Efectivo'] + $row1['Debito'] + $row1['Credito'] + $row1['Transferencia'] + $row1['Abonos'];
    }   

    $query2 = mysqli_query(conectar(),"SELECT total as Total2 FROM caja WHERE fecha ='2020-11-09'");
    if($row2 = mysqli_fetch_array($query2))
    {
        $caja = $row2['Total2'];
    }else{$caja = 0;}

    $query3 = mysqli_query(conectar(),"SELECT sum(valor) as Total3 FROM gastos WHERE fecha ='2020-11-09'");
    if($row3 = mysqli_fetch_array($query3))
    {
        $gastos = $row3['Total3'];
    }else{$gastos = 0;}
?>

<body class="p-0 m-0">
    <div class="mt-2">
        <div class="d-flex" style="width:32%;">
            <div>
                <h2>Caja Chica</h2>
            </div>
            <img src="../../../img/logo.png" class="position-absolute float-right" style="width: 80px;">
        </div>
        <h5 class="mt-3"><?php $fecha = date("Y-m-d"); echo $fecha;?></h5>
    </div>

    <table class="table tab table-bordered tab-cot mt-3" style="width:32%;">
        <thead>
            <tr>
                <th scope="col" class="bor" style="white-space:nowrap;">Tipo</th>
                <th scope="col" class="bor" style="white-space:nowrap;text-align:center;">Total</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while($row = mysqli_fetch_array($query)){              
        ?>
                <tr>
                    <td>Efectivo</td>
                    <td>
                        <?php 
                            $total = $row['Efectivo'] + $row['Abonos'];
                            echo "$".number_format($total)
                        ?>
                    </td>
                    </tr>
                    <tr>
                        <td>Debito</td>
                        <td><?php echo "$".number_format($row['Debito'])?></td>
                    </tr>
                    <tr>
                        <td>Tarjeta de Credito</td>
                        <td><?php echo "$".number_format($row['Credito'])?></td>
                    </tr>
                    <tr>
                        <td>Transferencia</td>
                        <td><?php echo "$".number_format($row['Transferencia'])?></td>
                    </tr>
                    
                    <tr>
                        <td><b>Total</b></td>
                        <td><b>$<?php echo number_format($total1);?></b></td>
                    </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    <table class="table tab table-bordered tab-cot mt-2" style="width:32%;">
        <tbody>
            <tr>
                <td>Apertura caja</td>
                <td>$<?php echo number_format($caja);?></td>
            </tr>
            <tr>
                <td>Gastos</td>
                <td>$<?php echo number_format($gastos);?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>