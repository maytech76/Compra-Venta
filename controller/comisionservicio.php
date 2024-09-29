<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Comisionservicio.php");
    /* TODO: Inicializando clase */
    $comisiones = new Comisiones();

    switch($_GET["op"]){


        /* TODO:CAMPOS A MOSTRAR EN LA TABLA PRINCIPAL */
        case 'listar':
            $datos=$comisiones->get_total_comision_x_tec_id($_POST["suc_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["TEC_ID"];
                $sub_array[] = $row["TEC_NOM"];
                $sub_array[] = $row["SUB_TOTAL"];
                $sub_array[] = '<p class = "text-center">'.$row["COMISION_VALOR"]." %".'</p>';
                $sub_array[] = '<h5 class = "font-weight-bold text-success">'.$row["TOTAL_COMISION"].'</h5>';
                

                $sub_array[] = '<a href="../ViewPgComision2/?Pg='.$row["TEC_ID"].'" target="_blank" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-coins-line"></i></a>';
                $sub_array[] = '<button type="button" onClick="pagar('.$row["TEC_ID"].')" id="'.$row["TEC_ID"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-checkbox-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="ver('.$row["TEC_ID"].')" id="'.$row["TEC_ID"].'" class="btn btn-info btn-icon waves-effect waves-light"><i class=" ri-money-dollar-circle-line"></i></button>';
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
            $datos=$comisiones->get_comisiones_ot_detalles($_POST["tec_id"]);
            $data=Array();

            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["ORDT_ID"];
                $sub_array[] = $row["CLI_NOM"];
                $sub_array[] = $row["FECH_CREA"];
                $sub_array[] = '<h5 class = "font-weight-bold" style="text-align: right;">'.$row["SUB_TOTAL"].'</h5>';
                $sub_array[] = '<p class = "text-center">'.$row["COMISION_PORC"]." %".'</p>';
                $sub_array[] = '<h5 class = "font-weight-bold" style="text-align: right;">'.$row["TOTAL_COMISION"].'</h5>';
                /* $sub_array[] = '<button type="button" onClick="eliminar('.$row["TEC_ID"].','.$row["VENT_ID"].')" id="'.$row["DETV_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>'; */
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
            $datos=$comisiones->reg_pago_comision($_POST["tec_id"]);
            foreach($datos as $row){
                $output["TEC_ID"] = $row["TEC_ID"];
             }
             echo json_encode($output);
            
        break;



        /* TODO:REGISTRAR_PAGO DE COMISION EN TABLA  td_pago_comisiones_mcn */
        case "pagarcom":
            $datos=$comisiones->insert_pago_comision(

            $_POST['tec_id'],
            $_POST["suc_id"],
            $_POST["usu_nom"],
            $_POST["suc_nom"],
            $_POST["tec_nom"],
            $_POST["tec_correo"],
            $_POST["tec_doc"],
            $_POST["tec_celular"],
            $_POST["cant_ot"],
            $_POST["total_comision"],
            $_POST["comentario"],

            
               
            );

        break; 


          /* TODO:ACTUALIZAR CAMPOS EST EN 2 TABLAS TD_COMISIONES_MCN / TM_ORDEN_TRABAJO */
        case "update_est":
            $datos=$comisiones->update_est_cms_ot(
                $_POST["tec_id"],
                $_POST["suc_id"],
            );

        break;


        /* TODO:LISTADO DE COMISIONES PAGADAS */
        case 'list_cms_pgd':
            $datos=$comisiones->get_list_pago_comisiones_mcn();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["PAGO_ID"];
                $sub_array[] = $row["TEC_NOM"];
                $sub_array[] = $row["SUC_NOM"];
                $sub_array[] = $row["CANT_OT"];
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



        /* TODO:CAMPOS A MOSTRAR EN EL MODAL FICHA DE TECNICO  */
        case "fichatecnico":
            $datos=$comisiones->get_ficha_tecnico($_POST["PAGO_ID"]);
            foreach($datos as $row){ 
                $output["PAGO_ID"] = $row["PAGO_ID"];   
            }

            echo json_encode($output);
        break;





    }

?>


