<?php 
    session_start();
    require_once("../php/conexion.php");

    $id = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['id'], ENT_QUOTES)));
    $query = mysqli_query(conectar(),"SELECT b.nombre as nombre,b.precio as precio, a.detalle as detalle, a.descripcion as descripcion, b.imagen as imagen, b.stock as stock from detalle_producto a inner join productos b on a.id_producto = b.id_producto where a.id_producto=$id");
    if($row = mysqli_fetch_array($query)){
?>

    <section class="breadcrumb-section set-bg" style="background:url('img/breadcrumb.jpg') no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2><?=$row['nombre']?></h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Inicio</a>
                            <a href="./productos.php">Productos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="sistema/<?=$row['imagen']?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?=$row['nombre']?></h3>
                        <div class="product__details__price"><?php echo "$".number_format($row['precio'], 0, ",", ".");?></div>
                        <div class="detalle"><?=$row['detalle']?></div>
                        <ul>
                            <?php if($row['stock'] != 0){ ?>
                                <li><b>Disponibilidad</b> <span>En Stock</span></li>
                            <?php }else{ ?>
                                <li><b>Disponibilidad</b> <span>Sin Stock</span></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Descripción</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li> -->
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Información</h6>
                                    <div><?=$row['descripcion']?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php 
    }
?>