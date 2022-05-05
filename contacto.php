<?php 
    session_start();
    require_once("./php/conexion.php");
    $_SESSION['pagina'] = "contacto";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Acuarios Ancud | Contacto</title>
    <?php include('head.php')?>
    <script>
        $(document).ready(function(){
            $("#reloadCaptcha").click(function(){
                var captchaImage = $('#captcha').attr('src');	
                captchaImage = captchaImage.substring(0,captchaImage.lastIndexOf("?"));
                captchaImage = captchaImage+"?rand="+Math.random()*1000;
                $('#captcha').attr('src', captchaImage);
            });
        });
    </script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php include('nav.php')?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Contacta con nosotros</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Inicio</a>
                            <span>Contacto</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Teléfono</h4>
                        <p>+56 9 39110640</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Dirección</h4>
                        <p>Eleuterio Ramirez 352 5710000 Ancud, Chile</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Tiempo abierto</h4>
                        <p>14:00 pm a 20:00 pm</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>tiendacuarios@acuariosancud.cl</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2971.082069731775!2d-73.82776038435587!3d-41.86958068451983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x96228d58df83ffff%3A0x426ff375b19f7ebe!2sEleuterio%20Ram%C3%ADrez%20352%2C%20Ancud%2C%20Los%20Lagos!5e0!3m2!1ses-419!2scl!4v1615183662425!5m2!1ses-419!2scl"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
        </iframe>
    </div>
    <!-- Map End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Deja un mensaje</h2>
                    </div>
                </div>
            </div>
            <form id="Enviar">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Nombre" name="nombre" id="nombre" required>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="email" placeholder="Email" name="email" id="email" required>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Teléfono" name="telefono" id="telefono" required>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Ciudad" name="ciudad" id="ciudad" required>
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea placeholder="Mensaje..." name="mensaje" id="mensaje" required></textarea>
                        <div class="col-lg-12 d-flex mb-3 p-0">
                            <div class="input_field">
                                <input type="text" name="securityCode" id="securityCode" class="form-control" placeholder="Código de seguridad" required="">
                            </div>
                            <div class="d-flex justify-content-center" style="align-items: center;height: 50px;margin-left:20px;">								
                                <label class="p-0"><img style="border: 1px solid #D3D0D0" src="get_captcha.php?rand=259517672" id="captcha" alt="captcha"></label>
                                <div class="pl-4"><br>
                                    <a href="javascript:void(0)" id="reloadCaptcha" style="color: #000;">Recargar codigo</a>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="site-btn">Enviar mensaje</button>
                    </div>
                    <div class="col-lg-12 mt-4 mensaje"></div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->

    <?php include('footer.php')?>
    <script>
        $( "#Search" ).submit(function( event ) {
            var buscar = $('#buscar').val();
            console.log(buscar);
            location.href='productos.php?id="'+ buscar +'"';
            event.preventDefault();
        });
    </script>
    <script>
        $("#Enviar").submit(function (event) {
            event.preventDefault();
            var form = $('#Enviar')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "ajax/correo.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $(".mensaje").html(data);
                    $('#nombre').val("");
                    $('#email').val("");
                    $('#mensaje').val("");
                    $('#ciudad').val("");
                    $('#telefono').val("");
                    $('#securityCode').val('');
                    setTimeout(function() { $('.mensaje').fadeOut('fast'); }, 4000);
                    var captchaImage = $('#captcha').attr('src');	
                    captchaImage = captchaImage.substring(0,captchaImage.lastIndexOf("?"));
                    captchaImage = captchaImage+"?rand="+Math.random()*1000;
                    $('#captcha').attr('src', captchaImage);
                }
            });
            event.preventDefault();
        });
    </script>
</body>

</html>