<?php
    session_start();
    require_once("../php/conexion.php");

    $query = mysqli_query(conectar(),"SELECT * FROM anuncios ORDER BY id_anuncio DESC LIMIT 4");
    while($row = mysqli_fetch_array($query)){
?>
        <a href="blog-detalle.php?id=<?=$row['id_anuncio']?>" class="blog__sidebar__recent__item">
            <div class="blog__sidebar__recent__item__pic" style="width:70px;">
                <img src="<?=$row['imagen']?>" alt="">
            </div>
            <div class="blog__sidebar__recent__item__text">
                <h6><?=$row['titulo']?></h6>
                <span><?php echo date("d/m/Y", strtotime($row['fecha']));?></span>
            </div>
        </a>
<?php } ?>