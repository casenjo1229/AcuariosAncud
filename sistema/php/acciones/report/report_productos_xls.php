<?php
    session_start();
    require_once("../../conexion.php");

    echo pack("CCC",0xef,0xbb,0xbf);

    header("Content-type: application/vnd.ms-excel;charset=utf-8");
    header("Content-Disposition: attachment; filename=productos.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

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
                
    $query = mysqli_query(conectar(),"SELECT $campos from $tables");
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
				</tr>
			</thead>
			<tbody id="myTable">
			<?php
			while($row = mysqli_fetch_array($query)){
				?>
				<tr>
					<td style="mso-number-format:'@'"><?php echo $row['codigo'];?></td>
                    <td><?php echo $row['nombre'];?></td>

					<td><?php echo $row['familia'];?></td>
					<td><?php echo $row['stock'];?></td>
					<td><?php echo $row['precio'];?></td>
					<td><?php echo $row['ubicacion'];?></td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>