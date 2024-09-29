<div id="Modalmoneda" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <!-- TODO:Formulario de Mantenimiento -->
            <form method="post" id="mantenimiento_form">
                <div class="modal-body">
                    <input type="hidden" name="mon_id" id="mon_id"/>

                    <div class="row gy-2">
                        <div class="col-md-8">
                                <div>
                                    <label for="valueInput" class="form-label">Nombre De Moneda</label>
                                    <input type="text" class="form-control" id="mon_nom" name="mon_nom" required/>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div>
                                    <label for="valueInput" class="form-label">Simbolo</label>
                                    <input type="text" class="form-control" id="mon_simb" name="mon_simb" required/>
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