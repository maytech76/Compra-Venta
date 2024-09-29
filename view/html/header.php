<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="../../assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="../../assets/images/logo-dark.png" alt="" height="17">
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="../../assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="../../assets/images/logo-light.png" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
              
            </div>

            <div class="d-flex align-items-center">


               

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                        
                            <?php
                                if($_SESSION["USU_IMG"]==""){
                                    ?>
                                        <img class="rounded-circle header-profile-user" src="../../assets/images/users/not_photo.jpg" alt="Header Avatar">
                                    <?php
                                }else{
                                    ?>
                                        <img class="rounded-circle header-profile-user" src="../../assets/images/users/<?php echo $_SESSION["USU_IMG"]?>" alt="Header Avatar">
                                    <?php
                                }
                            ?>
                        
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo $_SESSION["USU_NOM"]?></span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text"><?php echo $_SESSION["USU_APE"]?></span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text"><?php echo $_SESSION["USU_ID"]?></span>
                            </span>
                        </span>
                    </button>
                      <!-- TODO: Generando Variables de Session -->
                    <input type="hidden" name="USU_IDx" id="USU_IDx" value="<?php echo $_SESSION["USU_ID"]?>"/>
                    <input type="hidden" name="USU_NOMx" id="USU_NOMx" value="<?php echo $_SESSION["USU_NOM"]?>"/>
                    <input type="hidden" name="SUC_IDx" id="SUC_IDx" value="<?php echo $_SESSION["SUC_ID"]?>"/>
                    <input type="hidden" name="COM_IDx" id="COM_IDx" value="<?php echo $_SESSION["COM_ID"]?>"/>
                    <input type="hidden" name="EMP_IDx" id="EMP_IDx" value="<?php echo $_SESSION["EMP_ID"]?>"/>


                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Bienvenido <?php echo $_SESSION["USU_NOM"]?>!</h6>
                        <a class="dropdown-item" href="pages-profile.html"><i
                                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Perfil</span></a>
                        
                        <a class="dropdown-item" href="pages-faqs.html"><i
                                class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Ayuda</span></a>
                        <div class="dropdown-divider"></div>
                        
                        <a class="dropdown-item" href="../html/logout.php"><i
                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle" data-key="t-logout">Cerrar Sesión</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>