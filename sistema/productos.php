<?php 
    include('php/funciones.php');
    $_SESSION['token'] =  $_SERVER["PHP_SELF"];
?>

<?php
    $inactivo = 1800;
 
    if(isset($_SESSION['id_user']) ) {
        $vida_session = time() - $_SESSION['tiempo'];
        if($vida_session > $inactivo)
        {
            session_destroy();
            echo "<script>location.href='index.php';</script>";
            die();
        }
        else
        {
            $_SESSION['tiempo'] = time();
        }
    }
    else
    {
        echo "<script>location.href='index.php';</script>";
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('head.php');?>
    <script src="plugin/tinymce/jquery.min.js"></script>
    <script src="plugin/tinymce/tinymce.min.js"></script>
    <script src="plugin/tinymce/init-tinymce.js"></script>
</head>
    
<body>
    <?php include("modals/productos/imagen.php");?>
    <?php include("modals/productos/agregar.php");?>
    <?php include("modals/productos/editar.php");?>
    <?php include("modals/productos/eliminar.php");?>
    <?php include("modals/productos/detalle.php");?>
    <?php include("modals/productos/exportar.php");?>
    <?php include('nav.php');?>

    <div id="content">
        <div class="container-fluid">
            <div class="row justify-content-around movil">
                <div class="datos">
                    <p class="inter">Productos Ingresados</p> 
                    <span class="detalles pro-stock"></span>
                </div>
                <div class="datos">
                    <p class="inter">Stock Valorizado</p> 
                    <span class="detalles pro-total"></span>
                </div>
                <div class="datos">
                    <p class="inter">...</p> 
                    <span class="detalles-down"></span>
                </div>
            </div>

            <div class="container-fluid d-flex justify-content-between mt-5 e3">
                <div class="row w-50 e4">
                    <div class="col-xl-8 col-8 p-0 e5">
                        <input class="form-control" id="q" onkeyup="load(1);" type="text" placeholder="Buscar.." autofocus/>
                    </div>
                </div>
                <div class="row d-flex e6">
                    <button class="btn btn-primary agregar mr-3" id="actualizar">
                        <img src="img/iconos/actualizar.svg" alt="" style="width:34px; margin-right: 14px;"> Actualizar
                    </button>

                    <?php if(consulta_administrador($_SESSION['id_user']) == 1){?>
                        <a href='#' data-toggle='modal' data-target='#exportar' class="btn btn-primary agregar mr-3"><img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Exportar</a>
                    <?php }else{?>   
                        <a href="php/acciones/report/report_productos_pdf.php" target="_blank" class="btn btn-primary agregar mr-3">
                            <img src="img/iconos/pdf.svg" alt="" style="width:34px; margin-right: 14px;"> Exportar
                        </a>
                    <?php }?> 

                    
                        <button class="btn btn-primary agregar" data-toggle="modal" data-target="#dataRegister">
                            <img src="img/iconos/agregar.svg" alt="" style="width:34px; margin-right: 14px;"> Agregar
                        </button>
                    
                </div>
            </div>

            <div id="loader" class="text-center"> <img src="img/loader.gif"></div>
            <div class="datos_ajax_delete mt-3"></div>
            <div class='outer_div table-responsive'></div>
        </div>    
    </div>
    
    <?php include('footer.php');?>
    
    <script src="js/funciones/productos.js"></script>
    
    <script>
		$(document).ready(function(){
            load(1);
            consulta_cuadros(1);
		});
	</script>
    <script>
        $( "#actualizar" ).click(function() {
            load();
            consulta_cuadros(1);
        });
    </script>

    <script>
        function handleFileSelect(evt) {
            var files = evt.target.files;
            for (var i = 0, f; f = files[i]; i++) {
                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();

                reader.onload = (function(theFile) {
                    return function(e) {
                        $('#img').attr('src', e.target.result);
                    };
                })(f);
                reader.readAsDataURL(f);
            }
        }

        document.getElementById('img-edit').addEventListener('change', handleFileSelect, false);
    
    </script>
</body>
</html>