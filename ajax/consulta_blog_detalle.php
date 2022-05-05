<?php
    session_start();
    require_once("../php/conexion.php");

    $id = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['id'], ENT_QUOTES)));
    $query = mysqli_query(conectar(),"SELECT a.imagen as imagen, a.fecha as fecha, a.descripcion as descripcion, a.titulo as titulo, b.nombre as usuario,b.imagen as perfil FROM anuncios a inner join usuarios b on a.id_usuario = b.id_usuario where a.id_anuncio = $id");
    if($row = mysqli_fetch_array($query)){
?>
    <section class="blog-details-hero set-bg" style="background:url('img/blog/details/details-hero.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2><?=$row['titulo']?></h2>
                        <ul>
                            <li>Por <?=$row['usuario']?></li>
                            <li><?php echo date("d/m/Y", strtotime($row['fecha']));?></li>
                        </ul>
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
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        <img src="<?=$row['imagen']?>" alt="">
                        <p><?=$row['descripcion']?></p>
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="sistema/<?=$row['perfil']?>" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6><?=$row['usuario']?></h6>
                                        <span>Administrador</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>