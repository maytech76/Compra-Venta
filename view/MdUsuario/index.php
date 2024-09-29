<!-- TODO:Conectamos con DB E Iniciamos $_SESSION -->
<?php
require_once("../../config/conexion.php");
require_once("../../models/Rol.php");
$rol = new Rol();
$datos = $rol->validar_acceso_rol($_SESSION["USU_ID"], "Usuarios");
if (isset($_SESSION["USU_ID"])) {
    if (is_array($datos) and count($datos) > 0) {

?>



        <!doctype html>
        <html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

        <head>

            <title>MAYTECH | Usuarios</title>
            <?php require_once("../html/head.php"); ?>

        </head>

        <body>

            <!-- Begin page -->
            <div id="layout-wrapper">

                <!-- ============================================================== -->
                <!------------------   Start Header of page  ---------------------->
                <!-- ============================================================== -->

                <?php require_once("../html/header.php"); ?>

                <!-- ============================================================== -->
                <!--======================= App Menu ============================== -->
                <!-- ============================================================== -->

                <?php require_once("../html/menu.php"); ?>
                <!-- Left Sidebar End -->
                <!-- Vertical Overlay-->
                <div class="vertical-overlay"></div>


                <!-- ============================================================== -->
                <!------------------ Start right Content here ---------------------->
                <!-- ============================================================== -->
                <div class="main-content">
                    <div class="page-content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0">Modulo de <span class="text-success">Usuarios</span></h4>
                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item">Admin</li>
                                                <li class="breadcrumb-item active"><a href="../home/">Inicio</a></li>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <button type="button" id="btnNuevo" class="btn btn-success btn-label waves-effect waves-light"><i class=" ri-add-circle-line label-icon align-middle fs-16 me-2"></i> Registro</button>
                                                </div>
                                                <div class="card-body">
                                                    <table id="tabla_usuario" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                        <thead>
                                                            <tr>


                                                                <th>Foto</th>
                                                                <th>Nombre</th>
                                                                <th>Run</th>
                                                                <th>Perfil</th>
                                                                <th>Email</th>
                                                                <th>F-registro</th>
                                                                <th></th>
                                                                <th></th>


                                                            </tr>
                                                        </thead>
                                                        <tbody class="mx-auto">

                                                        </tbody>
                                                    </table>
                                                </div>

                                                <?php require_once("./Modal.php"); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================== -->
                    <!---------------- Elementos Footer------------------->
                    <!-- ============================================== -->
                    <?php require_once("../html/footer.php"); ?>

                </div>
            </div>



            <!-- ============================================== -->
            <!---------------- Elementos javascripts ------------->
            <!-- ============================================== -->
            <?php require_once("../html/js.php"); ?>
            <script type="text/javascript" src="mdusuarios.js"></script>
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