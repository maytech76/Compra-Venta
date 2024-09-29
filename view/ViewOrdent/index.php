<?php
    require_once("../../config/conexion.php");
    require_once("../../models/Rol.php");
    $rol = new Rol();
    $datos = $rol->validar_acceso_rol($_SESSION["USU_ID"],"ListOrden");
    if(isset($_SESSION["USU_ID"])){
        if(is_array($datos) and count($datos)>0){
?>

<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Maytech | OT</title>
    <?php require_once("../html/head.php"); ?>
</head>

<body>

    <div id="layout-wrapper">         
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-9">
                            <div class="card" id="demo">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-header border-bottom-dashed p-4 pb-0">
                                            <div class="mx-10">

                                                <div class="row d-flex-between">
                                                    <div class="col-lg-6 col-12">
                                                        <div class="flex-grow-0">
                                                            <img src="../../assets/images/logoMR_large2.png" class="card-logo card-logo-dark" alt="logo dark" width="200">
                                                            <img src="../../assets/images/logo-light.png" class="card-logo card-logo-light" alt="logo light" height="17">
                                                            <div class="mt-sm-2 mt-0">
                                                            <h6><span class="fw-semibold">Pagina Web : </span> <a href="https://maytechsoluciones.com" class="link-primary text-muted" target="_blank" id="txtpagina"></a></h6>
                                                                <h6 class="text-uppercase fw-semibold">Direccion: <span class="text-muted" id="txtdirecc"></span></h6>
                                                            </div>                                                  
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-12">
                                                        <div class="flex-shrink-0 mt-sm-0 mt-6">
                                                            <h6><span class="text-muted fw-normal">RUT : </span><span id="txtruc"></span></h6>
                                                            <h6><span class="text-muted fw-normal">Email : </span><span id="txtemail"></span></h6>
                                                            
                                                            <h6 class="mb-0"><span class="text-muted fw-normal">Telefono : </span><span id="txttelf"></span></h6>
                                                            <h6 class="mt-1"><span class="text-muted fw-normal">Sucursal : </span><span class="text-danger" id="txtsucursal"></span></h6>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card-body p-4">
                                            <div class="row g-3">
                                                <div class="col-lg-3 col-3">
                                                    <p class="mb-2 text-uppercase fw-semibold">N° de Orden</p>
                                                    <h5 class="fs-14 mb-0 text-success">OT-<span class="fw-bold" id="ordt_id"></span></h5>
                                                </div>

                                                <div class="col-lg-3 col-3">
                                                    <p class="mb-2 text-uppercase fw-semibold">Fecha</p>
                                                    <h5 class="text-muted fs-14 mb-0"><span id="txtfecha"></h5>
                                                </div>

                                                <div class="col-lg-3 col-3">
                                                    <p class="mb-2 text-uppercase fw-semibold">Mecanico</p>
                                                    <span class="badge badge-soft-success fs-11" id="txtnombret"></span>
                                                </div>

                                                <div class="col-lg-3 col-3">
                                                    <p class="mb-2 text-uppercase fw-semibold">Usuario</p>
                                                    <h5 class="text-muted fs-14 mb-0"><span id="usu_nom"></span></h5>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card-body p-4 border-top border-top-dashed">
                                            <div class="row g-3">

                                               <div class="col-lg-3 col-3">
                                                    <p class="mb-2 text-uppercase fw-semibold">Cliente</p>
                                                    <h5 class="fs-14 mb-0 text-muted"><span id="cli_nom"></span></h5>
                                                </div>

                                                <div class="col-lg-3 col-3">
                                                    <p class="mb-2 text-uppercase fw-semibold">Rut</p>
                                                    <h5 class="fs-14 mb-0 text-muted"><span id="cli_ruc"></span></h5>
                                                </div>

                                                <div class="col-lg-3 col-3">
                                                    <p class="mb-2 text-uppercase fw-semibold">Dirección</p>
                                                    <h5 class="fs-14 mb-0 text-muted"><span id="cli_direcc"></span></h5>
                                                </div>
                                                
                                                <div class="col-lg-3 col-3">
                                                    <p class="mb-2 text-uppercase fw-semibold">Correo</p>
                                                    <h5 class="fs-14 mb-0 text-muted"><span id="cli_correo"></span></h5>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card-body p-4 border-top border-top-dashed">
                                            <div class="row g-4">

                                               <div class="col-lg-2 col-2">
                                                    <p class="mb-2 text-uppercase fw-semibold">Marca de Moto</p>
                                                    <h5 class="fs-14 mb-0 text-muted"><span id="txtmarca"></span></h5>
                                                </div>

                                                <div class="col-lg-2 col-2">
                                                    <p class="mb-2 text-uppercase fw-semibold">Modelo de Moto</p>
                                                    <h5 class="fs-14 mb-0 text-muted"><span id="txtmodelo"></span></h5>
                                                </div>

                                                <div class="col-lg-2 col-2">
                                                    <p class="mb-2 text-uppercase fw-semibold">Tipo de Moto</p>
                                                    <h5 class="fs-14 mb-0 text-muted"><span id="txttipo"></span></h5>
                                                </div>

                                                <div class="col-lg-2 col-2">
                                                    <p class="mb-2 text-uppercase fw-semibold">patente</p>
                                                    <h5 class="fs-14 mb-0 text-muted"><span id="txtpatente"></span></h5>
                                                </div>
                                                
                                                <div class="col-lg-2 col-2">
                                                    <p class="mb-2 text-uppercase fw-semibold">Kilometraje</p>
                                                    <h5 class="fs-14 mb-0 text-muted"><span id="txtklm"></span></h5>
                                                </div>

                                                <div class="col-lg-2 col-2">
                                                    <p class="mb-2 text-uppercase fw-semibold">Tipo de Servicio</p>
                                                    <h5 class="fs-14 mb-0 text-muted"><span id="txttiposerv"></span></h5>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card-body p-4">
                                            <div class="table-responsive">

                                                <table class="table table-borderless table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr class="table-active">
                                                            <th scope="col">Producto</th>
                                                            <th scope="col" style="text-align:left">Und</th>
                                                            <th scope="col" style="text-align:left">P.Venta</th>
                                                            <th class="text-center">Cant.</th>
                                                            <th scope="col" class="text-end">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="listdetalle">

                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="border-top border-top-dashed mt-2">

                                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                                    <tbody>
                                                        <tr>
                                                            <td>Sub Total</td>
                                                            <td class="text-end" id="ordt_subtotal"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>IVA (19%)</td>
                                                            <td class="text-end" id="ordt_iva"></td>
                                                        </tr>
                                                        <tr class="border-top border-top-dashed fs-15">
                                                            <th scope="row">Total General</th>
                                                            <th class="text-end" id="txttotalg"></th>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>

                                            <div class="mt-4">
                                                <div class="alert alert-info">
                                                    <p class="mb-0"><span class="fw-semibold">Comentario:</span>
                                                        <span id="vent_coment">
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
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
   

    <?php require_once("../html/js.php"); ?>
    <script type="text/javascript" src="viewordent.js"></script>
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