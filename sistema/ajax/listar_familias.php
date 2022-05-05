<?php
	require_once("../php/conexion.php");
	session_start();

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));

		$tables="	familias a";

		$campos="	a.id_familia as Id,
					a.familia as familia,
					a.nombre_corto as nombre_corto";
		$sWhere=" a.familia LIKE '%".$query."%' or a.nombre_corto LIKE '%".$query."%'";
		$sWhere.=" order by a.id_familia desc";

        include 'pagination.php'; 

        $page = getPaginationPos();
		$per_page = 4;
        $adjacents  = 4;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'familias.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Familia</th>
				  <th>Nombre Corto</th>
				  <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $row['familia'];?></td>
					<td><?php echo $row['nombre_corto'];?></td>
					<td>
						<button data-placement="top" title="Editar" type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['Id']?>" data-familia="<?php echo $row['familia']?>" data-nombre_corto="<?php echo $row['nombre_corto']?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						<button data-placement="top" title="Eliminar" type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['Id']?>" data-familia="<?php echo $row['familia']?>"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
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
		setcookie('page_familia',$_REQUEST['page'],time() + 86400);
		return $_REQUEST['page'];
	} 
	else 
	{
		return ($_COOKIE['page_familia']!='' ? $_COOKIE['page_familia'] : 1);
	}
	
}
?>

<script>
    $(function () {
		$('[data-toggle="modal"]').tooltip()
		$('[data-toggle="toltip"]').tooltip()
    })
</script>