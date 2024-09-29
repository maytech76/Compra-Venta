<?php
require_once("../../config/conexion.php");
require_once("../../models/Rol.php");
$rol = new Rol();
$datos = $rol->validar_acceso_rol($_SESSION["USU_ID"], "RcServicios");
if (isset($_SESSION["USU_ID"])) {
    if (is_array($datos) and count($datos) > 0) {
?>

    <!doctype html>
    <html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

    <head>
        <title>MayTech | Servicios</title>
        <?php require_once("../html/head.php"); ?>


    </head>

        <body>

            <div id="layout-wrapper">

                <?php require_once("../html/header.php"); ?>

                <?php require_once("../html/menu.php"); ?>

                <div class="main-content">
                    <div class="page-content">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0">Recepción por <span class="text-info">Servicio</span> </h4>

                                        <div class="align-items-center d-flex">
                                        <h3>RECP- </h3>
                                        <h3 style="color:red;"  id="correlativo">  </h3>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <!-- TODO:Id Oculto del registro temporal de la  Compra -->
                            <input type="hidden" name="rcn" id="rcn" />

                            <!-- TODO:Datos del Cliente -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h3 class="card-title mb-0 flex-grow-1">Datos del Cliente</h3>
                                            <h4 class="card-title mb-0 mx-2 text-success">Nuevo Cliente </h4>
                                            <button type="button" id="btncliente" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-add-box-line"></i></button>

                                        </div>

                                        <div class="cardcli card-body">
                                            <div class="live-preview">
                                                <div class="row align-items-center g-3">

                                                    <div id="select_cli" class="col-lg-4">
                                                        <label for="cli_id" class="form-label">Cliente</label>

                                                        <!-- TODO:Select opction for Clientees -->
                                                        <select id="cli_id" name="cli_id" class="cliente form-control form-select" aria-label="Seleccione">
                                                            <option value='0' id="seleccion" selected>Seleccionar</option>

                                                        </select>
                                                    </div>

                                                    <!--TODO: INPUTS DATOS CLIENTE -->
                                                    <div class="col-lg-4">
                                                        <label for="cli_ruc" class="form-label">RUT</label>
                                                        <input type="text" class="form-control" id="cli_ruc" name="cli_ruc" placeholder="RUT" readonly />
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label for="cli_direcc" class="form-label">Dirección</label>
                                                        <input type="text" class="form-control" id="cli_direcc" name="cli_direcc" placeholder="Dirección" readonly />
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <label for="cli_correo" class="form-label">Correo</label>
                                                        <input type="text" class="form-control" id="cli_correo" name="cli_correo" placeholder="Correo Electronico" readonly />
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="cli_telf" class="form-label">Telefono</label>
                                                        <input type="text" class="form-control" id="cli_telf" name="cli_telf" placeholder="Telefono" readonly />
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- TODO:Datos Detallados del Vehiculo -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Datos del Vehículo</h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row align-items-center g-4 d-flex">

                                                <div class="col-lg-4 col-sm-12">
                                                    <div class="input-group align-items-center">
                                                        <select id="mrc_id" name="mrc_id" class="form-control form-select" aria-label="Marca..">
                                                            <option selected>Marca</option>
                                                        </select>
                                                        <button id="btnmarca" class="btn btn-outline-secondary" type="button">+</button>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-sm-12">
                                                    <div class="d-flex align-items-center">
                                                        <select id="mod_id" name="mod_id" class="form-select" aria-label="Modelo...">
                                                            <option selected="">Modelo</option>
                                                        </select>
                                                
                                                        <button id="btnmodelo" class="btn btn-outline-secondary" type="button">+</button>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-sm-12">
                                                    <div class="input-group">
                                                        <select id="tipo_id" name="tipo_id" class="form-select" aria-label="Selecionar una opcion">
                                                            <option selected="">Tipo de Motos</option>
                                                           
                                                        </select>
                                                        <button id="btntipovh" class="btn btn-outline-secondary" type="button">+</button>
                                                    </div>
                                                </div>
                                                    

                                                </div>
                                            </div>


                                            <div class="live-preview">
                                                <div class="row align-items-center g-4 mt-2 ">

                                                    <div class="col-lg-3 col-sm-12">
                                                        <label for="tipo_serv" class="form-label">Tipo de Servicio</label>
                                                        <select id="tipo_serv" name="tipo_serv" class="form-control form-select" aria-label="Seleccionar">
                                                            <option selected>Seleccionar</option>
                                                            <option value="Preventivo">Preventivo</option>
                                                            <option value="Correctivo">Correctivo</option>
                                                            <option value="Otros">Otros</option>
                                                            
                                                        </select>
                                                    </div>

                                                    <div class="col-lg-2 col-sm-12">
                                                        <label for="klm" class="form-label">Kilometraje</label>
                                                        <input type="text" class="form-control" id="klm" name="klm" placeholder="Indicar Klm" />
                                                    </div>

                                                    <div class="col-lg-4 col-sm-12">
                                                        <label for="serialch" class="form-label">Serial Chasis</label>
                                                        <input type="text" class="form-control" id="serialch" name="serialch" placeholder="Serial de Chase" />
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12">
                                                        <label for="patente" class="form-label">Patente</label>
                                                        <input type="text" class="form-control" id="patente" name="patente" placeholder="Ingresa Patente" />
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="live-previewmb-2">
                                                <div class="row align-items-center g-4 my-2 ">
                                                    <div class="card-header align-items-center d-flex">
                                                        <h4 class="card-title mb-0 flex-grow-1">Revisión de Seguridad al Ingreso</h4>
                                                    </div>
                                                </div>


                                                <div class="row align-items-center d-flex">


                                                        <div class="col-lg-3 col-sm-12">
                                                            <div class="form-check form-switch form-switch-lg""> 
                                                            <input type="checkbox" class="form-check-input" id="luces" name="SI">                     
                                                                <label for="luces">Luces</label><br>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3 col-sm-12">
                                                            <div class="form-check form-switch form-switch-lg">                                                         
                                                                <input type="checkbox" class="form-check-input" id="rueda" name="SI">
                                                                <label class="form-check-label" for="rueda">Neumáticos</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3 col-sm-12">
                                                            <div class="form-check form-switch form-switch-lg">                                                          
                                                                <input type="checkbox" class="form-check-input" id="cases" name="SI">
                                                                <label class="form-check-label" for="cases">Carcasa</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3 col-sm-12">
                                                            <div class="form-check form-switch form-switch-lg">                                                  
                                                                <input type="checkbox" class="form-check-input" id="docs" name="SI">
                                                                <label class="form-check-label" for="docs">Documentos</label>
                                                            </div>
                                                        </div>

                                                </div>

                                                    <hr>

                                                    <div class="row align-items-center d-flex">


                                                    <div class="col-lg-3 col-sm-12">
                                                        <div class="form-check form-switch form-switch-lg" >
                                                           
                                                            <input type="checkbox" class="form-check-input" id="casco" name="SI">
                                                            <label class="form-check-label" for="casco">Casco</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12">
                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                            <input type="checkbox" class="form-check-input" id="fuel" name="SI">
                                                            <label class="form-check-label" for="fuel">Combustible</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12">
                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                            <input type="checkbox" class="form-check-input" id="tools" name="SI">
                                                            <label class="form-check-label" for="tools">Herramientas</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-12">
                                                        <div class="form-check form-switch form-switch-lg" dir="ltr">                                                         
                                                            <input type="checkbox" class="form-check-input" id="otros" name="SI">
                                                            <label class="form-check-label" for="otros">Otros</label>
                                                        </div>
                                                    </div>

                                                    </div>

                                            
                                            </div>


                                            <div class="mt-4">
                                                <label for="compr_coment" class="form-label text-uppercase fw-semibold">Comentario</label>
                                                <textarea class="form-control alert alert-info" id="coment" name="coment" placeholder="Agrega con detalle un comentario" rows="4" required=""></textarea>
                                            </div>

                                            <div class="hstack gap-2 left-content-end d-print-none mt-4">
                                                <button type="button" id="btnguardar" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Guardar</button>
                                                <a id="btnlimpiar" class="btn btn-warning"><i class="ri-send-plane-fill align-bottom me-1"></i> Limpiar</a>
                                            </div>

                                         

                                        </div> <!-- FINAL CARD BODY -->
                                    </div>

                                   
                                </div>
                            </div>


                            <!-- TODO:Detalle Items de Compra y Totales -->

                            <?php require_once("./Modal.php"); ?>

                            <?php require_once("../html/footer.php"); ?>
                        </div>

                    </div>


        <?php require_once("../html/js.php"); ?>


        <script type="text/javascript" src="mdrecepcion.js"></script>

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