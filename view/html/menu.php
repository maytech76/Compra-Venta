<?php
require_once("../../models/Menu.php");
$menu = new Menu();
/* TODO: Obtener listado de acceso por ROL ID del Usuario */
$datos = $menu->get_menu_x_rol_id($_SESSION["ROL_ID"]);
?>

<div class="app-menu navbar-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="../.././assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="../.././assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="../.././assets/images/logo-sm.png" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="../.././assets/images/logo-white.png" alt="" height="35">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                <?php
                    foreach ($datos as $row) {
                        if ($row["MEN_GRUPO"] == "Dashboard" && $row["MEND_PERMI"] == "Si") {
                    ?>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?php echo $row["MEN_RUTA"]; ?>">
                                    <i class="ri-honour-line"></i> <span data-key="t-widgets"><?php echo $row["MEN_NOM"]; ?></span>
                                </a>
                            </li>
                    <?php
                        }
                    }
                ?>



                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">ADMINISTRATIVO</span></li>

                <li class="nav-item"> <!-- Star Configuration -->
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-settings-4-line"></i><span data-key="t-dashboards">Configuración</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">


                            <?php
                            foreach ($datos as $row) {
                                if ($row["MEN_GRUPO"] == "Configuracion" && $row["MEND_PERMI"] == "Si") {
                            ?>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?php echo $row["MEN_RUTA"]; ?>">
                                            <span data-key="t-widgets"><?php echo $row["MEN_NOM"]; ?></span>
                                        </a>
                                    </li>
                            <?php
                                }
                            }
                            ?>

                        </ul>
                    </div>
                </li> <!-- End Configuration -->


                <li class="nav-item"><!-- Star Modulo of Shoping-->
                    <a class="nav-link menu-link" href="#compras" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-shopping-bag-3-line"></i><span data-key="t-dashboards">Modulo de Compras</span>
                    </a>
                    <div class="collapse menu-dropdown" id="compras">
                        <ul class="nav nav-sm flex-column">

                            <?php
                            foreach ($datos as $row) {
                                if ($row["MEN_GRUPO"] == "Compra" && $row["MEND_PERMI"] == "Si") {
                            ?>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?php echo $row["MEN_RUTA"]; ?>">
                                            <span data-key="t-widgets"><?php echo $row["MEN_NOM"]; ?></span>
                                        </a>
                                    </li>
                            <?php
                                }
                            }
                            ?>

                        </ul>
                    </div>
                </li> <!-- End Compras -->




                <li class="nav-item"> <!-- Star Modulo of Sales-->
                    <a class="nav-link menu-link" href="#ventas" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-money-dollar-box-line"></i><span data-key="t-dashboards">Modulo de Ventas</span>
                    </a>
                    <div class="collapse menu-dropdown" id="ventas">
                        <ul class="nav nav-sm flex-column">

                            <?php
                            foreach ($datos as $row) {
                                if ($row["MEN_GRUPO"] == "Venta" && $row["MEND_PERMI"] == "Si") {
                            ?>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?php echo $row["MEN_RUTA"]; ?>">
                                            <span data-key="t-widgets"><?php echo $row["MEN_NOM"]; ?></span>
                                        </a>
                                    </li>
                            <?php
                                }
                            }
                            ?>

                        </ul>
                    </div>
                </li> <!-- End Sales -->


                <li class="nav-item"> <!-- Star Modulo of Sales-->
                    <a class="nav-link menu-link" href="#servicios" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-motorbike-line"></i> <span data-key="t-dashboards">Modulo de Servicios</span>
                    </a>
                    <div class="collapse menu-dropdown" id="servicios">
                        <ul class="nav nav-sm flex-column">

                            <?php
                            foreach ($datos as $row) {
                                if ($row["MEN_GRUPO"] == "Servicio" && $row["MEND_PERMI"] == "Si") {
                            ?>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="<?php echo $row["MEN_RUTA"]; ?>">
                                            <span data-key="t-widgets"><?php echo $row["MEN_NOM"]; ?></span>
                                        </a>
                                    </li>
                            <?php
                                }
                            }
                            ?>


                        </ul>
                    </div>
                </li> <!-- End Sales -->

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div> <!-- End Menu General -->