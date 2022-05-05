<?php
    session_start();
    require_once("../php/conexion.php");

    $id = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['id'], ENT_QUOTES)));

    $consulta = "SELECT * FROM productos WHERE id_producto=$id";
    $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    if ($columna = mysqli_fetch_array( $resultado ))
    {
        $id_familia = $columna['id_familia'];
    }

    $query = mysqli_query(conectar(),"SELECT * FROM productos WHERE id_familia = $id_familia ORDER BY id_producto DESC LIMIT 4");
    while($row = mysqli_fetch_array($query)){
?>

        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product__item">
                <div class="product__item__pic set-bg" style="background:url('sistema/<?=$row['imagen']?>') no-repeat;background-size:cover;background-position:center;">
                    <ul class="product__item__pic__hover">
                        <li><a href="producto-detalle.php?id=<?=$row['id_producto']?>"><i class="fa fa-eye"></i></a></li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6><a href="producto-detalle.php?id=<?=$row['id_producto']?>"><?=$row['nombre']?></a></h6>
                    <h5><?php echo "$".number_format($row['precio'], 0, ",", ".");?></h5>
                </div>
            </div>
        </div>
<?php } ?>