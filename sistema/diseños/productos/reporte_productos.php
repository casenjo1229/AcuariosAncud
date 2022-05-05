<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Reporte Listado Productos</title>
    <style>
        @page { margin-top: 180px;margin-bottom: 180px; margin-left:50px; }
        #header { position: fixed; left: 0px; top: -150px; right: 0px; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; }
        #footer .page:after { content: counter(page, upper-roman); }
        .e1{padding:5px;text-align:center;}
        .e2{font-size:11px;}
        .table td {border: 1px solid #dee2e6;}
    </style>
</head>

<body>
<script type="text/php">
    if ( isset($pdf) ) { 
        $pdf->page_script('
        if ($PAGE_COUNT >= 1) {
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 9;
            $pageText = "Página " . $PAGE_NUM . " de " . $PAGE_COUNT;
            $y = 53;
            $x = 485;
            $pdf->text($x, $y, $pageText, $font, $size);
        } 
    ');
}
</script> 

    <table id="header" border=1 cellspacing=0 cellpadding=2 width="100%" class="table">
        <tr>
            <td class="e1 e2" rowspan="4" width="12%"><img src="../../../img/logo.png" alt="" style="width:90px;"></td>
            <td class="e1 e2" width="58%" rowspan="4"><h1>LISTADO PRODUCTOS</h1></td>
            <td class="e1 e2">Versión</td>
            <td class="e1 e2">0.1</td>
            <tr>
                <td colspan=2 class="e1 e2"></td>
            </tr>
            <tr>
                <td class="e1 e2" width="10%">Fecha Elab</td>
                <td width="10%" class="e1 e2">12/06/2020</td>
            </tr>
            <tr>
                <td class="e1 e2" width="12%">Fecha Edición</td>
                <td width="10%" class="e1 e2">12/06/2020</td>
            </tr>
        </tr>
    </table>

    <table border=1 cellspacing=0 cellpadding=2 width="100%" class="table">
        <tr>
            <td class="e1" style="font-weight:bolder;">Codigo</td>
            <td class="e1" style="font-weight:bolder;">Nombre</td>
            <td class="e1" style="font-weight:bolder;">Familia</td>
            <td class="e1" style="font-weight:bolder;">Stock</td>
            <td class="e1" style="font-weight:bolder;">Precio</td>
            <td class="e1" style="font-weight:bolder;">Ubicación</td>
        </tr>
        <?php
            $consulta = "call consulta_reporte_productos()";
            $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            while ($columna = mysqli_fetch_array( $resultado ))
            {
                echo    "<tr>
                            <td>".$columna['Codigo']."</td>
                            <td class='e1'>".$columna['Nombre']."</td>
                            <td class='e1'>".$columna['Familia']."</td>
                            <td class='e1'>".$columna['Stock']."</td>
                            <td class='e1'>".$columna['Precio']."</td>
                            <td class='e1'>".$columna['Ubicacion']."</td>
                        </tr>";
            }
        ?>
    </table>
</body>
</html>