<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/ComisionVenta.php");
    /* TODO: Inicializando clase */
    $comisiones = new Comisiones();

    switch($_GET["op"]){


        /* TODO:CAMPOS A MOSTRAR EN LA TABLA PRINCIPAL */
        case 'listar':
            $datos=$comisiones->get_total_comision_x_suc_id($_POST["suc_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["VEND_ID"];
                $sub_array[] = $row["VEND_NOM"];
                $sub_array[] = $row["SUB_TOTAL"];
                $sub_array[] = '<p class = "text-center">'.$row["COMISION_VALOR"]." %".'</p>';
                $sub_array[] = '<h5 class = "font-weight-bold text-success">'.$row["TOTAL_COMISION"].'</h5>';
                

                $sub_array[] = '<a href="../ViewPgComision/?Pg='.$row["VEND_ID"].'" target="_blank" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-coins-line"></i></a>';
                $sub_array[] = '<button type="button" onClick="pagar('.$row["VEND_ID"].')" id="'.$row["VEND_ID"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-checkbox-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="ver('.$row["VEND_ID"].')" id="'.$row["VEND_ID"].'" class="btn btn-info btn-icon waves-effect waves-light"><i class=" ri-money-dollar-circle-line"></i></button>';
                $data[] = $sub_array;

            }
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                    echo json_encode($results);
            
        break;


        /* TODO:CAMPOS A MOSTRAR EN EL (MODAL 1)  */
        case "listardetalle":
            $datos=$comisiones->get_comisiones_detalles($_POST["vend_id"]);
            $data=Array();

            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["VENT_ID"];
                $sub_array[] = $row["CLI_NOM"];
                $sub_array[] = $row["FECH_CREA"];
                $sub_array[] = '<h5 class = "font-weight-bold" style="text-align: right;">'.$row["VENT_SUBTOTAL"].'</h5>';
                $sub_array[] = '<p class = "text-center">'.$row["COMISION_PORC"]." %".'</p>';
                $sub_array[] = '<h5 class = "font-weight-bold" style="text-align: right;">'.$row["TOTAL_COMISION"].'</h5>';
                /* $sub_array[] = '<button type="button" onClick="eliminar('.$row["VEND_ID"].','.$row["VENT_ID"].')" id="'.$row["DETV_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>'; */
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;


        case 'pagar_comision':
            $datos=$comisiones->reg_pago_comision($_POST["vend_id"]);
            foreach($datos as $row){
                $output["VEND_ID"] = $row["VEND_ID"];
             }
             echo json_encode($output);
            
        break;



        /* TODO:REGISTRAR_PAGO DE COMISION EN TABLA  td_pago_comisiones */
        case "pagarcom":
            $datos=$comisiones->insert_pago_comision(

            $_POST['vend_id'],
            $_POST["suc_id"],
            $_POST["suc_nom"],
            $_POST["vend_nom"],
            $_POST["vend_correo"],
            $_POST["vend_rut"],
            $_POST["vend_telef"],
            $_POST["cant_ventas"],
            $_POST["total_comision"],
               
            );

        break; 



        case "update_est":
            $datos=$comisiones->update_est_cms_vnt(
                $_POST["vend_id"],
                $_POST["suc_id"],
            );

        break;


        /* TODO:LISTADO DE COMISIONES PAGADAS */
        case 'list_cms_pgd':
            $datos=$comisiones->get_list_pago_comisiones();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["PAGO_ID"];
                $sub_array[] = $row["VEND_NOM"];
                $sub_array[] = $row["SUC_NOM"];
                $sub_array[] = $row["CANT_VENTAS"];
                $sub_array[] = $row["FECH_CREA"];
                $sub_array[] = '<h5 class = "font-weight-bold text-success">'.$row["TOTAL_COMISION"].'</h5>';

                $sub_array[] = '<button type="button" onClick="ficha('.$row["PAGO_ID"].')" id="'.$row["PAGO_ID"].'" class="btn btn-info btn-icon waves-effect waves-light"><i class=" ri-money-dollar-circle-line"></i></button>';
                
                $data[] = $sub_array;

            }
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                    echo json_encode($results);
            
        break;



        /* TODO:CAMPOS A MOSTRAR EN EL MODAL FICHA DE VENDEDOR  */
        case "fichavendedor":
            $datos=$comisiones->get_ficha_vendedor($_POST["PAGO_ID"]);
            foreach($datos as $row){ 
                $output["PAGO_ID"] = $row["PAGO_ID"];   
            }

            echo json_encode($output);
        break;





    }

?>


