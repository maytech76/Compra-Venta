<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Venta.php");
    /* TODO: Inicializando clase */
    $venta = new Venta();

    switch($_GET["op"]){


        /* TODO: Registrar Venta */
        case "registrar":
            $datos=$venta->insert_venta_x_suc_id($_POST["suc_id"],$_POST["usu_id"]);
            foreach($datos as $row){
                $output["VENT_ID"] = $row["VENT_ID"];
            }
            echo json_encode($output);
        break;


        /* TODO: Insertar detalle de venta, Ideal para icluir Vend_id, vend_nombre, comision_valor */
        case "guardardetalle":
            $datos=$venta->insert_venta_detalle($_POST["vent_id"],$_POST["prod_id"],$_POST["prod_pventa"],$_POST["detv_cant"]);
        break;


        /* TODO: Calculo de SUBTOTAL,IGV,TOTAL */
        case "calculo":
            $datos=$venta->get_venta_calculo($_POST["vent_id"]);
            foreach($datos as $row){
                $output["VENT_SUBTOTAL"] = $row["VENT_SUBTOTAL"];
                $output["VENT_IGV"] = $row["VENT_IGV"];
                $output["VENT_TOTAL"] = $row["VENT_TOTAL"];
            }
            echo json_encode($output);
        break;


        /* TODO:Eliminar Detalle de listado de ventas*/
        case "eliminardetalle":
            $venta->delete_venta_detalle($_POST["detv_id"]);
        break;


        /* TODO: Listar Detalle de Venta */
        case "listardetalle":
                $datos=$venta->get_venta_detalle($_POST["vent_id"]);
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    /*if ($row["PROD_IMG"] != ''){
                        $sub_array[] =
                        "<div class='d-flex align-items-center'>" .
                            "<div class='flex-shrink-0 me-2'>".
                                "<img src='../../assets/producto/".$row["PROD_IMG"]."' alt='' class='avatar-xs rounded-circle'>".
                            "</div>".
                        "</div>";
                    }else{
                        $sub_array[] =
                        "<div class='d-flex align-items-center'>" .
                            "<div class='flex-shrink-0 me-2'>".
                                "<img src='../../assets/images/productos/no_image.png' alt='' class='avatar-xs rounded-circle'>".
                            "</div>".
                        "</div>"; 
                    }*/
                    $sub_array[] = $row["CAT_NOM"];
                    $sub_array[] = $row["PROD_NOM"];
                    $sub_array[] = $row["UND_NOM"];
                    $sub_array[] = $row["PROD_PVENTA"];
                    $sub_array[] = $row["DETV_CANT"];
                    $sub_array[] = $row["DETV_TOTAL"];
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["DETV_ID"].','.$row["VENT_ID"].')" id="'.$row["DETV_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
                    $data[] = $sub_array;
                }

                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
        break;



        /* TODO: VISUALIZAMO EL LISTADO DE PRODUCTOS INVOLUCRADOS EN LA VENTA  ViewVenta */
        case "listardetalleformato";
            $datos=$venta->get_venta_detalle($_POST["vent_id"]);
            foreach($datos as $row){
                ?>
                     <tr>
                        <td><?php echo $row["CAT_NOM"];?></td>
                        <td><?php echo $row["PROD_NOM"];?></td>
                        <td scope="row"><?php echo $row["UND_NOM"];?></td>
                        <td><?php echo $row["PROD_PVENTA"];?></td>
                        <td><?php echo $row["DETV_CANT"];?></td>
                        <td class="text-end"><?php echo $row["DETV_TOTAL"];?></td>
                    </tr>
                <?php
              }
        break;



        /* TODO: Actualizar  cabecera de venta a est=1 */
        case "guardar":
                $datos=$venta->update_venta(
                    $_POST["vent_id"],
                    $_POST["pag_id"],
                    $_POST["cli_id"],
                    $_POST["cli_ruc"],
                    $_POST["cli_direcc"],
                    $_POST["cli_correo"],
                    $_POST["vent_coment"],
                    $_POST["mon_id"],
                    $_POST["doc_id"],
                    $_POST["vend_id"]
                );
        break;




        /* TODO:Insertar datos a comisiones de vendedores */
        case "insert_comisiones":
              $datos=$venta->insert_comisiones_vend(
                $_POST["vent_id"],
                $_POST["vend_id"],
                $_POST["suc_id"],
                $_POST["vend_nom"],
                $_POST["comision_porc"],
                $_POST["sub_total"],
                $_POST["comision_valor"],
              );

        break;



        /* TODO: Mostrar datos de la Cabecera en venta por COMP_ID */
        case "mostrar":
            $datos=$venta->get_venta($_POST["vent_id"]);
            foreach($datos as $row){
                $output["VENT_ID"] = $row["VENT_ID"];
                $output["SUC_ID"] = $row["SUC_ID"];
                $output["PAG_ID"] = $row["PAG_ID"];
                $output["PAG_NOM"] = $row["PAG_NOM"];
                $output["CLI_ID"] = $row["CLI_ID"];
                $output["CLI_RUC"] = $row["CLI_RUC"];
                $output["CLI_DIRECC"] = $row["CLI_DIRECC"];
                $output["CLI_CORREO"] = $row["CLI_CORREO"];
                $output["VENT_SUBTOTAL"] = $row["VENT_SUBTOTAL"];
                $output["VENT_IGV"] = $row["VENT_IGV"];
                $output["VENT_TOTAL"] = $row["VENT_TOTAL"];
                $output["VENT_COMENT"] = $row["VENT_COMENT"];
                $output["USU_ID"] = $row["USU_ID"];
                $output["USU_NOM"] = $row["USU_NOM"];
                $output["USU_APE"] = $row["USU_APE"];
                $output["USU_CORREO"] = $row["USU_CORREO"];
                $output["MON_ID"] = $row["MON_ID"];
                $output["MON_NOM"] = $row["MON_NOM"];
                $output["FECH_CREA"] = $row["FECH_CREA"];
                $output["SUC_NOM"] = $row["SUC_NOM"];
                $output["EMP_NOM"] = $row["EMP_NOM"];
                $output["EMP_RUC"] = $row["EMP_RUC"];
                $output["EMP_CORREO"] = $row["EMP_CORREO"];
                $output["EMP_TELF"] = $row["EMP_TELF"];
                $output["EMP_DIRECC"] = $row["EMP_DIRECC"];
                $output["EMP_PAG"] = $row["EMP_PAG"];
                $output["COM_NOM"] = $row["COM_NOM"];
                $output["CLI_NOM"] = $row["CLI_NOM"];
            }
            echo json_encode($output);
        break;



        /* TODO: Listar todas las ventas por sucursal  en Modulo ListVenta*/
        case "listarventa":
                $datos=$venta->get_venta_listado($_POST["suc_id"]);
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = "VENT-".$row["VENT_ID"];
                    $sub_array[] = $row["CLI_RUC"];
                    $sub_array[] = $row["CLI_NOM"];
                    $sub_array[] = $row["PAG_NOM"];
                    $sub_array[] = $row["MON_NOM"];
                    $sub_array[] = $row["VENT_SUBTOTAL"];
                    $sub_array[] = $row["VENT_IGV"];
                    $sub_array[] = $row["VENT_TOTAL"];
                    $sub_array[] = $row["USU_NOM"]." ".$row["USU_APE"];
                    if ($row["USU_IMG"] != ''){
                        $sub_array[] =
                        "<div class='d-flex align-items-center'>" .
                            "<div class='flex-shrink-0 me-2'>".
                                "<img src='../../assets/images/users/".$row["USU_IMG"]."' alt='' class='avatar-xs rounded-circle'>".
                            "</div>".
                        "</div>";
                    }else{
                        $sub_array[] =
                        "<div class='d-flex align-items-center'>" .
                            "<div class='flex-shrink-0 me-2'>".
                                "<img src='../../assets/images/users/not_photo.JPG' alt='' class='avatar-xs rounded-circle'>".
                            "</div>".
                        "</div>";
                    }
                    $sub_array[] = '<a href="../ViewVenta/?v='.$row["VENT_ID"].'" target="_blank" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-printer-line"></i></a>';
                    $sub_array[] = '<button type="button" onClick="ver('.$row["VENT_ID"].')" id="'.$row["VENT_ID"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-settings-2-line"></i></button>';
                    $data[] = $sub_array;
                }

                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
        break; 



        /* TODO: Listar TOP 5 de productos con sus datos mas ventados */
        case "top5ventas";
                $datos=$venta->get_venta_top_productos($_POST["suc_id"]);
                foreach($datos as $row){
                    ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                    <?php
                                        if ($row["PROD_IMG"] != ''){
                                            ?>
                                                <?php
                                                    echo "<img src='../../assets/images/productos/".$row["PROD_IMG"]."' alt='' class='img-fluid d-block' />";
                                                ?>
                                            <?php
                                        }else{
                                            ?>
                                                <?php 
                                                    echo "<img src='../../assets/images/productos/no_imagen.png' alt='' class='img-fluid d-block' />";
                                                ?>
                                            <?php
                                        }
                                    ?>
                                    </div>
                                    <div>
                                        <h5 class="fs-11 my-1"><?php echo $row["PROD_NOM"];?></h5>
                                        <span class="fs-11 text-muted"><?php echo $row["CAT_NOM"];?></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5 class="fs-12 my-1 fw-normal"><?php echo $row["PROD_PVENTA"];?></h5>
                                <span class="text-muted">P.Venta</span>
                            </td>
                            <td>
                                <h5 class="fs-12 my-1 fw-normal"><?php echo $row["CANTIDAD"];?></h5>
                                <span class="text-muted">Cant</span>
                            </td>
                            <td>
                                <h5 class="fs-12 my-1 fw-normal"><?php echo $row["PROD_STOCK"];?></h5>
                                <span class="text-muted">Stock</span>
                            </td>
                            <td>
                                <h5 class="fs-12 my-1 fw-blod text-success"> $ <?php echo $row["TOTAL"];?></h5>
                                <span class="text-muted">Total+Iva</span>
                            </td>
                        </tr>
                    <?php
                }
        break;




            /* TODO: Mostrar TOP 5 ultimas ventas */
        case "top5":
                $datos=$venta->get_venta_top_5($_POST["suc_id"]);
                foreach($datos as $row){
                    ?>
                        <tr>
                            <td>
                                C-<?php echo $row["VENT_ID"];?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                        <?php 
                                            if ($row["USU_IMG"] != ''){
                                                ?>
                                                    <?php
                                                        echo "<img src='../../assets/usuario/".$row["USU_IMG"]."' alt='' class='avatar-xs rounded-circle' />";
                                                    ?>
                                                <?php
                                            }else{
                                                ?>
                                                    <?php
                                                        echo "<img src='../../assets/usuario/no_imagen.png' alt='' class='avatar-xs rounded-circle' />";
                                                    ?>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="flex-grow-1"><?php echo $row["USU_NOM"];?> <?php echo $row["USU_APE"];?></div>
                                </div>
                            </td>
                            <td><?php echo $row["CLI_NOM"];?></td>
                            <td><?php echo $row["MON_NOM"];?></td>
                            <td><?php echo $row["VENT_SUBTOTAL"];?></td>
                            <td><?php echo $row["VENT_IGV"];?></td>
                            <td><?php echo $row["VENT_TOTAL"];?></td>
                        </tr>
                    <?php
                }
        break;



        /* TODO: Listado de actividades recientes para dashboard */
        case "ventaventa":
                $datos=$venta->get_ventaventa($_POST["suc_id"]);
                foreach($datos as $row){
                    ?>
                        <div class="acitivity-item py-3 d-flex">
                            <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                <?php
                                    if ($row["REGISTRO"] == 'Venta'){
                                        ?>
                                            <div class="avatar-title bg-soft-success text-success rounded-circle">
                                                <i class="ri-shopping-cart-2-line"></i>
                                            </div>
                                        <?php
                                    }else{
                                        ?>
                                            <div class="avatar-title bg-soft-danger text-danger rounded-circle">
                                                <i class="ri-stack-fill"></i>
                                            </div>
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1 lh-base"><?php echo $row["REGISTRO"];?> - <?php echo $row["DOC_NOM"];?></h6>
                                <p class="text-muted mb-1"><?php echo $row["CLI_NOM"];?> </p>
                                <small class="mb-0 text-muted"><?php echo $row["FECH_CREA"];?></small>
                            </div>
                        </div>
                    <?php
                }
        break;



        /* TODO: consumo de ventas por categoria para Donut del dashboard */
        case "dountventa":
            $datos=$venta->get_consumoventa_categoria($_POST["suc_id"]);
            $data = array();
            foreach($datos as $row){
                $data[]=$row;
            }
            echo json_encode($data);
        break;

        /*TODO: Listar Cliente para el campo Select */

        case "combo":

            $datos=$cliente->get_cliente_x_emp_id($_POST["emp_id"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option value='0' selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["CLI_ID"]."'>".$row["CLI_NOM"]."</option>";
                }
                echo $html;
            }

        break;



        case "barras":
            $datos=$venta->get_venta_barras($_POST["suc_id"]);
            $data = array();
            foreach($datos as $row){
                $data[]=$row;
            }
            echo json_encode($data);
            break;
    }
?>