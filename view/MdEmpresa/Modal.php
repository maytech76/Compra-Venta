<div id="Modalempresa" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <!-- TODO:Formulario de Mantenimiento -->

            <form method="post" id="mantenimiento_form">
                <div class="modal-body">
                    <input type="hidden" name="emp_id" id="emp_id"/>
                    <input type="hidden" name="com_id" id="com_id"/>

                            

                            <div class="col-md-8 col-sm-12 bg-light">
                                <div>
                                    <label for="valueInput" class="form-label">NOMBRE</label>
                                    <input type="text" class="form-control" id="emp_nom" name="emp_nom" required/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div>
                                    <label for="valueInput" class="form-label">RUT</label>
                                    <input type="text" class="form-control" id="emp_ruc" name="emp_ruc" required/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <label for="valueInput" class="form-label">CORREO</label>
                                    <input type="text" class="form-control" id="emp_correo" name="emp_correo" required/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <label for="valueInput" class="form-label">TELEFONO</label>
                                    <input type="text" class="form-control" id="emp_telf" name="emp_telf" required/>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div>
                                    <label for="valueInput" class="form-label">DIRECCION</label>
                                    <input type="text" class="form-control" id="emp_direcc" name="emp_direcc" required/>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div>
                                    <label for="valueInput" class="form-label">PAGINA WEB</label>
                                    <input type="text" class="form-control" id="emp_pag" name="emp_pag" required/>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div>
                                    <label for="valueInput" class="form-label">LOGO</label>
                                    <input type="File" class="form-control" id="emp_img" name="emp_img" />
                                </div>
                            </div>


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
                      <div class="modal-footer border-top bg-light p-2">
                     <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                   <button type="submit" name="action" value="add" class="btn btn-primary ">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>