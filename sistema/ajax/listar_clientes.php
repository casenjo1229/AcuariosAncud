<?php
	require_once("../php/conexion.php");
	session_start();

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));

		$tables="	clientes a left outer join
					tipo_acuarios b on a.id_tipo_acuario = b.id_tipo_acuario";

		$campos="	a.id_cliente as Id,
					a.nombre as Nombre,
					a.rut as Rut,
					a.direccion as Direccion,
					a.descuento as Descuento,
					a.ciudad as Ciudad,
					a.correo as Correo,
					a.telefono as Telefono,
					a.fec_ingreso as Ingreso,
					b.tipo as Tipo";
		$sWhere=" a.nombre LIKE '%".$query."%' or a.rut LIKE '%".$query."%' or a.direccion LIKE '%".$query."%' or a.ciudad LIKE '%".$query."%' or a.correo LIKE '%".$query."%' or a.telefono LIKE '%".$query."%' or b.tipo LIKE '%".$query."%'";
		$sWhere.=" order by a.nombre";

        include 'pagination.php'; 

        $page = getPaginationPos();
		$per_page = 4;
        $adjacents  = 4;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'clientes.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	<table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Nombre</th>
				  <th>Rut</th>
				  <th>Correo</th>
				  <th>Ciudad</th>
				  <th>Dirección</th>
				  <th>Tipo Acuario</th>
				  <th>Descuento</th>
				  <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $row['Nombre'];?></td>
					<td><?php echo $row['Rut'];?></td>
					<td><?php echo $row['Correo'];?></td>
					<td><?php echo $row['Ciudad'];?></td>
					<td><?php echo $row['Direccion'];?></td>
					<!-- <td>+56 9 <?php echo $row['Telefono'];?></td> -->
					<td><?php echo $row['Tipo'];?></td>
					<td><?php echo $row['Descuento'];?></td>
					<td>
						
										<button data-placement="top" title="Editar" type="button" class="btn p-0" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['Id']?>" data-nombre="<?php echo $row['Nombre']?>" data-rut="<?php echo $row['Rut']?>" data-correo="<?php echo $row['Correo']?>" data-ciudad="<?php echo $row['Ciudad']?>" data-direccion="<?php echo $row['Direccion']?>" data-telefono="<?php echo $row['Telefono']?>" data-tipo="<?php echo $row['Tipo']?>" data-descuento="<?php echo $row['Descuento']?>" data-ingreso="<?php echo $row['Ingreso']?>"><img src="img/iconos/editar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						
										<button data-placement="top" title="Eliminar" type="button" class="btn p-0" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['Id']?>" data-nombre="<?php echo $row['Nombre']?>"><img src="img/iconos/eliminar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></button>
						
									<a data-toggle="toltip" data-placement="top" title="Diseño Carnet" href="php/acciones/report/report_carnet.php?id=<?php echo $row['Id'];?>" target="_blank" class="btn p-0" ><img src="img/iconos/imagen.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></a>
									<a data-toggle="toltip" data-placement="top" title="Información Despacho" href='php/acciones/report/report_despacho.php?id=<?php echo $row['Id'];?>' target="_blank" class="btn p-0"><img src="img/iconos/descargar.svg" alt="" class="btn-accion align-self-center" style="width:34px;"></a>
						
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
		setcookie('page_cliente',$_REQUEST['page'],time() + 86400);
		return $_REQUEST['page'];
	} 
	else 
	{
		return ($_COOKIE['page_cliente']!='' ? $_COOKIE['page_cliente'] : 1);
	}
	
}
?>

<script>
    $(function () {
		$('[data-toggle="modal"]').tooltip()
		$('[data-toggle="toltip"]').tooltip()
    })
</script>