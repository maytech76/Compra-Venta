<?php
require_once("../../config/conexion.php");
require_once("../../models/Rol.php");
$rol = new Rol();
$datos = $rol->validar_acceso_rol($_SESSION["USU_ID"], "OrdenTrabajo");
if (isset($_SESSION["USU_ID"])) {
    if (is_array($datos) and count($datos) > 0) {
?>

        <!doctype html>
        <html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

        <head>
            <title>MayTech | Orden de Trabajo</title>
            <?php require_once("../html/head.php"); ?>

        </head>

        <body>

            <div id="layout-wrapper">

                <?php require_once("../html/header.php"); ?>

                <?php require_once("../html/menu.php"); ?>

                <div class="main-content">
                    <div class="page-content">
                        <div class="container-fluid">

                            <!-- TODO:ENCABEZADO PRINCIPAL DE PAGINA -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0 text-success">Orden de Trabajo</h4>

                                        <div class="align-items-center d-flex">
                                            <h3>OT - </h3>
                                            <h3 style="color:red;" id="numero_ot"> </h3>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- TODO:Id Oculto del registro temporal de la  Venta -->
                            <input type="hidden" name="ordt_id" id="ordt_id" />

                            <!-- TODO:Datos del Proveedor -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Datos de Recepción</h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row align-items-center g-3">

                                                    <div class="col-lg-4">
                                                        <label for="rcn_id" class="form-label text-success">Recepción de Servicio</label>
                                                        <!-- TODO:Select opction for Proveedores -->
                                                        <select id="rcn_id" name="rcn_id" class="form-control form-select" aria-label="Seleccione">
                                                            <option value='0' selected>Seleccione</option>
                                                        </select>
                                                    </div>

                                                    <!--TODO: INPUTS DATOS DEL CLIENTE SELECCIONADO -->
                                                    <div class="col-lg-2">
                                                        <label for="cli_ruc" class="form-label">RUT</label>

                                                        <input type="hidden" class="form-control" id="cli_nom" name="cli_nom" />
                                                        <input type="text" class="form-control" id="cli_ruc" name="cli_ruc" placeholder="RUT" readonly />
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label for="cli_telf" class="form-label">Teléfono</label>
                                                        <input type="hidden" class="form-control" id="cli_id" name="cli_id" />
                                                        <input type="text" class="form-control" id="cli_telf" name="cli_telf" placeholder="Telefono" readonly />
                                                    </div>


                                                    <div class="col-lg-4">
                                                        <label for="cli_correo" class="form-label">Correo</label>
                                                        <input type="text" class="form-control" id="cli_correo" name="cli_correo" placeholder="Correo Electronico" readonly />
                                                    </div>
                                                    <hr class="mb-0">
                                                    <div class="card-header align-items-center d-flex mt-0">
                                                        <h4 class="card-title mb-0">Información del Vehículo</h4>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="mrc_nom" class="form-label">Marca</label>
                                                        <input type="text" class="form-control" id="mrc_nom" name="mrc_nom" placeholder="Marca" readonly />
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="mod_nom" class="form-label">Modelo</label>
                                                        <input type="text" class="form-control" id="mod_nom" name="mod_nom" placeholder="Modelo" readonly />
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="tipo_nom" class="form-label">Tipo de Vehículo</label>
                                                        <input type="text" class="form-control" id="tipo_nom" name="tipo_nom" placeholder="Tipo de Vehiculo" readonly />
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="tipo_serv" class="form-label">Tipo de Servicio</label>
                                                        <input type="text" class="form-control" id="tipo_serv" name="tipo_serv" placeholder="Tipo de Servicio" readonly />
                                                    </div>

                                                    <div class="col-lg-2">
                                                        <label for="klm" class="form-label">Kilometraje</label>
                                                        <input type="text" class="form-control" id="klm" name="klm" placeholder="Klm" readonly />
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="serialch" class="form-label">Serial Chasee</label>
                                                        <input type="text" class="form-control" id="serialch" name="serialch" placeholder="Serial de Chasee" readonly />
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label for="patente" class="form-label">Patente</label>
                                                        <input type="text" class="form-control" id="patente" name="patente" placeholder="Patente" readonly />
                                                    </div>

                                                    <div id="mecanico" class="col-lg-4">
                                                        
                                                            <label id="labelOpciones" style="color: red;">Seleccione el Mecánico</label>
                                                            <!-- TODO:Select opction for Proveedores -->
                                                            <select id="tec_id" name="tec_id" class="form-control form-select" aria-label="Seleccione">
                                                                <option id="opciones" value='na' selected>Seleccione</option>
                                                            </select>
                                                            <input type="hidden" id="tec_nom" name="tec_nom">
                                                            <input type="hidden" id="comision_valor" name="comision_valor">
                                                            <input type="hidden" id="comision_porc" name="comision_porc">
                                                        
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- TODO:Datos Detallados del Producto -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Agregar <span class="text-success"> Producto - Servicio</span></h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row align-items-center g-3">

                                                    <div class="col-lg-3">
                                                        <label for="cat_id" class="form-label">Categoria</label>
                                                        <select id="cat_id" name="cat_id" class="form-control form-select" aria-label="Seleccionar">
                                                            <option selected>Seleccione</option>

                                                        </select>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <label for="prod_id" class="form-label">Producto / Servicio</label>
                                                        <select id="prod_id" name="prod_id" class="form-control form-select" aria-label="Seleccionar">
                                                            <option selected>Seleccione</option>

                                                        </select>
                                                    </div>

                                                    <div class="col-lg-2">
                                                        <label for="prod_pventa" class="form-label">Precio-<span style="color:green">Sin IVA</span></label>
                                                        <input type="number" class="form-control" id="prod_pventa" name="prod_pventa" placeholder="Precio" />
                                                    </div>

                                                    <div class="col-lg-1">
                                                        <label for="prod_stock" class="form-label">Stock</label>
                                                        <input type="text" class="form-control" id="prod_stock" name="prod_stock" placeholder="Stock" readonly />
                                                    </div>

                                                    <div class="col-lg-1">
                                                        <label for="und_nom" class="form-label">Und.</label>
                                                        <input type="text" class="form-control" id="und_nom" name="und_nom" placeholder="UndMedida" readonly />
                                                    </div>

                                                    <div class="col-lg-1">
                                                        <label for="detc_cant" class="form-label">Cant.</label>
                                                        <input type="number" class="form-control" id="prod_cant" name="prod_cant" placeholder="Cant." />

                                                    </div>

                                                    <div class="col-lg-1 d-grid gap-1">
                                                        <label for="comp_cant" class="form-label">&nbsp;</label>
                                                        <button type="button" id="btnagregar" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-add-box-line"></i></button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TODO:Detalle Items de Venta y Totales -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Intems de la Orden</h4>
                                        </div>

                                        <div class="card-body">
                                            <table id="table_data" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                <thead>
                                                    <tr>

                                                        <th>Categoria</th>
                                                        <th>Producto</th>
                                                        <th>Und</th>
                                                        <th>P.Venta</th>
                                                        <th>Cant</th>
                                                        <th>Sub-Total</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>

                                            <!-- TODO:Valores Calculados de SubTotal, Total IVA, Total General -->
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

                                            <div class="mt-4">
                                                <label for="ordt_coment" class="form-label text-muted text-uppercase fw-semibold">Comentario</label>
                                                <textarea class="form-control alert alert-info" id="ordt_coment" name="ordt_coment" placeholder="Comentario" rows="4" required=""></textarea>
                                            </div>

                                            <div class="hstack gap-2 left-content-end d-print-none mt-4">
                                                <button type="button" id="btnguardar" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Registrar</button>
                                                <a id="btnlimpiar" class="btn btn-warning"><i class="ri-send-plane-fill align-bottom me-1"></i> Limpiar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php require_once("../html/footer.php"); ?>
                </div>

            </div>





            <?php require_once("../html/js.php"); ?>

            <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->


    <script type="text/javascript" src="orden.js"></script>
            <script type="text/javascript" src="mdordentrabajo.js"></script>

            <!--PRIMERO LLAMAMOS A JQUERY-->



        </body>

        </html>
<?php
    } else {
        header("Location:" . Conectar::ruta() . "view/404/");
    }
} else {
    header("Location:" . Conectar::ruta() . "view/404/");
}
?>