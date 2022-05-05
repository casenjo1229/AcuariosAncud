<?php

	require_once ("../conexion.php");

	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables="anuncios";
	$campos="*";
	$sWhere=" titulo like '%".$query."%'";
	$sWhere.=" order by fecha desc";

	include 'pagination.php'; 

	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); 
	$adjacents  = 4;
	$offset = ($page - 1) * $per_page;
	$acentos = $con->query("SET NAMES 'utf8'");
	$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM $tables where $sWhere ");
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($con);}
	$total_pages = ceil($numrows/$per_page);

	$query = mysqli_query($con,"call consulta_anuncios($offset,$per_page);");

	if ($numrows>0){
		
	?>
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Titulo</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$titulo=$row['Titulo'];
							$id=$row['Id'];
							$descripcion=$row['Descripcion'];
							$imagen=$row['Imagen'];
							$fecha=$row['Fecha'];
							$usuario=$row['Usuario'];
							$finales++;
						?>	
						<tr class="<?php echo $text_class;?>">
							<td><?php echo $titulo;?></td>
							<td><a href="../<?php echo $imagen;?>" data-toggle="modal" data-target="#imagen<?php echo $id;?>">Ver Imagen</a></td>

							<div class="modal fade" id="imagen<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo;?></h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        	<img src="<?php echo "../".$imagen;?>" width="100%" style="border-radius: 10px;"/>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
							      </div>
							    </div>
							  </div>
							</div>

							<td><?php echo $fecha;?></td>
							<td><?php echo $usuario;?></td>
							<td><a href="" data-toggle="modal" data-target="#registro<?php echo $id;?>" style="padding-right: 20px;">Editar</a>
								<a href="" data-toggle="modal" data-target="#borrar<?php echo $id;?>">Eiminar</a>

							<div class="modal fade" id="registro<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					          <div class="modal-dialog" role="document">
					            <div class="modal-content">
					              <div class="modal-header">
					                <h5 class="modal-title" id="exampleModalLabel">Modificar Anuncio</h5>
					                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                  <span aria-hidden="true">&times;</span>
					                </button>
					              </div>
					              <div class="modal-body">
					              	<form action="../dashboard/php/mod_anuncio.php" method="post" enctype="multipart/form-data">
								          <div class="form-group">
										    <label for="formGroupExampleInput">Título</label>
										    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese un título" name="titulo" value="<?php echo $titulo?>">
										  </div>
										  <div class="form-group">
										    <label for="formGroupExampleInput">Imagen</label>
										    <img src="../<?php echo $imagen;?>" class="form-control" style="height: 250px" id="imagenmuestra">
											<input type="file" name="imagen" id="imagen"/>
										  </div>
										  <div class="form-group">
										    <label for="formGroupExampleInput2">Descripción</label>
										    <textarea placeholder="Ingrese descripción del anuncio" class="form-control" name="descripcion"><?php echo $descripcion;?></textarea>
										    <input type="text" name="id" value="<?php echo $id;?>" style="display: none">
										  </div>
						              	
						               <div class="modal-footer">
								            <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
								            <button type="submit" class="btn btn-primary">Guardar</button>
								       </div>
							      </form>
							      </div>
					          </div>
					        </div>
					       </div>

					       <div class="modal fade" id="borrar<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							    <div class="modal-dialog" role="document">
							      <div class="modal-content">
							        <div class="modal-header">
							          <h5 class="modal-title" id="exampleModalLabel">¿Esta seguro?</h5>
							          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
							            <span aria-hidden="true">×</span>
							          </button>
							        </div>
							        <div class="modal-body">Desea eliminar el anuncio <b><?php echo $titulo;?></b>.</div>
							        <div class="modal-footer">
							          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
							          <a class="btn btn-primary" href="../dashboard/php/del_anuncio.php?id=<?php echo $id;?>">Borrar</a>
							        </div>
							      </div>
							    </div>
							</div>
							</td>
						</tr>
						<?php }?>
						<thead>
							<tr>
								<td colspan='7'> 
									<?php 
										$inicios=$offset+1;
										$finales+=$inicios -1;
										echo "Mostrando $inicios al $finales de $numrows registros";
										echo paginate( $page, $total_pages, $adjacents);
									?>
								</td>
							</tr>
						</thead>
				</tbody>			
			</table>	
	  		<script type="text/javascript">
			function readURL(input) {
			  if (input.files && input.files[0]) {
			    var reader = new FileReader();
			    reader.onload = function(e) {
			      $('#imagenmuestra').attr('src', e.target.result);
			    }
			    reader.readAsDataURL(input.files[0]);
			  }
			}

			$("#imagen").change(function() {
			  readURL(this);
			});
		</script>	
	<?php	
	}	
}
?>          
		  
