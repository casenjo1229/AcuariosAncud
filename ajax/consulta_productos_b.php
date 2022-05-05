<?php 
    session_start();
    require_once("../php/conexion.php");

    $buscar = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['buscar'], ENT_QUOTES)));
    $orden = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['orden'], ENT_QUOTES)));
    $tables="	productos a";

	$campos="	a.id_producto as id,
                a.nombre as nombre,
                a.precio as precio,
                a.imagen as imagen";
	$sWhere=" a.nombre LIKE '%".$buscar."%'";
	$sWhere.=" order by a.precio $orden";

    include 'pagination_b.php'; 
    $page = getPaginationPos();
	$per_page = 12;
    $adjacents  = 12;
    $offset = ($page - 1) * $per_page;
    $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
    if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
    echo "<input type='hidden' value='".$numrows."' id='cantidad'>";
    $total_pages = ceil($numrows/$per_page);
	$reload = 'productos.php';

    $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");
?>
    
<?php
    if ($numrows>0){
		while($row = mysqli_fetch_array($query)){
?>
            <div class='col-lg-4 col-md-6 col-sm-6'>
                <div class='product__item'>
                    <div class='product__item__pic set-bg' style="background:url('sistema/<?=$row['imagen']?>') no-repeat;background-size:cover;background-position:center;">
                        <ul class='product__item__pic__hover'>
                            <li><a href='producto-detalle.php?id=<?=$row['id']?>'><i class='fa fa-eye'></i></a></li>
                        </ul>
                    </div>
                    <div class='product__item__text'>
                        <h6><a href='producto-detalle.php?id=<?=$row['id']?>'><?=$row['nombre']?></a></h6>
                        <h5><?php echo "$".number_format($row['precio'], 0, ",", ".");?></h5>
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
              <h4>Aviso!!!</h4> No hay productos para mostrar
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
?>