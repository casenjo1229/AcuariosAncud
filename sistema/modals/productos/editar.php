
<form id="actualidarDatos">
    <div class="modal fade bd-example-modal-lg" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar </h5>
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
                                <input type="text" class="form-control" name="codigo" id="codigo" required>
                                <input type="hidden" name="id" id="id">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Categoria:</label>
                                <select name="categoria" id="categoria" class="selectpicker form-control" data-live-search="true">
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
                                <select name="familia" id="familia" class="selectpicker form-control" data-live-search="true">
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
                                <select name="ubicacion" id="ubicacion" class="selectpicker form-control" data-live-search="true">
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
                                <input type="number" class="form-control" id="stock" name="stock" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Precio:</label>
                                <input type="number" class="form-control" id="precio" name="precio" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">N° Acuario:</label>
                                <input type="number" class="form-control" id="acuario" name="acuario">
                            </div>
                            <div class="form-group mb-0">
                                <div class="row" id="blo">
                                    <div class="col">
                                        <div class="form-group mb-0">
                                            <label class="col-form-label">Producto Destacado?</label>
                                        </div>
                                        <div class="form-check form-check-inline mb-0">
                                            <input class="form-check-input" type="radio" id="inlineCheckbox11" value="0" name="radio1" style="margin-top:10px !important;">
                                            <label class="form-check-label" for="inlineCheckbox1">NO</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="radio" id="inlineCheckbox22" value="1" name="radio1" style="margin-top:10px !important;">
                                            <label class="form-check-label" for="inlineCheckbox2">SI</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 e5">
                            <div class="col-lg-12 d-flex justify-content-center mt-3" style="height:300px;">
                                <img src="" alt="" class="pt-3 rounded-circle position-absolute" id="img" style="object-fit:cover;width:280px;height:300px;">
                                <div class="image-upload">
                                    <label for="img-edit">
                                        <img src="img/iconos/camara.svg"/> 
                                    </label>

                                    <input type="file" name="imagen" id="img-edit"/>
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