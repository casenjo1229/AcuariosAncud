<?php 
    session_start();
    require_once("./php/conexion.php");
    $_SESSION['pagina'] = "blog";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Acuarios Ancud | Blog</title>
    <?php include('head.php')?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php include('nav.php')?>

    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Blog</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Inicio</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__search">
                            <form id="BuscarBlog">
                                <input type="text" placeholder="Buscar..." name="blog" id="blog">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Blog recientes</h4>
                            <div class="blog__sidebar__recent" id="recientes"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row" id="resultado"></div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php')?>
    <script>
        $(document).ready(function() {
            load(1)
            recientes()
        });
    </script>
    <script>
        function load(page) {
            var buscar = $('#blog').val()
            var parametros = { 'page':page,'buscar':buscar }
            $.ajax({
                url: 'ajax/consulta_anuncios.php',
                data: parametros,
                success: function (data) {
                    $("#resultado").html(data)
                }
            })
        }

        $( "#BuscarBlog" ).submit(function( event ) {
            load(1)
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

        $( "#Search" ).submit(function( event ) {
            var buscar = $('#buscar').val();
            console.log(buscar);
            location.href='productos.php?id="'+ buscar +'"';
            event.preventDefault();
        });
    </script>
</body>

</html>