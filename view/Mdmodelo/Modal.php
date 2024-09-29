

<div id="Modalmodelo" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <!-- TODO:Formulario de Mantenimiento -->
            <form method="post" id="mantenimiento_form">
                <div class="modal-body">
                    <input type="hidden" name="mod_id" id="mod_id"/>
                     <!-- <input type="hidden" name="mrc_id" id="mrc_id"/> -->

                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Nombre De Modelo</label>
                                <input type="text" class="form-control" id="mod_nom" name="mod_nom" required/>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div>
                            <label for="valueInput" class="form-label">Seleciona Marca</label>
                                <select type="text" class="form-control form-select" name="mrc_id" id="mrc_id" aria-label="Seleccionar">
                                    <option selected>Seleccionar</option>

                                </select>
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