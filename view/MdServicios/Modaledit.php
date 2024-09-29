<div id="edit_recepcion" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title mx-2 mb-3" id="lbltitulo2"></h5>
              
                </div>
           


            <!-- TODO:Formulario Editarrecepcion -->
            <form method="post" id="mantenimiento_form">
              <!--   <input type="hidden" name="rcn_id" id="rcn_id" /> -->
                <input type="hidden" name="cli_id" id="cli_id" />
                <input type="hidden" name="usu_id" id="usu_id" />
                <input type="hidden" name="rcn_id" id="rcn_id" /> 


                <div class="modal-body bg-gradient-light">

                    <div class="card shadow-sm p-3 mb-5 bg-white rounded">

                        <div class="row">

                            <div class="col-md-6 d-flex align-items-center">
                                <h5 class="font-weight-bold mr-2">Usuario: </h5>
                                <p class="text-success mt-2 mx-2" id="usu_nom" name="usu_nom"></p>
                            </div>

                            <div class="col-md-6 d-flex align-items-center">
                                <h5 class="font-weight-bold mx-2">Fecha: </h5>
                                <input class="border-0 pb-2 text-danger" type="text" id="fech_crea" name="fech_crea">

                            </div>

                        </div>

                        <hr class="mt-0 w-100 text-muted">


                        <div class="row gy-2">
                            <div class="col-md-4">
                                <div>
                                    <label for="valueinput" class="form-label mb-0">Rut:</label>
                                    <input type="text" class="form-control border-0 px-0 bg-transparent text-muted" id="cli_ruc" name="cli_ruc" disabled />
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div>
                                    <label for="cli_nom" class="form-label mb-0">Cliente:</label>
                                    <input type="text" class="form-control border-0 px-0 bg-transparent text-muted" id="cli_nom" name="cli_nom" disabled />

                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4 w-40">
                                <div>
                                    <label for="cli_nom" class="form-label mb-0">Telefono:</label>
                                    <input type="text" class="form-control border-0 px-0 bg-transparent text-muted" id="cli_telf" name="cli_telf" disabled />

                                </div>
                            </div>

                            <div class="col-md-8">
                                <div>
                                    <label for="cli_nom" class="form-label mb-0">Correo:</label>
                                    <input type="text" class="form-control border-0 px-0 bg-transparent text-muted" id="cli_correo" name="cli_correo" disabled />

                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 mt-3">
                            <div>
                                <label for="cli_nom" class="form-label mb-0">Dirección:</label>
                                <input type="text" class="form-control border-0 px-0 bg-transparent text-muted" id="cli_direcc" name="cli_direcc" disabled />

                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="col-md-4">
                            <div>
                                <label for="valueInput" class="form-label mb-0">Marca</label>
                                <select type="text" class="form-control form-select" name="mrc_id" id="mrc_id" aria-label="Seleccionar">
                                    <option selected>Seleccionar</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div>
                                <label for="valueInput" class="form-label mb-0">Modelo</label>
                                <select type="text" class="form-control form-select" name="mod_id" id="mod_id" aria-label="Seleccionar">
                                    <option selected>Seleccionar</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div>
                                <label for="valueInput" class="form-label mb-0">Tipo de Vehiculo</label>
                                <select type="text" class="form-control form-select" name="tipo_id" id="tipo_id" aria-label="Seleccionar">
                                    <option selected>Seleccionar</option>

                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="tipo_serv" class="form-label mb-0">Tipo de Servicio</label>
                            <select id="tipo_serv" name="tipo_serv" class="form-control form-select" aria-label="Seleccionar">
                                <option selected>Seleccionar</option>
                                <option value="Preventivo">Preventivo</option>
                                <option value="Correctivo">Correctivo</option>
                                <option value="Otros">Otros</option>
                            </select>
                        </div>

                        <div class="col-md-4 w-40">
                            <div>
                                <label for="cli_nom" class="form-label mb-0">Kilometraje</label>
                                <input type="text" class="form-control" id="klm" name="klm" required />

                            </div>
                        </div>

                        <div class="col-md-4 w-40">
                            <div>
                                <label for="cli_nom" class="form-label mb-0">Patente</label>
                                <input type="text" class="form-control" id="patente" name="patente" required />

                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                       <div class="col-md-12 w-40">
                            <div>
                                <label for="cli_nom" class="form-label mb-0">Serial de chase</label>
                                <input type="text" class="form-control" id="serialch" name="serialch" required />

                            </div>
                       </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


