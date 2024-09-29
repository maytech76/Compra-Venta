<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Tecnico.php");
    /* TODO: Inicializando clase */
    $tecnico = new Tecnico();

    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
        case "guardaryeditar":
            if(empty($_POST["tec_id"])){
                $tecnico->insert_tecnico(
                    $_POST["suc_id"],
                    $_POST["tec_nom"],
                    $_POST["tec_ape"],
                    $_POST["tec_doc"],
                    $_POST["tec_celular"],
                    $_POST["tec_correo"],
                    $_POST["comision_porc"],
                    $_POST["tec_img"]
                );
              }else{
                $tecnico->update_tecnico(
                    $_POST["tec_id"],
                    $_POST["suc_id"],
                    $_POST["tec_nom"],
                    $_POST["tec_ape"],
                    $_POST["tec_doc"],
                    $_POST["tec_celular"],
                    $_POST["tec_correo"],
                    $_POST["comision_porc"],
                    $_POST["tec_img"]
                );
              }
        break;


        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar":
                $datos=$tecnico->get_tecnico_x_suc_id($_POST["suc_id"]);
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();

                     if ($row["TEC_IMG"] != ''){
                        $sub_array[] =
                        "<div class='d-flex align-items-center'>".
                            "<div class='flex-shrink-0 me-2'>".
                                "<img src='../../assets/images/tecnicos/".$row["TEC_IMG"]."' alt='' class='avatar-xs rounded-circle'>".
                            "</div>".
                        "</div>";
                    }else{
                        $sub_array[] =
                        "<div class='d-flex align-items-center'>".
                            "<div class='flex-shrink-0 me-2'>".
                                "<img src='../../assets/images/tecnicos/not_photo.jpg' alt='' class='avatar-xs rounded-circle'>".
                            "</div>".
                        "</div>"; 
                    }
                    $sub_array[] = $row["TEC_NOM"];
                    $sub_array[] = $row["TEC_DOC"];
                    $sub_array[] = $row["COMISION_PORC"];  
                    $sub_array[] = $row["FECH_CREA"];
                    $sub_array[] = '<button type="button" onClick="editar('.$row["TEC_ID"].')" id="'.$row["TEC_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["TEC_ID"].')" id="'.$row["TEC_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
                    $data[] = $sub_array;
                }

                    $results = array(
                        "sEcho"=>1,
                        "iTotalRecords"=>count($data),
                        "iTotalDisplayRecords"=>count($data),
                        "aaData"=>$data);
                    echo json_encode($results);
        break;




        /* TODO:Mostrar informacion de registro segun su ID */
        case "mostrar":
            
                $datos=$tecnico->get_tecnico_x_tec_id($_POST["tec_id"]);
                if (is_array($datos)==true and count($datos)>0){
                    foreach($datos as $row){
                        $output["TEC_ID"] = $row["TEC_ID"];
                        $output["SUC_ID"] = $row["SUC_ID"];
                        $output["TEC_NOM"] = $row["TEC_NOM"];
                        $output["TEC_APE"] = $row["TEC_APE"];
                        $output["TEC_DOC"] = $row["TEC_DOC"];
                        $output["TEC_CELULAR"] = $row["TEC_CELULAR"];
                        $output["TEC_CORREO"] = $row["TEC_CORREO"];
                        $output["COMISION_PORC"] = $row["COMISION_PORC"];
                        $output["COMISION_VALOR"] = $row["COMISION_VALOR"];
                        
                         if($row["TEC_IMG"] != ''){
                            $output["TEC_IMG"] = '<img src="../../assets/images/tecnicos/'.$row["TEC_IMG"].'" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_tecnico_imagen" value="'.$row["TEC_IMG"].'" />';
                        }else{
                            $output["TEC_IMG"] = '<img src="../../assets/images/tecnicos/not_photo.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_tecnico_imagen" value="" />';
                        } 
                    }
                    echo json_encode($output);
                }
        break;

        case 'recibo_pago':

            $datos=$tecnico->datos_pagar_comision2($_POST["tec_id"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["TEC_ID"] = $row["TEC_ID"];
                    $output["SUC_NOM"] = $row["SUC_NOM"];
    
                   /*  if($row["VEND_IMG"] != ''){
                        $output["VEND_IMG"] = '<img src="../../assets/images/vendedores/'.$row["VEND_IMG"].'" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input  name="hidden_vendedor_imagen" value="'.$row["VEND_IMG"].'" />';
                    }else{
                        $output["VEND_IMG"] = '<img src="../../assets/images/vendedores/not_photo.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_vendedor_imagen" value="" />';
                    } */
                    $output["TEC_NOM"] = $row["TEC_NOM"];
                    $output["TEC_CORREO"] = $row["TEC_CORREO"];
                    $output["TEC_DOC"] = $row["TEC_DOC"];
                    $output["TEC_CELULAR"] = $row["TEC_CELULAR"];
                    $output["COMISION_PORC"] = $row["COMISION_PORC"];
                    $output["TOTAL_COMISION"] = $row["TOTAL_COMISION"];
                    $output["COUNT_OT"] = $row["COUNT_OT"];
                    $output["FECHA"] = $row["FECHA"];
                   
                     
                }
                echo json_encode($output);
            }
            
        break;





        /* TODO: Cambiar Estado a 0 del Registro  ## ELIMINAR DE LISTAR*/
        case "eliminar";
            $tecnico->delete_tecnico($_POST["tec_id"]);
        break;


        /* TODO:Actualizar contraseña del Tecnico */
        case "actualizar";
            $tecnico->update_tecnico_pass($_POST["tec_id"],$_POST["tec_pass"]);
        break;


        /* TODO: Listado de Productos */
        case "combo";
            $datos=$tecnico->get_tecnico_x_suc_id($_POST["suc_id"]);
            if(is_array($datos)==true and count($datos)>0){
            $html="";
            $html.="<option selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row["TEC_ID"]."'>".$row["TEC_NOM"]."</option>";
            }
            echo $html;
          }
        break;

       

    }
?>