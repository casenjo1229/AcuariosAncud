<?php
    session_start();
    require_once("../php/conexion.php");
    $query = mysqli_query(conectar(),"SELECT * FROM anuncios ORDER BY id_anuncio DESC LIMIT 3");
    while($row = mysqli_fetch_array($query)){
?>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="blog__item">
                <div class="blog__item__pic">
                    <img src="<?=$row['imagen']?>" alt="">
                </div>
                <div class="blog__item__text">
                    <ul>
                        <li><i class="fa fa-calendar-o"></i> <?php echo date("d/m/Y", strtotime($row['fecha']));?></li>
                    </ul>
                    <h5><a href="blog-detalle.php?id=<?=$row['id_anuncio']?>"><?=$row['titulo']?></a></h5>
                    <p><?php echo limitar_cadena($row['descripcion'], 150, "..."); ?></p>
                </div>
            </div>
        </div>


<?php }

    function limitar_cadena($cadena, $limite, $sufijo){
        if(strlen($cadena) > $limite){
            return substr($cadena, 0, $limite) . $sufijo;
        }
        
        return $cadena;
    }
?>