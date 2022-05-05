<?php 
    include('php/funciones.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include('head.php');?>
</head>
<body>
    <div class="container-fluid vh-100">
        <div class="row vh-100 e12">
            <div class="datos_ajax_delete mensaje"></div>
            <div class="col-sm-12 col-12 col-md-6 col-xl">
                <div class="d-flex justify-content-center align-items-center vh-100">
                    <img class="img-fluid w-50 mr-5 pr-5 icono" src="img/logo.png" alt="" style="z-index: 1;">
                    <img class="img-principal img-fluid vh-100" src="img/inicio.jpg" alt="">
                </div>
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-xl d-flex align-items-center">
                <form class="w-75" id="InicioSession">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" name="email_login" placeholder="Ingresar e-mail" id="email" required autofocus>
                        <label for="inputPassword5">Contraseña</label>
                        <input type="password" name="password_login" class="form-control" placeholder="*******" id="pass" required>
                        <a href="" data-toggle="modal" data-target="#exampleModal">Restablecer contraseña</a>
                    </div>
                    <button type="submit" id="login" class="btn btn-primary">Iniciar sesion</button>
                </form>        
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Restablecer contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="w-100" id="Restablecer">
                        <div class="form-group">
                            <label for="correo">Correo electrónico</label>
                            <input type="email" class="form-control" id="correo" name="correo" placeholder="correo@hotmail.com">
                            <small id="emailHelp" class="form-text text-muted">Se enviará un correo con las instrucciones.</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                            <button type="submit" class="btn btn-primary">Restablecer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php')?>
    <script>
        $("#InicioSession").submit(function (event) {
        {
            event.preventDefault();
            var form = $('#InicioSession')[0];
            var data = new FormData(form);

            $.ajax({
                type: "POST",
                url: "ajax/login.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data=='1'){
                        location.href ="productos.php";
                    }
                    else if(data=='2')
                    {
                        location.href ="perfil.php";
                    }
                    else {
                        $(".datos_ajax_delete").show();
                        $(".datos_ajax_delete").html(data);
                        setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 5000);
                        $('#pass').val('');
                    }
                }
            });
            event.preventDefault();
        }
        });

        $('#exampleModal').on('show.bs.modal', function () {
            setTimeout(function (){
                $('#correo').focus();
            }, 500);
        });

        $("#Restablecer").submit(function (event) {
        {
            event.preventDefault();
            var form = $('#Restablecer')[0];
            var data = new FormData(form);

            $.ajax({
                type: "POST",
                url: "ajax/restablecer.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $(".datos_ajax_delete").show();
                    $(".datos_ajax_delete").html(data);
                    setTimeout(function() { $('.datos_ajax_delete').fadeOut('fast'); }, 5000);
                    $('#correo').val('');
                    $('#exampleModal').modal('hide');
                }
            });
            event.preventDefault();
        }
        });
    </script>
</body>
</html>