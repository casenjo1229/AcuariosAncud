<?php
    session_start();
	require_once("../php/conexion.php");

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){

        $desde = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['desde'], ENT_QUOTES)));
        $hasta = mysqli_real_escape_string(conectar(),(strip_tags($_REQUEST['hasta'], ENT_QUOTES)));

        if($desde == $hasta)
        {
            $_SESSION['fec_desde'] = $desde;
            $_SESSION['fec_hasta'] = strtotime($desde."+ 1 days");
            $_SESSION['fec_hasta'] = date("Y-m-d",$_SESSION['fec_hasta']);
        }
        else
        {
            $_SESSION['fec_desde'] = $desde;
            $_SESSION['fec_hasta'] = $hasta;
        }

        $tables="   venta a inner join 
                    tipo_pago b on a.id_tipo_pago = b.id_tipo_pago inner join
                    usuarios c on a.id_usuario_registro = c.id_usuario inner join
                    clientes d on a.id_usuario = d.id_cliente";
        $campos="   a.id_venta as Id,
                    a.fecha as Fecha,
                    b.tipo  as TipoPago,
                    c.nombre as Usuario,
                    d.nombre as Cliente,
                    a.subtotal as SubTotal,
                    a.tipo_descuento as TipoDescuento,
                    a.descuento as Descuento,
                    a.total as Total,
                    a.paga as Paga,
                    a.vuelto as Vuelto";

		$sWhere=" CONVERT(a.fecha,date) between '".$desde."' and '".$hasta."'";
		$sWhere.=" order by a.id_venta";

        include 'pagination.php'; 

        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5;
        $adjacents  = 5;
        $offset = ($page - 1) * $per_page;
        $count_query   = mysqli_query(conectar(),"SELECT count(*) AS numrows FROM $tables where $sWhere");
        if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
        $total_pages = ceil($numrows/$per_page);
		$reload = 'reportes.php';

        $query = mysqli_query(conectar(),"SELECT $campos from $tables where $sWhere Limit $offset,$per_page");

        if ($numrows>0){
?>
    <div class="row espac">
        <div class="col-12 col-lg-12 p-0">
            <div class="table-responsive">
	            <table class="table">
                    <thead class="thead-light">
                        <tr>
                        <th>N° de venta</th>
                        <th>Fecha de venta</th>
                        <th>Vendedor</th>
                        <th>Cliente</th>
                        <th>Tipo Pago</th>
                        <th>Total</th>
                        <th>Resumen</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php
                    while($row = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $row['Id'];?></td>
                            <td><?php echo $row['Fecha'];?></td>
                            <td><?php echo $row['Usuario'];?></td>
                            <td><?php echo $row['Cliente'];?></td>
                            <td><?php echo $row['TipoPago'];?></td>
                            <td><?php echo "$".number_format($row['Total'], 0, ",", ".");?></td>
                            <td>
                                <button class="btn btn-primary badge-pill green" data-toggle="modal" data-target="#resumen" data-id="<?php echo $row['Id']?>" data-fecha="<?php echo $row['Fecha']?>" data-subtotal="<?php echo "$".number_format($row['SubTotal'],0, ",", ".")?>" data-descuento="<?php echo "$".number_format($row['Descuento'],0, ",", ".")?>" data-total="<?php echo "$".number_format($row['Total'],0, ",", ".")?>"><img src="img/iconos/periodico.png" alt="" class="btn-accion align-self-center" style="width:17px;"></button>
                                <button class="btn btn-primary badge-pill" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['Id']?>"><img src="img/iconos/cruz.png" alt="" class="btn-accion align-self-center" style="width:17px;"></button>
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

		  