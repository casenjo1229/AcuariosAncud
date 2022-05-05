<?php
	require_once("../php/conexion.php");

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

		$query = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['query'], ENT_QUOTES)));

		$tables="productos";
		$campos="*";
		$sWhere=" nombre LIKE '%".$query."%' or codigo LIKE '%".$query."%'";
		$sWhere.=" order by nombre";

        include 'pagination_buscar.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5;
        $adjacents  = 5;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'checkout.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
	    <table class="table">
			  <thead class="thead-light">
				<tr>
				  <th>Código</th>
				  <th>Nombre</th>
				  <th>Stock</th>
				  <th>Precio Venta</th>
                  <th>Acción</th>
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $row['codigo'];?></td>
					<td><?php echo $row['nombre'];?></td>
					<td><?php echo $row['stock'];?></td>
					<td><?php echo "$".number_format($row['precio'], 0, ",", ".");?></td>
					<td>
						<?php echo "
						<form id='AgregarProducto".$row['id_producto']."'>
							<input type='hidden' value=".$row['id_producto']." id='id_producto' name='id_producto'>
							<button type='submit' class='btn btn-primary badge-pill'><i class='fas fa-cart-plus'></i></button>
						</form>

						<script>
							$('#AgregarProducto".$row['id_producto']."').submit(function (event) {
							event.preventDefault();
							var form = $('#AgregarProducto".$row['id_producto']."')[0];
							var data = new FormData(form);

							$.ajax({
								type: 'POST',
								url: 'php/acciones/add/add_producto_temporal.php',
								data: data,
								processData: false,
								contentType: false,
								cache: false,
								success: function (data) {
									$('.error').show();
									$('.error').html(data);
									setTimeout(function() { $('.error').fadeOut('fast'); }, 4000);
									load(1);
									total(1);
									$('#exampleModal1').modal('hide');
								}
							});
							event.preventDefault();
						});
						</script>";
						?>
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

		  