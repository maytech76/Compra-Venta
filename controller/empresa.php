<?php
   /* TODO:Llamamos las clases Conexion y Empresa */
   require_once("../config/conexion.php");
   require_once("../models/Empresa.php");

   /* TODO:Inicializamos la calse Empresa */
   $empresa = new Empresa();


   /* TODO:Enviamos por Url los diferentes metodos y Parametros segun se el Case */
   switch ($_GET["op"]) { 


    
        case "guardaryeditar":
            /* TODO:Aplicamos Condicional si Recibimos parametro se Edita de lo contrario Se Registra */
            if(empty($_POST["emp_id"])){
                $empresa->insert_empresa(
                $_POST["com_id"], 
                $_POST["emp_nom"],
                $_POST["emp_ruc"],
                $_POST["emp_correo"],
                $_POST["emp_telf"],
                $_POST["emp_direcc"],
                $_POST["emp_pag"],
                $_POST["emp_img"],
            );
            }else{
                $empresa->update_empresa(
                $_POST["emp_id"],
                $_POST["com_id"],
                $_POST["emp_nom"],
                $_POST["emp_ruc"],
                $_POST["emp_correo"],
                $_POST["emp_telf"],
                $_POST["emp_direcc"],
                $_POST["emp_pag"],
                @$_POST["emp_img"],
                );
            }
            
        break;


        
        case "listar":
                $datos = $empresa->get_empresa($_POST["com_id"]);
                $data = Array();

            /*TODO:Realizamos un Barrido a todos los reg de Catgoria y los Almacenamos en un Array $ub_array */
            foreach($datos as $row){
                $sub_array = array();

                $sub_array[] = $row["EMP_ID"];

                if ($row["EMP_IMG"] !== ''){
                    $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                        "<div class='flex-shrink-0 me-2'>".
                            "<img src='../../assets/images/empresa/".$row["EMP_IMG"]."' alt='' class='avatar-xs rounded-circle'>".
                        "</div>".
                    "</div>";
                }else{
                    $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                        "<div class='flex-shrink-0 me-2'>".
                            "<img src='../../assets/images/empresa/no_image.jpg' alt='' class='avatar-xs rounded-circle'>".
                        "</div>".
                    "</div>";
                }
                $sub_array []= $row["EMP_NOM"];
                $sub_array []= $row["EMP_RUC"];
                $sub_array []= $row["FECH_CREA"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["EMP_ID"].')" id="'.$row["EMP_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["EMP_ID"].')" id="'.$row["EMP_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
                $data[] = $sub_array;

            
            }   

         /* TODO:Parametros necesario para enviar el total de registros de la consulta almacenada en $data y pasarlo al DataTable */
         $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);

            echo json_encode($results);
        break;



    
        case "mostrar": 
            /* TODO:Alamcenamos la resultante de esta consulta en una variable $datos y asi envialo como un JSON */
             $datos = $empresa->get_empresa_x_emp_id($_POST["emp_id"]);

             /*TODO: Verificamos si es un Array y los datos son mayor a cero */
            if(is_array($datos)==true and count($datos)>0){
                /* TODO:Aplicamos un forearch asignando cada campo recibido de la db a una valor $output */
                foreach($datos as $row){
                    $output["EMP_ID"] = $row["EMP_ID"];
                    $output["COM_ID"] = $row["COM_ID"];
                    $output["EMP_NOM"] = $row["EMP_NOM"];
                    $output["EMP_RUC"] = $row["EMP_RUC"];
                    $output["EMP_CORREO"]= $row["EMP_CORREO"];
                    $output["EMP_TELF"] =$row["EMP_TELF"];
                    $output["EMP_DIRECC"] = $row["EMP_DIRECC"];
                    $output["EMP_PAG"] = $row["EMP_PAG"];

                    /* TODO:Datos para la ruta de Imagen del producto */
                    if($row["EMP_IMG"] !=''){
                        $output["EMP_IMG"] = '<img src="../../assets/images/empresa/'.$row["EMP_IMG"].'"class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_empresa_imagen" value="'.$row["EMP_IMG"].'" />';
                    }else{
                        $output["EMP_IMG"] = '<img src="../../assets/images/empresa/no_image.jpg"class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_empresa_imagen" value="" />';
                    } 
                }
                /* TODO:Codificamos el resultado en un JSON y asi pasarlo a la vista Empresa */
                echo json_encode($output);
            }
        break;




        case "eliminar":
            $empresa->delete_empresa($_POST["emp_id"]);

        break;



         /* TODO: Listar Opciones de Empresa por Compañia   */
         case "combo";
            $datos=$empresa->get_empresa_x_com_id($_POST["com_id"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["EMP_ID"]."'>".$row["EMP_NOM"]."</option>";
                }
                echo $html;
            }
         break;

    
   }


?>