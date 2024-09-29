<div id="Modaltecnico" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <!-- TODO: Formulario de Mantenimiento -->
            <form method="post" id="mantenimiento_form">
                <div class="modal-body">
                    <input type="hidden" name="tec_id" id="tec_id"/>

                    <!-- TODO:Nombre de Tecnico -->
                    <div class="row gy-2 mb-3">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="tec_nom" name="tec_nom" required/>
                            </div>
                        </div>
                    </div>

                    <!-- TODO:Apellido del Tecnico -->
                    <div class="row gy-2 mb-3">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="tec_ape" name="tec_ape" required/>
                            </div>
                        </div>
                    </div>

                    <!-- TODO:RUN del Tecnico -->
                    <div class="row gy-2 mb-3">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">RUN</label>
                                <input type="text" class="form-control" id="tec_doc" name="tec_doc" required/>
                            </div>
                        </div>
                    </div>

                    <!-- TODO:Telefono del Tecnico -->
                    <div class="row gy-2 mb-3">
                        <div class="col-md-6">
                            <div>
                                <label for="valueInput" class="form-label">Celular</label>
                                <input type="text" class="form-control" id="tec_celular" name="tec_celular" required/>
                            </div>
                        </div>

                         <!-- TODO:Correo Eléctronico -->                
                         <div class="col-md-6">
                            <div>
                                <label for="valueInput" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="tec_correo" name="tec_correo" required/>
                            </div>
                        </div>
                    </div>

                   
                    <!-- TODO:Comision del Tecnico -->
                    <div class="row gy-2 mb-3">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Comision %</label>
                                <input type="number" class="form-control" id="comision_porc" name="comision_porc" required/>
                            </div>
                        </div>
                    </div>
            

                    <!-- TODO:Foto del Tecnico -->
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Imagen</label>
                                <input type="file" class="form-control" id="tec_img" name="tec_img"/>
                            </div>
                        </div>
                    </div>

                    <br>

                    <!-- TODO:Remover Foto Previa -->
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

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary ">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>