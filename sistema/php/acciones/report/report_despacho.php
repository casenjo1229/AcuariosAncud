<?php
    session_start();
    require_once("../../conexion.php");
    require_once '../../../vendor/autoload.php'; 
    use Dompdf\Dompdf; 

    ob_start();
    include '../../../diseños/clientes/reporte_despacho.php';
    $html = ob_get_clean();
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
       
    $dompdf->setPaper('A4', 'Landscape'); 
    $dompdf->render();
    $dompdf->stream("despacho.pdf", array("Attachment" => 0));
?>