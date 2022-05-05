<form id="guardarVenta">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">SubTotal de </label>
                        <div class="col-sm-8">
                            <input class="form-control for-mod" type="text" id="subtotal" name="subtotal" onkeyup="miles(this)" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label for-mod">Tipo descuento</label>
                        <div class="col-sm-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="por" value="porcentaje" name="tipo_descuento">
                                <label class="form-check-label" for="inlineRadio1">%</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="pes" value="peso" name="tipo_descuento">
                                <label class="form-check-label" for="inlineRadio2">$</label>
                            </div>
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Descuento</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="descuento" name="descuento" onkeyup="format(this)" onchange="format(this)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Tipo de pago</label>
                        <div class="col-sm-8">
                            <select class="form-control my-1 mr-sm-2" id="tipo_pago" name="tipo_pago" onchange="val()">
                                <?php
                                    $consulta = "call consulta_tipo_pago()";
                                    $resultado = mysqli_query(conectar(), $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                                    while ($columna = mysqli_fetch_array( $resultado ))
                                    { 
                                        echo    "<option value='".$columna['id_tipo_pago']."'>".$columna['tipo']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Total </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control for-mod" id="total" name="total" onkeyup="miles(this)" readonly>
                            <input type="hidden" id="totalhidden" name="totalhidden">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Paga </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control for-mod" id="paga" name="paga" onkeyup="miles(this)" onchange="miles(this)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Vuelto </label>
                        <div class="col-sm-8">
                            <input class="form-control for-mod" type="text" id="vuelto" name="vuelto" onchange="miles(this)" readonly>
                        </div>
                    </div>
                    <div class="form-group row d-none" id="ab">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Abono </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control for-mod" id="abono" name="abono" onkeyup="miles(this)" onchange="miles(this)">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Pagar</button>
                </div>
            </div>
        </div>
    </div>
</form>