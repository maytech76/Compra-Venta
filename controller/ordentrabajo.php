<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Ordentrabajo.php");
    /* TODO: Inicializando clase */
    $ordentrabajo = new Ordentrabajo();

    switch($_GET["op"]){


        /* TODO: Registrar Venta */
        case "registrar":
            $datos=$ordentrabajo->insert_orden_x_suc_id($_POST["suc_id"],$_POST["usu_id"]);
            foreach($datos as $row){
                $output["ORDT_ID"] = $row["ORDT_ID"];
            }
            echo json_encode($output);
        break;


        /* TODO: Insertar detalle de venta, Ideal para icluir Vend_id, vend_nombre, comision_valor */
        case "guardardetalle":
            $datos=$ordentrabajo->insert_items_orden($_POST["ordt_id"],$_POST["prod_id"],$_POST["prod_pventa"],$_POST["prod_cant"]);
        break;



         /* TODO: Calculo de SUBTOTAL,IGV,TOTAL */
         case "calculo":
            $datos=$ordentrabajo->get_orden_calculo($_POST["ordt_id"]);
            foreach($datos as $row){
                $output["ORDT_SUBTOTAL"] = $row["ORDT_SUBTOTAL"];
                $output["ORDT_IVA"] = $row["ORDT_IVA"];
                $output["ORDT_TOTALG"] = $row["ORDT_TOTALG"];
            }
            echo json_encode($output);
         break;



        /* TODO: Listar Detalle de Venta */
        case "listardetalle":

            $datos=$ordentrabajo->get_orden_detalle($_POST["ordt_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["CAT_NOM"];
                $sub_array[] = $row["PROD_NOM"];
                $sub_array[] = $row["UND_NOM"];
                $sub_array[] = $row["PROD_PVENTA"];
                $sub_array[] = $row["PROD_CANT"];
                $sub_array[] = $row["DETO_TOTALG"];
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["DETOT_ID"].','.$row["ORDT_ID"].')" id="'.$row["DETOT_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;


        /* TODO:Eliminar items de listado de producto - servicio de OT */
        case "eliminardetalle":
             $ordentrabajo->delete_OT_detalle($_POST["detot_id"]);
        break;


         /* TODO: Actualizamos datos a tm_orden_trabajo */
         case "guardar":
            $datos=$ordentrabajo->update_ordent(
                $_POST["ordt_id"],
                $_POST["rcn_id"],
                $_POST["cli_id"],
                $_POST["tec_id"],
                $_POST["cli_nom"],
                $_POST["cli_telf"],
                $_POST["cli_ruc"],
                $_POST["cli_correo"],

                $_POST["mrc_nom"],
                $_POST["mod_nom"],
                $_POST["tipo_nom"],
                $_POST["tipo_serv"],

                $_POST["klm"],
                $_POST["serialch"],
                $_POST["patente"],
                $_POST["ordt_coment"]
            );
         break;



         /* TODO:Insertar datos a comisiones de MECANICOS */
        case "insert_comisiones_mcn":
            $datos=$ordentrabajo->insert_comisiones_orden(
              $_POST["ordt_id"],
              $_POST["cli_id"],
              $_POST["suc_id"],
              $_POST["tec_id"],
              $_POST["tec_nom"],
              $_POST["comision_porc"],
              $_POST["sub_total"],
              $_POST["comision_valor"]
            );

        break;



        /* TODO:Insertar datos a tabla orden de trabajo*/
        case "insert_ot":
            
            $datos=$ordentrabajo->insert_orden_trabajo(
              $_POST["rcn_id"],
              $_POST["suc_id"],
              $_POST["cli_id"],
              $_POST["usu_id"],
              $_POST["tec_id"],
              $_POST["cli_nom"],
              $_POST["cli_ruc"],
              $_POST["cli_correo"]
             
            );

        break;

        

        /*************************************/
        /* Modulo Listar ordenes de Trabajo  */
        /**********************************  */
        case "listar_ordenes":
            $datos=$ordentrabajo->list_orden_procesadas($_POST["suc_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array=array();
                $sub_array[] = "OT-".$row["ORDT_ID"];
                $sub_array[] = $row["CLI_RUC"];
                $sub_array[] = $row["CLI_NOM"];
                $sub_array[] = $row["PATENTE"];
                $sub_array[] = $row["MRC_NOM"];
                $sub_array[] = $row["MOD_NOM"];
                $sub_array[] = $row["TIPO_SERV"];
                $sub_array[] = $row["FECH_CREA"];
                $sub_array[] = '<a href="../ViewOrdent/?OT='.$row["ORDT_ID"].'" target="_blank" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-printer-line"></i></a>';
                $sub_array[] = '<button type="button" onClick="modal('.$row["ORDT_ID"].')" id="'.$row["ORDT_ID"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-settings-2-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            
        break;


        /* CONTROLA LA DATA A MOSTRAR EN VIEW_ORDEN PRE PRINTER */
        case 'view_ordent':
            $datos=$ordentrabajo->view_ordent($_POST["ordt_id"]);
            foreach($datos as $row){
                $sub_array=array();
                $output["ORDT_ID"] = $row["ORDT_ID"];
                $output["CLI_RUC"] = $row["CLI_RUC"];
                $output["CLI_NOM"] = $row["CLI_NOM"];
                $output["CLI_DIRECC"] = $row["CLI_DIRECC"];
                $output["CLI_CORREO"] = $row["CLI_CORREO"];

                $output["PATENTE"] = $row["PATENTE"];
                $output["MRC_NOM"] = $row["MRC_NOM"];
                $output["MOD_NOM"] = $row["MOD_NOM"];
                $output["TIPO_NOM"] = $row["TIPO_NOM"];
                $output["TIPO_SERV"] = $row["TIPO_SERV"];
                $output["ORDT_COMENT"] = $row["ORDT_COMENT"];
                $output["FECH_CREA"] = $row["FECH_CREA"];
                $output["KLM"] = $row["KLM"];

                $output["TEC_NOM"] = $row["TEC_NOM"];
                $output["COMISION_PORC"] = $row["COMISION_PORC"];
                $output["SUC_NOM"] = $row["SUC_NOM"];

                $output["ORDT_SUBTOTAL"] = $row["ORDT_SUBTOTAL"];
                $output["ORDT_IVA"] = $row["ORDT_IVA"];
                $output["ORDT_TOTALG"] = $row["ORDT_TOTALG"];
                $output["USU_ID"] = $row["USU_ID"];
                $output["USU_NOM"] = $row["USU_NOM"];
                $output["USU_APE"] = $row["USU_APE"];

                $output["EMP_NOM"] = $row["EMP_NOM"];
                $output["EMP_DIRECC"] = $row["EMP_DIRECC"];
                $output["EMP_RUC"] = $row["EMP_RUC"];
                $output["EMP_CORREO"] = $row["EMP_CORREO"];
                $output["EMP_PAG"] = $row["EMP_PAG"];
                $output["EMP_TELF"] = $row["EMP_TELF"];
            }
            echo json_encode($output);
      
        break;




         /*  TODO:MUESTRA LOS INTEMS Y SUS DETALLE EN ViewOrdent */
        case 'listar_detalles_items_ordent':
            $datos=$ordentrabajo->view_det_orden_x_ordt($_POST["ordt_id"]);
            foreach($datos as $row){ 
                ?>
                     <tr>
                        <td><?php echo $row["PROD_NOM"];?></td>
                        <td><?php echo $row["UND_NOM"];?></td>
                        <td><?php echo $row["PROD_PVENTA"];?></td>
                        <td style="text-align: center;"><?php echo $row["PROD_CANT"];?></td>
                        <td class="text-end"><?php echo $row["DETO_TOTALG"];?></td>
                    </tr>
                <?php
          
            }
            
        break;




        /* LISTADO DE PRODUCTOS Y SERVICIOS EN MODAL DE LISTADO DE OT */

        case "listar_detalles_items_modal":
            $datos=$ordentrabajo->view_det_orden_x_modal($_POST["ordt_id"]);
               $data=Array();
            foreach($datos as $row){
                $sub_array=array();
               /*  $sub_array[] = $row["CAT_NOM"]; */
                $sub_array[] = $row["PROD_NOM"];
                $sub_array[] = $row["UND_NOM"];
                $sub_array[] = $row["PROD_PVENTA"];
                $sub_array[] = $row["PROD_CANT"];
                $sub_array[] = $row["DETO_TOTALG"];
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            
        break;



       






    }

    ?>