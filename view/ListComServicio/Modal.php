<div id="listcomisiones" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <form action="" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de Comisiones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>

            <input type="hidden" name="vend_id" id="vend_id"/>

            <div class="modal-body">
                <!-- TODO:Listado detalle de Venta -->
                <table id="detalle_comision" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                            
                            <th>N° DOC</th>
                            <th>CLIENTE</th>
                            <th>FECHA</th>
                            <th>SUB-TOTAL</th>
                            <th class="text-center">% DE COMISION</th>
                            <th>COMISION</th>
                                
                           
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="submit" name="action" value="add" id="pagar_comision" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i>Pagar</button>
                <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="liscomventa.js"></script>