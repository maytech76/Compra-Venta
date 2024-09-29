<div id="Modalcliente" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <!-- TODO:Formulario de Mantenimiento -->
            <form method="post" id="mantenimiento_form">
                <div class="modal-body">
                    <input type="hidden" name="cli_id" id="cli_id"/>

                    <div class="row gy-2">
                        <div class="col-md-12">
                            

                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nombre:</span>
                                <input type="text" id="cli_nom" name="cli_nom" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>

                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Rut  :</span>
                                <input type="text" id="cli_ruc" name="cli_ruc" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>

                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Telefono :</span>
                                <input type="text" id="cli_telf" name="cli_telf" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>

                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Correo Eléctronico:</span>
                                <input type="text" id="cli_correo" name="cli_correo" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>

                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Dirección :</span>
                                <input type="text" id="cli_direcc" name="cli_direcc" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>

                           


                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary ">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>