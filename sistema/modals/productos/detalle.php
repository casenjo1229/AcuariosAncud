
<form id="guardarDetalle">
    <div class="modal fade bd-example-modal-lg" id="dataDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="max-width:75% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalle Producto </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="datos_ajax_register"></div>
                    <div class="row e12">
                        <div class="col-5 e5">
                            <div class="form-group mb-0">
                                <label class="col-form-label">Detalle:</label>
                                <textarea name="detalle" id="detalle"></textarea>
                                <input type="hidden" name="id" id="id">
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Titulo:</label>
                                <input type="text" class="form-control" name="titulo" id="titulo" required>
                            </div>
                            <div class="form-group mb-0">
                                <label class="col-form-label">Descripción:</label>
                                <textarea name="descripcion" id="descripcion"></textarea>
                            </div>
                        </div>
                        <div class="col-7 e5 d-flex align-items-center">
                            <img class="w-100" src="img/modelo.png" alt="">
                        </div>
                    </div>
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
    tinymce.init({
        selector: 'textarea#detalle',
        plugins: "paste",
        paste_as_text: true,
        menubar: false
   });
 </script>

<script>
    tinymce.init({
        selector: 'textarea#descripcion',
        plugins: "paste",
        paste_as_text: true,
        menubar: false
   });
 </script>