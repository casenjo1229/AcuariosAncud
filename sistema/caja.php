<?php 
    include('php/funciones.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('head.php');?>
</head>
<body>
    <?php include("modals/caja/agregar.php");?>
    <?php include("modals/caja/eliminar.php");?>
    <?php include('nav.php');?>
    

    <div class="container-fluid">
        <h1>Caja Chica</h1>
        <div class="row d-flex justify-content-between align-items-end espac">
            <div class="col-12 col-lg-5 desta">
                <form class="mt-4 mb-3">
                    <div class="form-group d-flex">
                        <label>Fecha </label>
                        <input type="date" id="fec" value="<?php echo date("Y-m-d");?>" class="form-control fec" style="margin-left: 23px;" onchange="load(1);">
                    </div>
                </form>
            </div>
            <button class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister">
                <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar
            </button>
        </div>

        <div class="datos_ajax_delete mt-3"></div><!-- Datos ajax Final -->
        <div class='outer_div'></div>
        
    </div>
    <?php include('footer.php');?>
    <script src="js/funciones/caja.js"></script>
    <script>
        $("#buscar").click( function()
        {
            load(1);
        }
        );
    </script>
    <script>
		$(document).ready(function(){
			load(1);
		});
	</script>
</body>
</html>