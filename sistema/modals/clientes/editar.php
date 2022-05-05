<form id="actualidarDatos">
    <div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cliente </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre">
                                <input type="hidden" id="id" name="id">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Rut:</label>
                                <input type="text" class="form-control" name="rut" id="rut">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Email:</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Ciudad:</label>
                                <input type="text" class="form-control" name="ciudad" id="ciudad">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Dirección:</label>
                                <input type="text" class="form-control" name="direccion" id="direccion">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Teléfono:</label>
                                <input type="text" class="form-control" name="telefono" id="telefono">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Tipo Acuario:</label>
                                <select name="tipo" id="tipo" class="selectpicker form-control" data-live-search="true">
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
                                <input type="number" class="form-control" name="descuento" id="descuento">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Fecha Ingreso:</label>
                                <input type="date" class="form-control" name="fec_ingreso" id="fec_ingreso">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>