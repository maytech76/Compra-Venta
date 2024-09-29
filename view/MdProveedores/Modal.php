<div id="Modalproveedor" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <!-- TODO:Formulario de Mantenimiento -->
            <form method="post" id="mantenimiento_form">
                <div class="modal-body">
                    <input type="hidden" name="prov_id" id="prov_id"/>

                    <div class="row gy-2">
                        <div class="col-md-12">
                            

                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nombre:</span>
                                <input type="text" id="prov_nom" name="prov_nom" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>

                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Rut  :</span>
                                <input type="text" id="prov_ruc" name="prov_ruc" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>

                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Telefono :</span>
                                <input type="text" id="prov_telf" name="prov_telf" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>


                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Dirección :</span>
                                <input type="text" id="prov_direcc" name="prov_direcc" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>

                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Correo Eléctronico:</span>
                                <input type="text" id="prov_correo" name="prov_correo" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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