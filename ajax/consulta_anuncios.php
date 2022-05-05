<?php 
    session_start();
    require_once("../php/conexion.php");

    $buscar = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['buscar'], ENT_QUOTES)));
    $tables="	anuncios a inner join
                usuarios b on a.id_usuario = b.id_usuario";

	$campos="	a.id_anuncio as id,
                a.titulo as titulo,
                a.descripcion as descripcion,
                a.imagen as imagen,
                a.fecha as fecha";
	$sWhere=" a.titulo LIKE '%".$buscar."%' or a.descripcion LIKE '%".$buscar."%'";
	$sWhere.=" order by a.fecha desc";

    include 'pagination.php'; 
    $page = getPaginationPos();
	$per_page = 4;
    $adjacents  = 4;
    $offset = ($page - 1) * $per_page;
    $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
    if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
    $total_pages = ceil($numrows/$per_page);
	$reload = 'blog.php';

    $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");
?>
    
<?php
    if ($numrows>0){
		while($row = mysqli_fetch_array($query)){
?>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="<?=$row['imagen']?>" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o pr-2 "></i><?php echo date("d/m/Y", strtotime($row['fecha']));?></li>
                        </ul>
                        <h5><a href="blog-detalle.php?id=<?=$row['id']?>"><?=$row['titulo']?></a></h5>
                        <p><?php echo limitar_cadena($row['descripcion'], 150, "..."); ?></p>
                        <a href="blog-detalle.php?id=<?=$row['id']?>" class="blog__btn">Leer más <span class="arrow_right"></span></a>
                    </div>
                </div>
            </div>
<?php
		}
?>
            <div class="table-pagination pull-right w-100">
			    <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
		    </div>
		
<?php	
		} else {
			?>
			<div class="alert alert-warning alert-dismissable w-100">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay anuncios para mostrar
            </div>
			<?php
		}
?>

<?php 
    function getPaginationPos(){
        if (isset($_REQUEST['page']) && !empty($_REQUEST['page']))
        {
            setcookie('page_productos',$_REQUEST['page'],time() + 86400);
            return $_REQUEST['page'];
        } 
        else 
        {
            return ($_COOKIE['page_productos']!='' ? $_COOKIE['page_productos'] : 1);
        }
    }

    function limitar_cadena($cadena, $limite, $sufijo){
        if(strlen($cadena) > $limite){
            return substr($cadena, 0, $limite) . $sufijo;
        }
        
        return $cadena;
    }
?>