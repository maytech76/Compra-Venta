<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Vendedor.php");
    /* TODO: Inicializando clase */
    $vendedor = new Vendedor();



    switch($_GET["op"]){

     /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
    case "guardaryeditar": /* (1- INSERTAR VENDEDOR) */
        if(empty($_POST["vend_id"])){
            $vendedor->insert_vendedor(
                $_POST["suc_id"],
                $_POST["vend_img"],
                $_POST["vend_nom"],
                $_POST["vend_correo"],
                $_POST["vend_rut"],
                $_POST["vend_telef"],
                $_POST["comision_porc"]
            );
          }else{
            $vendedor->update_vendedor(
                $_POST["vend_id"],
                $_POST["suc_id"],
                $_POST["vend_img"],
                $_POST["vend_nom"],
                $_POST["vend_correo"],
                $_POST["vend_rut"],
                $_POST["vend_telef"],
                $_POST["comision_porc"]
            );
          }
    break;



    case "listar":
            $datos=$vendedor->get_listar_vendedores_x_suc($_POST["suc_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();

                if ($row["VEND_IMG"] != ''){
                    $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                        "<div class='flex-shrink-0 me-2'>".
                            "<img src='../../assets/images/vendedores/".$row["VEND_IMG"]."' alt='' class='avatar-xs rounded-circle'>".
                        "</div>".
                    "</div>";
                }else{
                    $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                        "<div class='flex-shrink-0 me-2'>".
                            "<img src='../../assets/images/vendedores/not_photo.jpg' alt='' class='avatar-xs rounded-circle'>".
                        "</div>".
                    "</div>";
                }
                /* $sub_array[] = $row["VEND_ID"]; */
                $sub_array[] = $row["VEND_NOM"];
                $sub_array[] = $row["VEND_RUT"];
                $sub_array[] = $row["VEND_CORREO"];
                $sub_array[] = $row["VEND_TELEF"];
                $sub_array[] = '<p class = "text-center">'.$row["COMISION_PORC"].'%';
                /* $sub_array[] = $row["FECH_CREA"]; */
                
                $sub_array[] = '<button type="button" onClick="editar('.$row["VEND_ID"].')" id="'.$row["VEND_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["VEND_ID"].')" id="'.$row["VEND_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
    break;



     /* TODO:Mostrar informacion en el Modal de Vendedores segun su ID */
    case "mostrar":
            
        $datos=$vendedor->get_vendedor_x_vend_id($_POST["vend_id"]);
        if (is_array($datos)==true and count($datos)>0){
            foreach($datos as $row){
                $output["VEND_ID"] = $row["VEND_ID"];
                $output["SUC_ID"] = $row["SUC_ID"];

                if($row["VEND_IMG"] != ''){
                    $output["VEND_IMG"] = '<img src="../../assets/images/vendedores/'.$row["VEND_IMG"].'" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input  name="hidden_vendedor_imagen" value="'.$row["VEND_IMG"].'" />';
                }else{
                    $output["VEND_IMG"] = '<img src="../../assets/images/vendedores/not_photo.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_vendedor_imagen" value="" />';
                }
                $output["VEND_NOM"] = $row["VEND_NOM"];
                $output["VEND_CORREO"] = $row["VEND_CORREO"];
                $output["VEND_RUT"] = $row["VEND_RUT"];
                $output["VEND_TELEF"] = $row["VEND_TELEF"];
                $output["COMISION_PORC"] = $row["COMISION_PORC"];
                $output["COMISION_VALOR"] = $row["COMISION_VALOR"];
                 
            }
            echo json_encode($output);
        }
    break;
    

    case 'recibo_pago':

        $datos=$vendedor->datos_pagar_comision($_POST["vend_id"]);
        if (is_array($datos)==true and count($datos)>0){
            foreach($datos as $row){
                $output["VEND_ID"] = $row["VEND_ID"];
                $output["SUC_NOM"] = $row["SUC_NOM"];

               /*  if($row["VEND_IMG"] != ''){
                    $output["VEND_IMG"] = '<img src="../../assets/images/vendedores/'.$row["VEND_IMG"].'" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input  name="hidden_vendedor_imagen" value="'.$row["VEND_IMG"].'" />';
                }else{
                    $output["VEND_IMG"] = '<img src="../../assets/images/vendedores/not_photo.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_vendedor_imagen" value="" />';
                } */
                $output["VEND_NOM"] = $row["VEND_NOM"];
                $output["VEND_CORREO"] = $row["VEND_CORREO"];
                $output["VEND_RUT"] = $row["VEND_RUT"];
                $output["VEND_TELEF"] = $row["VEND_TELEF"];
                $output["COMISION_PORC"] = $row["COMISION_PORC"];
                $output["TOTAL_COMISION"] = $row["TOTAL_COMISION"];
                $output["COUNT_VENTAS"] = $row["COUNT_VENTAS"];
                $output["FECHA"] = $row["FECHA"];
               
                 
            }
            echo json_encode($output);
        }
        
    break;


        /* TODO: Cambiar Estado a 0 del Registro */
    case "eliminar";
            $vendedor->delete_vendedor($_POST["vend_id"]);
    break;


    /* TODO: Listado de Vendedodores */
    case "combo";
        $datos=$vendedor->get_vendedor_x_suc_id($_POST["suc_id"]);
        if(is_array($datos)==true and count($datos)>0){
        $html="";
        $html.="<option selected>Seleccionar</option>";
        foreach($datos as $row){
            $html.= "<option value='".$row["VEND_ID"]."'>".$row["VEND_NOM"]."</option>";
        }
        echo $html;
    }
    break;






    }





    ?>