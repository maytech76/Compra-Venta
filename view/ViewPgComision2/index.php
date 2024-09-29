<?php
require_once("../../config/conexion.php");
require_once("../../models/Rol.php");
$rol = new Rol();
$datos = $rol->validar_acceso_rol($_SESSION["USU_ID"], "PagoComision");
if (isset($_SESSION["USU_ID"])) {
    if (is_array($datos) and count($datos) > 0) {
?>

        <!doctype html>
        <html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

        <head>
            <title>Recibo | P-Comisiones</title>
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
                                        <h4 class="mb-sm-0">Recibo</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pago</a></li>
                                                <li class="breadcrumb-item active">Comisiones</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-xxl-9">
                                    <div class="card" id="demo">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card-header border-bottom-dashed p-4">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <img src="../../assets/images/logomr_large2.png" class="card-logo card-logo-dark" alt="logo dark" height="70">
                                                            <img src="../../assets/images/logo-light.png" class="card-logo card-logo-light" alt="logo light" height="17">

                                                        </div>
                                                        <div class="d-flex flex-column bd-highlight mb-3 col-lg-3 col-6">
                                                            <h4 class="text-uppercase text-success">PAGO DE COMISIONES</h4>
                                                            <h5 class="text-primary"> Por Servicio Técnico</h5>
                                                            <h6 class="fw-medium mb-1">Sucursal : <span class="text-muted" value="0" id="sucursal"> </span></h6>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                            <!-- DATOS DEL VENDEDOR -->
                                            <div class="col-lg-12">
                                                <div class="card-body p-4">
                                                    <div class="row g-3">
                                                        <div class="col-lg-3 col-6">
                                                            <div class="mt-sm-5 mt-4">
                                                                <h5 class="text-uppercase fw-semibold">Codigo</h5>
                                                                <h6 class="text-muted fw-medium mb-1 pl-2" value="0" name="txttec_id">00<span id="txttec_id"></span></h6>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-6">
                                                            <div class="mt-sm-5 mt-4">
                                                                <h5 class="text-uppercase fw-semibold">Nombre </h5>
                                                                <h6 class="text-muted fw-medium mb-1" value="0"><span id="txttec_nom"></span></h6>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-6">
                                                            <div class="mt-sm-5 mt-4">
                                                                <h5 class="text-uppercase fw-semibold">RUN </h5>
                                                                <h6 class="text-muted  fw-medium mb-1"><span id="txttec_doc"></span></h6>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-6">
                                                            <div class="mt-sm-5 mt-4">
                                                                <h5 class="text-uppercase fw-semibold">Correo</h5>
                                                                <h6 class="text-muted fw-medium mb-1"><span id="txttec_correo"></span></h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="card-body pt-2 px-4">
                                                    <div class="row g-3">
                                                        <div class="col-lg-3 col-6">
                                                            <p class="mb-2 text-uppercase fw-semibold">N° de OT</p>
                                                            <h5 class="text-success fs-14 mb-0">00<span id="txtcantot"></span></h5>
                                                        </div>

                                                        <div class="col-lg-3 col-6">

                                                            <p class="mb-2 text-uppercase fw-semibold"> % de Comision</p>
                                                            <div class="flex-grow-1 bd-highlight">
                                                                <P class="badge badge-soft-info fs-14" value="0"><span id="comisionporc"></span> %</P>
                                                            </div>

                                                        </div>

                                                        <div class="col-lg-3 col-6">
                                                            <p class="mb-2 text-uppercase fw-semibold">Telefono</p>
                                                            <h5 class="text-muted fs-14 mb-0"><span id="celular"></span></h5>
                                                        </div>

                                                        <div class="col-lg-3 col-6">
                                                            <p class="mb-2 text-uppercase fw-semibold">Fecha de Pago</p>
                                                            <h5 class="text-muted fs-14 mb-0"><span id="fech_registro"></h5>
                                                        </div>


                                                    </div>

                                                </div>

                                            </div>

                                            <!-- TODO:TABLA CON LISTADO DETALLADO DE COMISIONES -->
                                            <div class="col-lg-12">
                                                <div class="card-body p-4">

                                                    <div class="table-responsive">

                                                        <!-- TODO:Listado detalle de Venta -->
                                                        <table id="detalle_comision" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                            <thead>
                                                                <tr>

                                                                    <th style="width: 5%;">N° DOC</th>
                                                                    <th style="width: 30%;">CLIENTE</th>
                                                                    <th style="width: 10%;">FECHA</th>
                                                                    <th style="width: 10%; text-align: right;">SUB-TOTAL</th>
                                                                    <!-- <th class="text-center" style="width: 15%;">% DE COMISION</th> -->
                                                                    <th style="width: 2%; text-align: right;">% COMISION</th>
                                                                    <th style="width: 10%; text-align: right;">$ COMISION</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>


                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="col col-6">

                                                            <div class=" text-alain-letf mt-2">

                                                                <p>Recibí Conforme </p>
                                                                <br>
                                                                <p class="mb-0">---------------------------------</p>
                                                                <p class="mt-0">Nombre Completo :</p>

                                                            </div>

                                                        </div>

                                                        <div class="col-3">
                                                            <h3>TOTAL :</h3>
                                                        </div>

                                                        <div class="col col-3">
                                                            <h3 class="text-success font-weight-bold"> <span id="totalcomision"></span> CLP</h3>
                                                        </div>
                                                    </div>


                                                    <div class="mt-4">
                                                        <label for="comentario" class="form-label text-muted text-uppercase fw-semibold">Comentario :</label>
                                                        <textarea class="form-control alert alert-info" id="comentario" name="comentario" placeholder="Comentario" rows="1" required></textarea>
                                                    </div>
                                                    <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                                        <!-- <a href="javascript:window.print()"> --><button type="button" id="btnpagar" class="btn btn-success"><i class="ri-coins-line align-bottom me-1"></i>Pagar</button><!-- </a> -->
                                                        <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i>Imprimir</a>

                                                    </div>
                                                </div>

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
            <script type="text/javascript" src="viewpgcomision2.js"></script>
            <script type="text/javascript" src="registro.js"></script>
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