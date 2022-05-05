<?php 
    session_start();
    require_once("./php/conexion.php");
    $_SESSION['pagina'] = "blog";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Acuarios Ancud | Detalle Blog</title>
    <?php include('head.php')?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php include('nav.php')?>

    <div id="resultado"></div>

    <?php include('footer.php')?>
    <script>
        $(document).ready(function() {
            load()
            recientes()
        });
    </script>
    <script>
        $( "#Search" ).submit(function( event ) {
            var buscar = $('#buscar').val();
            console.log(buscar);
            location.href='productos.php?id="'+ buscar +'"';
            event.preventDefault();
        });
    </script>
    <script>
        function load() {
            var id = <?=$_GET['id']?>;
            var parametros = { 'id':id }
            $.ajax({
                url: 'ajax/consulta_blog_detalle.php',
                data: parametros,
                success: function (data) {
                    $("#resultado").html(data)
                }
            })
        }

        $( "#BuscarBlog" ).submit(function( event ) {
            load()
            event.preventDefault()
        });

        function recientes(){
            $.ajax({
                url: 'ajax/consulta_anuncios_recientes.php',
                success: function (data) {
                    $("#recientes").html(data)
                }
            })
        }
    </script>
</body>

</html>