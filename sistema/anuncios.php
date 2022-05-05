<?php include('../config.php'); ?>

<?php
    $inactivo = 900;
 
    if(isset($_SESSION['usuario']) ) {
        $vida_session = time() - $_SESSION['tiempo'];
        if($vida_session > $inactivo)
        {
            session_destroy();
            header("Location: ../login.php"); 
        }
    }
    else
    {
      header("Location: ../login.php"); 
    }
 
    $_SESSION['tiempo'] = time();
?>

<!DOCTYPE html>
<html lang="es">

<?php include('header.php') ?>



<body id="page-top">

  <div id="wrapper">
      <?php include('menu.php')?>

        <div class="container-fluid">

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Anuncios</h1>
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#agregar">Publicar</a>
          </div>

          <div class='col-sm-4 pull-right'>
                <div id="custom-search-input">
                    <div class="input-group col-md-7">
                        <input type="text" class="form-control" placeholder="Buscar"  id="q" onkeyup="load(1);"/>
                        <span class="input-group-btn">
                            <button style="height: 38px;line-height: 38px;padding: 0px 10px !important;font-size: 20px;" class="buscar_agenda" type="button" onclick="load(1);">
                                Buscar
                            </button>
                        </span>
                    </div>
                </div>
            </div>

            <div class='clearfix'></div>
            <div id="loader"></div>
            <div id="resultados"></div>
            <div class='outer_div'></div>

            <div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Agregar Anuncio</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="../dashboard/php/add_anuncio.php" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                        <label for="formGroupExampleInput">Título</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Ingrese un título" name="titulo">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Imagen</label>
                        <img src="../<?php echo $imagen;?>" class="form-control" style="height: 250px" id="imagenmuestra">
                      <input type="file" name="imagen" id="imagen"/>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Descripción</label>
                        <textarea placeholder="Ingrese descripción del anuncio" class="form-control" name="descripcion"></textarea>
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
  </div>
</div>

  <?php include('footer.php') ?> 
  
  
  <?php include('js.php')?>
  <script src="js/funciones/anuncios.js"></script>
  
</body>

</html>