<?php
    session_start();
    require_once("../../conexion.php");
    require_once '../../../vendor/autoload.php'; 
    use Dompdf\Dompdf; 

    ob_start();
    include '../../../diseños/clientes/reporte_carnet.php';
    $html = ob_get_clean();
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
       
    $dompdf->setPaper('A4', 'portrait'); 
    $dompdf->render();
    $dompdf->stream("carnet.pdf", array("Attachment" => 0));
?>