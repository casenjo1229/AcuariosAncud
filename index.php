<?php 
    session_start();
    require_once("./php/conexion.php");
    $_SESSION['pagina'] = "inicio";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Acuarios Ancud | Inicio</title>
    <?php include('head.php')?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php include('nav-home.php')?> 

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/tropical.png">
                            <h5><a href="productos.php?id=1">Pez Tropical</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/frio.png">
                            <h5><a href="productos.php?id=2">Pez Frío</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/repuesto.png">
                            <h5><a href="productos.php?id=3">Respuestos</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/acondicionador.png">
                            <h5><a href="productos.php?id=4">Acondicionadores</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/alimento.png">
                            <h5><a href="productos.php?id=5">Alimentos</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Productos Destacados</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">Todos</li>
                            <li data-filter=".tropical">Pez Tropical</li>
                            <li data-filter=".frio">Pez Frío</li>
                            <li data-filter=".repuestos">Repuestos</li>
                            <li data-filter=".acondicionador">Acondicionadores</li>
                            <li data-filter=".alimentos">Alimentos</li>
                            <li data-filter=".plantas">Plantas</li>
                            <li data-filter=".perros">Perros</li>
                            <li data-filter=".gatos">Gatos</li>
                            <li data-filter=".invertebrados">Invertebrados</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
<?php 
                $contador = 10;
                for($i=0; $i<= $contador; $i++)
                {
                    $query = mysqli_query(conectar(),"SELECT * FROM productos WHERE id_familia=$i and destacado = 1 LIMIT 6");
                    while($row = mysqli_fetch_array($query))
                    {
                        switch($i){
                            case 1: $familia = "tropical";
                            break;
                            case 2: $familia = "frio";
                            break;
                            case 3: $familia = "repuestos";
                            break;
                            case 4: $familia = "acondicionador";
                            break;
                            case 5: $familia = "alimentos";
                            break;
                            case 6: $familia = "plantas";
                            break;
                            case 7: $familia = "perros";
                            break;
                            case 8: $familia = "gatos";
                            break;
                            case 9: $familia = "invertebrados";
                            break;
                        }
                ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mix <?=$familia?>">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="sistema/<?=$row['imagen']?>">
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="producto-detalle.php?id=<?=$row['id_producto']?>"><i class="fa fa-eye"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="producto-detalle.php?id=<?=$row['id_producto']?>"><?=$row['nombre']?></a></h6>
                                    <h5><?php echo "$".number_format($row['precio'], 0, ",", ".");?></h5>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
?>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row" id="blogs"></div>
        </div>
    </section>
    <!-- Blog Section End -->

    <?php include('footer.php')?>
    <script>
        $(document).ready(function() {
            blogs()
        });
    </script>
    <script>
        function blogs() {
            $.ajax({
                url: 'ajax/consulta_blog_inicio.php',
                success: function (data) {
                    $("#blogs").html(data)
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