<?php
    session_start();
	require_once("../php/conexion.php");

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

        $fecha = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['fecha'], ENT_QUOTES)));

        $tables="   caja a inner join 
                    usuarios b on a.id_usuario_registro = b.id_usuario";
        $campos="   a.id_caja as Id,
                    a.fecha as Fecha,
                    a.total as Total,
                    b.nombre as Usuario";

		$sWhere=" a.fecha = '".$fecha."'";
		$sWhere.=" order by a.id_caja";

        include 'pagination.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5;
        $adjacents  = 5;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'caja.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
    <div class="row espac">
        <div class="col-12 col-lg-12 p-0">
            <div class="table-responsive">
	            <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>Apertura</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php
                    while($row = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo "$".number_format($row['Total'], 0, ",", ".");?></td>
                            <td><?php echo $row['Usuario'];?></td>
                            <td>
                                <button class="btn btn-primary badge-pill" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['Id']?>" data-total="<?php echo $row['Total']?>"><img src="img/iconos/cruz.png" alt="" class="btn-accion align-self-center" style="width:17px;"></button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
		        </table>
            </div>
        </div>
    </div>

	<div class="table-pagination pull-right">
		<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
	</div>
		
	<?php
			
    } 
        else {
			?>
			<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
			<?php
		}
	}
?>

		  