<?php
require_once("../../config/conexion.php");
require_once("../../models/Rol.php");
$rol = new Rol();
$datos = $rol->validar_acceso_rol($_SESSION["USU_ID"], "ListRecepcion");
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

                <div class="page-content">

                    <div class="container">

                        <!-- TODO:Id Oculto del registro temporal de la  Compra -->
                        <input type="hidden" name="rcn" id="rcn" />

                        <!-- TODO:Datos del Cliente -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">

                                    <div class="mt-3 ml-2">
                                        <img src="../../assets/images/logomr2.png" class="card-logo card-logo-dark" alt="logo dark" height="70">
                                    </div>

                                    <div class="mx-5 d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0 fw-semibold">Recepción por Servicio </h4>

                                        <div class="align-items-center d-flex">
                                            <h3>RECP- </h3>
                                            <h3 style="color:red;" id="rcn_id"> </h3>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="card-header align-items-center d-flex">
                                        <h3 class="card-title mb-0 flex-grow-1 fw-semibold">Datos del Cliente</h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row align-items-center g-3">

                                                <!-- TODO:Select opction for Clientees -->
                                                <div class="col-lg-5">
                                                    <h6 for="cli_nom" class="form-label fw-bold">Cliente</h6>
                                                    <p class="text-muted" id="cli_nom"></p>
                                                </div>


                                                <!--TODO: INPUTS DATOS CLIENTE -->
                                                <div class="col-lg-2">
                                                    <h6 for="cli_ruc" class="font-weight-normal fw-bold">Rut</h6>
                                                    <p class="text-muted" id="cli_ruc"></p>
                                                </div>

                                                <div class="col-lg-5">
                                                    <h6 for="cli_direcc" class="form-label fw-bold">Dirección</h6>
                                                    <p class="text-muted" id="cli_direcc"></p>
                                                </div>

                                                <div class="col-lg-5">
                                                    <h6 for="cli_correo" class="form-label fw-bold">Correo</h6>
                                                    <p class="text-muted" id="cli_correo"></p>
                                                </div>

                                                <div class="col-lg-2">
                                                    <h6 for="cli_telf" class="form-label fw-bold">Telefono</h6>
                                                    <p class="text-muted" id="cli_telf"></p>
                                                </div>

                                                <div class="col-lg-5">
                                                    <h6 for="cli_telf" class="form-label text-info fw-bold">Usuario</h6>
                                                    <p class="text-muted" id="usu_nom"></p>
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
                                        <h4 class="card-title mb-0 flex-grow-1 fw-semibold">Datos del Vehículo</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row align-items-center g-3 d-flex">

                                                <div class="col-md-4 col-sm-12">
                                                    <label for="cli_telf" class="fw-semibold">Marca</label>
                                                    <p class="text-muted" id="mrc_nom"></p>
                                                </div>

                                                <div class="col-md-4 col-sm-12">
                                                    <label for="cli_telf" class="fw-semibold">Modelo</label>
                                                    <p class="text-muted" id="mod_nom"></p>
                                                </div>

                                                <div class="col-md-4 col-sm-12">
                                                    <label for="cli_telf" class="fw-semibold">Tipo</label>
                                                    <p class="text-muted" id="tipo_nom"></p>
                                                </div>


                                            </div>
                                        </div>
                                    

                                    <div class="row mx-2">

                                        <div class="col-lg-3 col-sm-12">
                                            <label for="tipo_serv" class="fw-semibold">Tipo de Servicio</label>
                                            <p class="text-muted" id="tipo_serv"></p>
                                        </div>

                                        <div class="col-lg-3 col-sm-12">
                                            <label for="klm" class="fw-semibold">Kilometraje</label>
                                            <p class="text-muted" id="klm"></p>
                                        </div>

                                        <div class="col-lg-3 col-sm-12">
                                            <label for="serialch" class="fw-semibold">Serial Chasis</label>
                                            <p class="text-muted" id="serialch"></p>
                                        </div>

                                        <div class="col-lg-3 col-sm-12">
                                            <label for="patente" class="fw-semibold">Patente</label>
                                            <p class="text-muted" id="patente"></p>
                                        </div>

                                    </div>
                                  </div>

                                  <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title my-0 flex-grow-1 fw-semibold">Revisión de Seguridad al Ingreso</h4>
                                        </div>
                                                    
                                        <div class="card-body">
                                        <div class="row align-items-center d-flex mx-2 mt-2">


                                            <div class="col-lg-3 col-sm-12">     
                                                    <label class="fw-semibold" for="luces">Luces</label>
                                                    <p class="text-muted" id="luces"></p>
                                                </div>


                                            <div class="col-lg-3 col-sm-12">
                                                    <label class="fw-semibold" for="rueda">Neumáticos</label>
                                                    <p class="text-muted" id="rueda"></p>
                                                </div>


                                            <div class="col-lg-3 col-sm-12">
                                                    <label class="fw-semibold" for="cases">Carcasa</label>
                                                    <p class="text-muted" id="cases"></p>
                                                </div>


                                            <div class="col-lg-3 col-sm-12">
                                                    <label class="fw-semibold" for="docs">Documentos</label>
                                                    <p class="text-muted" id="docs"></p>
                                                </div>


                                            </div>



                                            <div class="row align-items-center d-flex mx-2">


                                            <div class="col-lg-3 col-sm-12">
                                                    <label class="fw-semibold" for="casco">Casco</label>
                                                    <p class="text-muted" id="casco"></p>
                                            </div>

                                            <div class="col-lg-3 col-sm-12">
                                                    <label class="fw-semibold" for="fuel">Combustible</label>
                                                    <p class="text-muted" id="fuel"></p>
                                            </div>

                                            <div class="col-lg-3 col-sm-12">
                                                    <label class="fw-semibold" for="tools">Herramientas</label>
                                                    <p class="text-muted" id="tools"></p>
                                            </div>

                                            <div class="col-lg-3 col-sm-12">
                                                    <label class="fw-semibold" for="otros">Otros</label>
                                                    <p class="text-muted" id="otros"></p>
                                            </div>

                                            </div>



                                            <div class="mt-4">
                                            <label for="compr_coment" class="form-label text-uppercase fw-semibold">Comentario</label>
                                            <textarea class="form-control alert alert-info" id="coment" name="coment" rows="4"></textarea>
                                            </div>
                                   </div> <!-- End card-Body -->


                                       

                                    <div class="card-footer">
                                       <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnclose" >Close</button>
                                            <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i>Imprimir</a>
                                        </div>
                                    </div>

                                </div>

                                   
                                
                                
                                   

                    <!-- TODO:Detalle Items de Compra y Totales -->



                


            <?php require_once("../html/js.php"); ?>


            <script type="text/javascript" src="viewrecepcion.js"></script>

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


