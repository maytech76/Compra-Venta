<?php
require_once("../../config/conexion.php");
require_once("../../models/Rol.php");
$rol = new Rol();
$datos = $rol->validar_acceso_rol($_SESSION["USU_ID"], "ListPgComisiones");
if (isset($_SESSION["USU_ID"])) {
    if (is_array($datos) and count($datos) > 0) {
?>

        <!doctype html>
        <html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

        <head>
            <title>List | Comisiones Pagadas</title>
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
                                        <h4 class="mb-sm-0">Listado - <span class="text-success">Comisiones Pagadas</span></h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Comisiones de Vendedores</a></li>
                                                <li class="breadcrumb-item active">Mensuales</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- TODO:Id Oculto del registro temporal de la  Venta -->
                            <input type="hidden" name="pago_id" id="pago_id" />

                            <div class="card">
                                <div class="card-body">
                                        <!-- TODO: Tabla de Comisiones -->
                                        <table id="tabla_comisiones_pagadas" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>N° PG</th>
                                                    <th>VENDEDOR</th>
                                                    <th>SUCURSAL</th>
                                                    <th style="width: 5%;">C.VENTAS</th>
                                                    <th>FECHA-PG</th>
                                                    <th>TOTAL COMISION</th>           
                                                    <th>Ficha</th>            
                                                                        
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                </div>
                            </div>

                                <?php require_once("Modal.php"); ?>



                        </div>
                    </div>

                    <?php require_once("../html/footer.php"); ?>
                </div>

            </div>

            


            <?php require_once("../html/js.php"); ?>

            <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->


            <script type="text/javascript" src="listpgcomisiones.js"></script>

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