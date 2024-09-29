

<div id="ModalDetalles" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de la Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <!-- TODO:Formulario de Mantenimiento -->
          
                <div class="modal-body">
                 
                    <div class="row gy-2">
                        <div class="col-md-12">     
                        </div>
                    </div>
                     <!-- Listamos el detalle de los items involucrados en la compra -->
                    <table id="detalle_data" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                                      
                                <th>Categoria</th>
                                <th>Producto</th>
                                <th>Unidad</th>
                                <th>P-Compra</th>
                                <th>Cantidad</th>
                                <th>Costo Total</th>
                        
                            
                                
                            
                                                        
                            </tr>
                        </thead>
                        <tbody>
                                                   
                        </tbody>
                    </table>

                     <!-- TODO:Mostramos Valores Calculados de SubTotal, Total IVA, Total General -->
                     <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                            <tbody>
                                <tr>
                                    <td>Sub Total</td>
                                    <td class="text-end" id="txtsubtotal">0</td>
                                </tr>
                                <tr>
                                    <td>Total IVA (19%)</td>
                                    <td class="text-end" id="txtigv">0</td>
                                </tr>
                                <tr class="border-top border-top-dashed fs-15">
                                    <th scope="row">Total General</th>
                                    <th class="text-end" id="txttotal">0</th>
                                </tr>
                            </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            
        </div>
    </div>
</div>