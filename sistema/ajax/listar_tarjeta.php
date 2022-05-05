<?php
	require_once("../php/conexion.php");
	session_start();

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

        $query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));

		$tables="	venta_detalle a left outer join
                    productos b on a.codigo = b.codigo inner join
                    venta c on a.id_venta = c.id_venta";

		$campos="	c.fecha as Fecha,
					b.nombre as Nombre,
					a.cantidad as Cantidad";
		$sWhere=" a.codigo='$query' order by c.fecha desc";

        include 'pagination.php'; 

        $page = getPaginationPos();
		$per_page = 4;
        $adjacents  = 4;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'tarjeta.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Fecha</th>
				  <th>Producto</th>
				  <th>Cantidad</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $row['Fecha'];?></td>
					<td><?php echo $row['Nombre'];?></td>
					<td><?php echo $row['Cantidad'];?></td>
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
		setcookie('page_tarjeta',$_REQUEST['page'],time() + 86400);
		return $_REQUEST['page'];
	} 
	else 
	{
		return ($_COOKIE['page_tarjeta']!='' ? $_COOKIE['page_tarjeta'] : 1);
	}
	
}
?>

<script>
    $(function () {
		$('[data-toggle="modal"]').tooltip()
		$('[data-toggle="toltip"]').tooltip()
    })
</script>