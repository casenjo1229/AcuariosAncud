<?php 
    session_start();
    require_once("./php/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Acuarios Ancud | Detalle</title>
    <?php include('head.php')?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php include('nav.php')?>

    <div id="resultado"></div>

    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2 class="text-uppercase">Productos relacionados</h2>
                    </div>
                </div>
            </div>
            <div class="row" id="relacionados"></div>
        </div>
    </section>

    <?php include('footer.php')?>
    <script>
        $(document).ready(function() {
            load()
            relacionados()
        });
    </script>
    <script>
        function load() {
            var id = <?=$_GET['id']?>;
            var parametros = { 'id':id }
            $.ajax({
                url: 'ajax/consulta_producto_detalle.php',
                data: parametros,
                success: function (data) {
                    $("#resultado").html(data)
                }
            })
        }

        function relacionados() {
            var id = <?=$_GET['id']?>;
            var parametros = { 'id':id }
            $.ajax({
                url: 'ajax/consulta_productos_relacionados_detalle.php',
                data: parametros,
                success: function (data) {
                    $("#relacionados").html(data)
                }
            })
        }
    </script>
</body>

</html>