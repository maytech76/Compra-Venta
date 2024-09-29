 <?php
    require_once("../../config/conexion.php");
    require_once("../../models/Rol.php");
    $rol = new Rol();
    $datos = $rol->validar_acceso_rol($_SESSION["USU_ID"],"ventas");
    if(isset($_SESSION["USU_ID"])){
        if(is_array($datos) and count($datos)>0){ 
?> 

<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>MayTech | Venta</title>
    <?php require_once("../html/head.php"); ?>

    <!-- Select2 Plugin -->
     <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
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
                                <h4 class="mb-sm-0">Modulo de Venta</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Venta</a></li>
                                        <li class="breadcrumb-item active">Registrar Venta</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                <!-- TODO:Id Oculto del registro temporal de la  Venta -->
                <input type="hidden" name="vent_id" id="vent_id"/>

                    <!-- TODO:Datos del Tipo de Documento , Forma de Pago, Moneda -->
                     <div class="row"> 
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Tipo de Pago</h4>
                                </div>

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row align-items-center g-3">

                                            <div class="col-lg-3">
                                                <label for="doc_id" class="form-label">Documento</label>
                                                <select id="doc_id" name="doc_id" class="form-control form-select" aria-label="Seleccionar">
                                                    <option value="0" selected>Seleccione</option>

                                                </select>
                                            </div>

                                            <div class="col-lg-3">
                                                <label for="pag_id" class="form-label">Pago</label>
                                                <select id="pag_id" name="pag_id" class="form-control form-select" aria-label="Seleccionar">
                                                    <option value="0" selected>Seleccione</option>

                                                </select>
                                            </div>

                                            <div class="col-lg-3">
                                                <label for="mon_id" class="form-label">Moneda</label>
                                                <select id="mon_id" name="mon_id" class="form-control form-select" aria-label="Seleccionar">
                                                    <option value='0' selected>Seleccione</option>

                                                </select>
                                            </div>

                                            <div class="col-lg-3">
                                                <label for="vend_id" class="form-label">Vendedor</label>
                                                <select id="vend_id" name="vend_id" class="form-control form-select" aria-label="Seleccionar">
                                                    <option value='0' selected>Seleccione</option>
                                                </select>
                                            </div>

                                             <!-- TODO:Id Oculto del vendedor -->
                                              <input type="hidden" name="vend_nom" id="vend_nom"/>
                                              <input type="hidden" name="comision_porc" id="comision_porc"/>
                                              <input type="hidden" name="comision_valor" id="comision_valor"/>
                                            

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <!-- TODO:Datos del Proveedor -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Datos del Cliente</h4>
                                </div>

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row align-items-center g-3">
                                            <div class="col-lg-4">
                                                <label for="prov_id" class="form-label">Cliente</label>

                                                <!-- TODO:Select opction for Proveedores -->
                                                <select id="cli_id" name="cli_id" class="form-control form-select" aria-label="Seleccione">
                                                    <option value='0' selected>Seleccione</option>

                                                </select>
                                            </div>
                                            <!--TODO: INPUTS DATOS DEL CLIENTE SELECCIONADO -->
                                            <div class="col-lg-4">
                                                <label for="cli_ruc" class="form-label">RUT</label>
                                                <input type="text" class="form-control" id="cli_ruc" name="cli_ruc" placeholder="RUC" readonly/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="cli_direcc" class="form-label">Dirección</label>
                                                <input type="text" class="form-control" id="cli_direcc" name="cli_direcc" placeholder="Dirección" readonly/>
                                            </div>

                                            <div class="col-lg-6">
                                                <label for="cli_correo" class="form-label">Correo</label>
                                                <input type="text" class="form-control" id="cli_correo" name="cli_correo" placeholder="Correo Electronico" readonly/>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="cli_telf" class="form-label">Telefono</label>
                                                <input type="text" class="form-control" id="cli_telf" name="cli_telf" placeholder="Telefono" readonly/>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Agregar Producto</h4>
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
                                                <label for="prod_id" class="form-label">Producto</label>
                                                <select id="prod_id" name="prod_id" class="form-control form-select" aria-label="Seleccionar">
                                                    <option selected>Seleccione</option>

                                                </select>
                                            </div>

                                            <div class="col-lg-1">
                                                <label for="prod_pventa" class="form-label">Precio</label>
                                                <input type="number" class="form-control" id="prod_pventa" name="prod_pventa" placeholder="Precio" />
                                            </div>

                                            <div class="col-lg-1">
                                                <label for="prod_stock" class="form-label">Stock</label>
                                                <input type="text" class="form-control" id="prod_stock" name="prod_stock" placeholder="Stock" readonly/>
                                            </div>

                                            <div class="col-lg-2">
                                                <label for="und_nom" class="form-label">Und.</label>
                                                <input type="text" class="form-control" id="und_nom" name="und_nom" placeholder="UndMedida" readonly/>
                                            </div>

                                            <div class="col-lg-1">
                                                <label for="detc_cant" class="form-label">Cant.</label>
                                                <input type="number" class="form-control" id="detv_cant" name="detv_cant" placeholder="Cant."/>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Detalle de Venta</h4>
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
                                        <label for="vent_coment" class="form-label text-muted text-uppercase fw-semibold">Comentario</label>
                                        <textarea class="form-control alert alert-info" id="vent_coment" name="vent_coment" placeholder="Comentario" rows="4" required=""></textarea>
                                    </div>

                                    <div class="hstack gap-2 left-content-end d-print-none mt-4">
                                        <button type="button" id="btnguardar" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Guardar</button>
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

  
    <script type="text/javascript" src="mdventa.js"></script>

     <!--PRIMERO LLAMAMOS A JQUERY-->
   

   
  
   

</body>

</html>
<?php
         }else{
            header("Location:".Conectar::ruta()."view/404/");
        }
    }else{
        header("Location:".Conectar::ruta()."view/404/");
    } 
?>