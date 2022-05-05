<div class="modal fade bd-example-modal-lg" id="Imagen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Previsualización de producto</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="col-12 e5">
                    <section class="d-flex flex-column w-100">
                        <div class="d-flex">
                            <img class="w-50" id="imagen" name="imagen1" src="" alt="" style="padding:30px;">
                            <div class="d-flex flex-column">
                                <h3 style="font-family: 'Heebo',sans-serif; font-size:20px;" id="nombre"></h3>
                                <span style="font-weight: bold;color: #0B959C;" id="precio"></span>
                                <span style="color: #555;font-size: 14px;">Categoria: <span style="color: #0B959C;" id="categoria"></span></span>
                                <span style="color: #555;font-size: 14px;">Disponibilidad: En tienda</span>
                                <div class="mt-2" id="detalle_prev"></div>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <h3 style="font-family: 'Heebo',sans-serif; font-size:20px;" id="titulo"></h3>
                            <div class="d-flex flex-wrap" id="descripcion"></div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>

