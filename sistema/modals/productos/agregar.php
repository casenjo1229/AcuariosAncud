
<form id="guardarDatos">
    <div class="modal fade bd-example-modal-lg" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Producto </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datos_ajax_register"></div>
                    <div class="row e12">
                        <div class="col-6 e5">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Codigo:</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control" name="codigo0" id="codigo0" onkeypress="return teclas(event);" autofocus>
                                    <a href="#" class="btn btn-primary ml-2" id="Crear">Crear</a>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre0" id="nombre0" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Categoria:</label>
                                <select name="categoria0" id="categoria0" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_categorias()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_categoria']."'>".$columna['categoria']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Familia:</label>
                                <select name="familia0" id="familia0" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_familias()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_familia']."'>".$columna['familia']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Ubicación:</label>
                                <select name="ubicacion0" id="ubicacion0" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_ubicaciones()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_ubicacion']."'>".$columna['ubicacion']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Stock:</label>
                                <input type="number" class="form-control" id="stock0" name="stock0" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Precio:</label>
                                <input type="number" class="form-control" id="precio0" name="precio0" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">N° Acuario:</label>
                                <input type="number" class="form-control" id="acuario0" name="acuario0" value="0">
                            </div>
                            <div class="form-group mb-0">
                                <div class="row" id="blo">
                                    <div class="col">
                                        <div class="form-group mb-0">
                                            <label class="col-form-label">Producto Destacado?</label>
                                        </div>
                                        <div class="form-check form-check-inline mb-0">
                                            <input class="form-check-input" type="radio" id="inlineCheckbox1" value="0" name="radio" style="margin-top:10px !important;">
                                            <label class="form-check-label" for="inlineCheckbox1">NO</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="radio" id="inlineCheckbox2" value="1" name="radio" style="margin-top:10px !important;">
                                            <label class="form-check-label" for="inlineCheckbox2">SI</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 e5">
                            <div class="col-lg-12 d-flex justify-content-center mt-3" style="height:300px;">
                                <img src="" alt="" class="pt-3 rounded-circle position-absolute" id="imagenmuestra1" style="object-fit:cover;width:280px;height:300px;">
                                <div class="image-upload">
                                    <label for="file-input">
                                        <img src="img/iconos/camara.svg"/> 
                                    </label>

                                    <input type="file" name="imagen" id="file-input"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <output id="list"></output>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

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
                    $('#imagenmuestra1').attr('src', e.target.result);
                };
            })(f);

            reader.readAsDataURL(f);
        }
    }

    document.getElementById('file-input').addEventListener('change', handleFileSelect, false);
</script>
<script>
    $('#Crear').click(function(e){ 
        var query = $('#familia0').val();
        var parametros = {'query':query};
        $.ajax({
            url: "ajax/consulta_codigo.php",
            data: parametros,
            dataType: "json",
            success: function (data) {
                $('#codigo0').val(data[0]);
                
            }
        });
    });
</script>