<!-- TODO:Conectamos con DB E Iniciamos $_SESSION -->
<?php 
require_once("../../config/conexion.php"); 
require_once("../../models/Rol.php");
$rol = new Rol();
$datos = $rol->validar_acceso_rol($_SESSION["USU_ID"],"Productos");
if(isset($_SESSION["USU_ID"])){
    if(is_array($datos) and count($datos)>0){ 
?>



<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>

    <title>Home | Productos</title>
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
                                <h4 class="mb-sm-0">Modulo de <span class="text-secondary">Productos</span></h4>
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
                                    <div class="card">
                                <div class="card-body">
                                    <p class="text-muted">Use <code>custom-hover-nav-tabs</code> class to create custom hover tabs.</p>
                                </div>
                                <div class="border">
                                    <ul class="nav nav-pills custom-hover-nav-tabs">
                                        <li class="nav-item">
                                            <a href="#custom-hover-customere" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                <i class="ri-user-fill nav-icon nav-tab-position"></i>
                                                <h5 class="nav-titl nav-tab-position m-0">Customer</h5>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#custom-hover-description" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                <i class="ri-file-text-line nav-icon nav-tab-position"></i>
                                                <h5 class="nav-titl nav-tab-position m-0">Description</h5>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                <i class="ri-star-half-line nav-icon nav-tab-position"></i>
                                                <h5 class="nav-titl nav-tab-position m-0">Reviews</h5>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content text-muted">
                                        
                                        <div class="tab-pane show active" id="custom-hover-customere">
                                            <h6>Customer Details</h6>
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Address</th>
                                                            <th scope="col">Country</th>
                                                            <th scope="col">Pincode</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>Ruby Butcher</td>
                                                            <td>412 Rosewood Lane</td>
                                                            <td>New York</td>
                                                            <td>10019</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2</th>
                                                            <td>Martha T Goldberg</td>
                                                            <td>2760 Clarksburg Park Road</td>
                                                            <td>Arizona</td>
                                                            <td>86038</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="tab-pane" id="custom-hover-description">
                                            <h6>Description</h6>
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Categories</th>
                                                            <th scope="col">Author</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Building Web Apps With Wordpress</td>
                                                            <td>Web, Wordpress, Design</td>
                                                            <td>Lucia Victor</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Information Technology</th>
                                                            <td>Management, Manager, Design</td>
                                                            <td>Arora Sumita</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="tab-pane" id="custom-hover-reviews">
                                            <h6>Customer Reviews</h6>
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Location</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Ratings</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Luke Brown</td>
                                                            <td>New York</td>
                                                            <td>$745</td>
                                                            <td>4.4 <i class="ri-star-s-fill ms-1 text-warning align-middle"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Matilda Walker</td>
                                                            <td>USA</td>
                                                            <td>$87.125</td>
                                                            <td>2.7 <i class="ri-star-s-fill ms-1 text-warning align-middle"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card-body -->
                            </div>
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
    <script type="text/javascript" src="mdproductos.js"></script>
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