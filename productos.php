<?php 
    session_start();
    require_once("./php/conexion.php");
    $_SESSION['pagina'] = "productos";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Acuarios Ancud | Productos</title>
    <?php include('head.php')?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php include('nav.php')?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Productos</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Inicio</a>
                            <span>Productos</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Categorias</h4>
                            <ul>
                            <?php 
                                $consulta = "SELECT * FROM familias";
                                $resultado = mysqli_query( conectar(), $consulta );
                                while ($columna = mysqli_fetch_array( $resultado ))
                                {
                                    if($_GET['id'] == $columna['id_familia']){
                                    ?>
                                        <li><a clasS="active" href="productos.php?id=<?=$columna['id_familia']?>"><?=$columna['familia']?></a></li>
                                    <?php
                                    }else{?>
                                        <li><a href="productos.php?id=<?=$columna['id_familia']?>"><?=$columna['familia']?></a></li>
                                    <?php
                                    }
                                }
                            ?>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Últimos productos</h4>
                                <div class="latest-product__slider owl-carousel">
<?php
                                    require_once("php/conexion.php");

                                    $consulta = "SELECT count(*) contador FROM familias WHERE familia <> ''";
                                    $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                                    if ($columna = mysqli_fetch_array( $resultado ))
                                    {
                                        $contador = $columna['contador'];
                                    }

                                    for($i=1; $i<= $contador; $i++)
                                    {
?>
                                        <div class="latest-prdouct__slider__item">
<?php
                                        $query = mysqli_query(conectar(),"SELECT * FROM productos where id_familia = $i ORDER BY id_producto DESC LIMIT 4");
                                        while($row = mysqli_fetch_array($query)){
?>
                                            <a href="producto-detalle.php?id=<?=$row['id_producto']?>" class="latest-product__item">
                                                <div class="latest-product__item__pic">
                                                    <img src="sistema/<?=$row['imagen']?>" alt="" style="width:100px;height=100px;  ">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6><?=$row['nombre']?></h6>
                                                    <span><?php echo "$".number_format($row['precio'], 0, ",", ".");?></span>
                                                </div>
                                            </a>
<?php 
                                        }
?>
                                        </div>
<?php
                                    }
?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Ordenar por</span>
                                    <select id="orden">
                                        <option value="asc">Menor precio</option>
                                        <option value="desc">Mayor precio</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span id="numero"></span> Productos encontrados</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="resultado"></div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" value="Pez Tropical" id="familia" name="familia">

    <?php include('footer.php')?>
    <script>
        $(document).ready(function() {
            var get = <?=$_GET['id']?>;
            if (!isNaN(get)){
                load(1)
            } else {
                load_buscar_inicio(1)
            }
        });
    </script>
    <script>
        function load(page) {
            var familia = <?=$_GET['id']?>;
            var orden = $('#orden').val()
            var buscar = $('#buscar').val()
            var parametros = { 'familia':familia,'page':page,'buscar':buscar,'orden':orden }
            $.ajax({
                url: 'ajax/consulta_productos.php',
                data: parametros,
                success: function (data) {
                    $("#resultado").html(data)
                    var total = $('#cantidad').val()
                    $('#numero').text(total)
                }
            })
        }

        function load_buscar(page) {
            var orden = $('#orden').val()
            var buscar = $('#buscar').val()
            var parametros = {'page':page,'buscar':buscar,'orden':orden }
            $.ajax({
                url: 'ajax/consulta_productos_b.php',
                data: parametros,
                success: function (data) {
                    $("#resultado").html(data)
                    var total = $('#cantidad').val()
                    $('#numero').text(total)
                }
            })
        }

        function load_buscar_inicio(page) {
            var get = <?=$_GET['id']?>;
            var orden = $('#orden').val()
            var buscar = get
            var parametros = {'page':page,'buscar':buscar,'orden':orden }
            $.ajax({
                url: 'ajax/consulta_productos_buscar.php',
                data: parametros,
                success: function (data) {
                    $("#resultado").html(data)
                    var total = $('#cantidad').val()
                    $('#numero').text(total)
                }
            })
        }

        $('select').on('change', function () {
            var o = $('#orden option:selected').val()
            var get = <?=$_GET['id']?>;
            var buscar = $('#buscar').val()

            if($('#buscar').val().length == 0){
                if (!isNaN(get)){
                    load(1)
                } else {
                    load_buscar_inicio(1)
                } 
            }
            else{
                load_buscar(1)
            }
            $('#orden option[value="'+ o +'"]')
        });

        $( "#Search" ).submit(function( event ) {
            load_buscar(1)
            event.preventDefault()
        });
    </script>
</body>

</html>