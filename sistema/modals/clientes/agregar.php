<form id="guardarDatos">
    <div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datos_ajax_register"></div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre0" id="nombre0">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Rut:</label>
                                <input type="text" class="form-control" name="rut0" id="rut0">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Email:</label>
                                <input type="email" class="form-control" name="email0" id="email0">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Ciudad:</label>
                                <input type="text" class="form-control" name="ciudad0" id="ciudad0">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Dirección:</label>
                                <input type="text" class="form-control" name="direccion0" id="direccion0">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Teléfono:</label>
                                <input type="text" class="form-control" name="telefono0" id="telefono0">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Tipo Acuario:</label>
                                <select name="tipo0" id="tipo0" class="selectpicker form-control" data-live-search="true">
                                    <?php 
                                        $consulta = "call consulta_tipo_acuario()";
                                        $resultado = mysqli_query(conectar(), $consulta );
                                        while ($columna = mysqli_fetch_array( $resultado ))
                                        { 
                                            echo    "<option value='".$columna['id_tipo_acuario']."'>".$columna['tipo']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Descuento (%):</label>
                                <input type="number" class="form-control" name="descuento0" id="descuento0">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fecha Ingreso:</label>
                                <input type="date" class="form-control" name="fec_ingreso0" id="fec_ingreso0" value="<?php echo date("Y-m-d");?>">
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