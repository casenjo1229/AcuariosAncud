<?php
	require_once("../php/conexion.php");
	session_start();

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));

		$tables="	productos a left outer join 
					ubicaciones b on a.id_ubicacion = b.id_ubicacion left outer join
					familias c on a.id_familia = c.id_familia left outer join
					detalle_producto d on a.id_producto = d.id_producto left outer join
					categorias e on a.id_categoria = e.id_categoria";
		$campos="	a.id_producto as id, 
					a.codigo as codigo, 
					a.nombre as nombre, 
					b.ubicacion as ubicacion, 
					a.id_ubicacion as id_ubicacion,
					a.id_categoria as id_categoria,
					a.id_familia as id_familia,
					a.num_acuario as acuario,
					a.destacado as destacado,
					a.stock as stock, 
					a.imagen as imagen, 
					a.precio as precio,
					c.familia as familia,
					d.detalle as detalle,
					d.titulo as titulo,
					d.descripcion as descripcion,
					e.categoria as categoria";
		$sWhere=" a.codigo LIKE '%".$query."%' or a.nombre LIKE '%".$query."%' or b.ubicacion LIKE '%".$query."%' or c.familia LIKE '%".$query."%'";
		$sWhere.=" order by a.id_producto desc";

        include 'pagination.php'; 

        $page = getPaginationPos();
		$per_page = 8;
        $adjacents  = 8;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'productos.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Codigo</th>
				  <th>Nombre</th>
				  <th>Familia</th>
				  <th>Stock</th>
				  <th>Precio</th>
				  <th>Ubicación</th>
				  <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $row['codigo'];?></td>
					<?php
                        if(empty($row['imagen']))
                        {
                            echo "<td>".$row['nombre']."</td>";
                        }
                        else{
					        echo "<td><a href='#' data-toggle='modal' data-target='#Imagen' data-imagen='".$row['imagen']."' data-nombre='".$row['nombre']."' data-precio='$".number_format($row['precio'], 0, ",", ".")."' data-categoria='".$row['categoria']."' data-detalle='".$row['detalle']."' data-titulo='".$row['titulo']."' data-descripcion='$row[descripcion]'>".$row['nombre']."</a></td>";
                        }
                    ?>

					<td><?php echo $row['familia'];?></td>
					<td><?php echo $row['stock'];?></td>
					<td><?php echo "$".number_format($row['precio'], 0, ",", ".");?></td>
					<td><?php echo $row['ubicacion'];?></td>
					<td>
						
									<button data-placement="top" title="Editar" type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id']?>" data-codigo="<?php echo $row['codigo'];?>" data-nombre="<?php echo $row['nombre']?>" data-categoria="<?php echo $row['id_categoria']?>" data-familia="<?php echo $row['id_familia'];?>" data-ubicacion="<?php echo $row['id_ubicacion'];?>" data-stock="<?php echo $row['stock'];?>" data-precio="<?php echo $row['precio'];?>" data-acuario="<?php echo $row['acuario'];?>" data-destacado="<?php echo $row['destacado'];?>" data-imagen="<?php echo $row['imagen']?>" data-img="<?php echo "img".$row['id']?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
									<button data-placement="top" title="Información Adicional" type="button" class="btn p-0" data-toggle="modal" data-target="#dataDetalle" data-id="<?php echo $row['id']?>" data-detalle="<?php echo $row['detalle'];?>" data-titulo="<?php echo $row['titulo'];?>" data-descripcion='<?php echo $row['descripcion'];?>'><img src="img/iconos/ver.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						
									<button data-placement="top" title="Eliminar" type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>" data-nombre="<?php echo $row['nombre']?>"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		<div class="table-pagination pull-right">
			<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
		</div>
		
			<?php
			
		} else {
			?>
			<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
			<?php
		}
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

<script>
    $(function () {
        $('[data-toggle="modal"]').tooltip()
    })
</script>

