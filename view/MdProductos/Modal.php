<div id="Modalproducto" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <!-- TODO: Formulario de Mantenimiento -->
            <form method="post" id="mantenimiento_form">
                <div class="modal-body">
                    <input type="hidden" name="prod_id" id="prod_id"/>

                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Categoria</label>
                                <select type="text" class="form-control form-select" name="cat_id" id="cat_id" aria-label="Seleccionar">
                                    <option selected>Seleccionar</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 mb-0">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="prod_nom" name="prod_nom" required />
                            </div>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Descripcion</label>
                                <textarea type="text" rows="3" class="form-control" id="prod_descrip" name="prod_descrip" required></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row my-3">
                        <div class="col-12 d-flex">
                            <div class="col-md-6 mx-2">
                                <div>
                                    <label for="valueInput" class="form-label">Unidad</label>
                                    <select type="text" class="form-control form-select" name="und_id" id="und_id" aria-label="Seleccionar">
                                        <option selected>Seleccionar</option>

                                    </select>
                                </div>
                            </div>



                            <div class="col-md-5 mx-2">
                                <div>
                                    <label for="valueInput" class="form-label">Moneda</label>
                                    <select type="text" class="form-control form-select" name="mon_id" id="mon_id" aria-label="Seleccionar">
                                        <option selected>Seleccionar</option>

                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="row my-2">
                        <div class="col-12 d-flex">


                            <div class="col-md-6 mx-2">
                                <div>
                                    <label for="valueInput" class="form-label">Precio Compra - <span style="color:red">Sin IVA</span></label>
                                    <input type="text" class="form-control" id="prod_pcompra" name="prod_pcompra" required />
                                </div>
                            </div>


                            <div class="col-md-5">
                                <div>
                                    <label for="valueInput" class="form-label">Otros Costos - <span style="color:red">Sin IVA</span></label>
                                    <input type="text" class="form-control" id="costosadd" name="costosadd" required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 15px;">
                        <div class="col-12 mx-2 d-flex">
                            <div class="col-md-2">
                                <div>
                                    <label for="valueInput" class="form-label" style="color:green">% - <span style="color:green">Utilidad</span></label>
                                    <input type="text" class="form-control" id="utilidad" name="utilidad" required />
                                </div>
                            </div>

                            <div class="col-md-6 mx-4">
                                <div>
                                    <label for="valueInput" class="form-label">Precio Venta -<span style="color:green">Sin IVA</span></label>
                                    <input type="text" class="form-control" id="prod_pventa" name="prod_pventa" required />
                                </div>
                            </div>

                            <div class="col-md-4 mt-4">
                                <div>
                                    <button id="calcular" class="btn btn-primary " style="margin-bottom: -20px;">></button>
                                </div>
                            </div>
                        </div>
                    </div>

                       

                    <div class="row my-3">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Stock</label>
                                <input type="text" class="form-control" id="prod_stock" name="prod_stock" required />
                            </div>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Codigo de Barra</label>
                                <input type="text" class="form-control" id="code_barr" name="code_barr" required />
                            </div>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Imagen</label>
                                <input type="file" class="form-control" id="prod_img" name="prod_img" />
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div class="text-center">
                                <a id="btnremovephoto" class="btn btn-danger btn-icon waves-effect waves-light btn-sm"><i class="ri-delete-bin-5-line"></i></a>
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    <span id="pre_imagen" name="pre_imagen"></span>
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