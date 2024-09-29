<div id="Modalvendedor" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <!-- TODO:Formulario de Mantenimiento -->
            <form method="post" id="mantenimiento_form">
                <div class="modal-body">
                    <input type="hidden" name="vend_id" id="vend_id" />

                    <div class="row gy-2">
                        <div class="col-md-12">

                             <!-- IMAGEN-PREVIA -->
                            <div class="row gy-2">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <a id="btnremovephoto" class="btn btn-danger btn-icon waves-effect waves-light btn-sm"><i class="ri-delete-bin-5-line"></i></a>
                                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                            <span id="pre_imagen"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <br>

                            <div class="row my-3">
                                <div class="col-md-12">
                                    <div>
                                        <input type="file" class="form-control" id="vend_img" name="vend_img" />
                                    </div>
                                </div>
                            </div>
                            <!-- FINAL SESION DE IMAGEN -->


                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nombre:</span>
                                <input type="text" id="vend_nom" name="vend_nom" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>

                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Rut :</span>
                                <input type="text" id="vend_rut" name="vend_rut" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>

                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Telefono :</span>
                                <input type="text" id="vend_telef" name="vend_telef" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>

                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Correo Eléctronico:</span>
                                <input type="text" id="vend_correo" name="vend_correo" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>

                            <div class="input-group my-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Comision % :</span>
                                <input type="text" id="comision_porc" name="comision_porc" required/ class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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