<?php
   /* TODO:Llamamos las clases Conexion y Proveedor */
   require_once("../config/conexion.php");
   require_once("../models/Proveedor.php");

   /* TODO:Inicializamos la calse Proveedor */
   $proveedor = new Proveedor();


   /* TODO:Enviamos por Url los diferentes metodos y Parametros segun se el Case */
   switch ($_GET["op"]) { 


    
        case "guardaryeditar":
            /* TODO:Aplicamos Condicional si Recibimos parametro se Edita de lo contrario Se Registra */
            if(empty($_POST["prov_id"])){
                $proveedor->insert_proveedor(
                    $_POST["emp_id"],
                    $_POST["prov_nom"],
                    $_POST["prov_ruc"],
                    $_POST["prov_telf"],
                    $_POST["prov_direcc"],
                    $_POST["prov_correo"]);
            }else{
                $proveedor->update_proveedor(
                    $_POST["prov_id"],
                    $_POST["emp_id"],
                    $_POST["prov_nom"],
                    $_POST["prov_ruc"],
                    $_POST["prov_telf"],
                    $_POST["prov_direcc"],
                    $_POST["prov_correo"]);
            }
            
        break;

        
        case "listar":
            $datos = $proveedor->get_proveedor_x_emp_id($_POST["emp_id"]);
            $data = Array();

            /*TODO:Realizamos un Barrido a todos los reg de Catgoria y los Almacenamos en un Array $ub_array */
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["PROV_NOM"];
                $sub_array[] = $row["PROV_RUC"];
                $sub_array[] = $row["PROV_TELF"];
                $sub_array[] = $row["PROV_CORREO"];
                $sub_array[] = $row["FECH_CREA"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["PROV_ID"].')" id="'.$row["PROV_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["PROV_ID"].')" id="'.$row["PROV_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';  
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
                $datos = $proveedor->get_proveedor_x_prov_id($_POST["prov_id"]);

                /*TODO: Verificamos si es un Array y los datos son mayor a cero */
                if(is_array($datos)==true and count($datos)>0){
                    /* TODO:Aplicamos un forearch asignando cada campo recibido de la db a una valor $output */
                    foreach($datos as $row){
                        $output["PROV_ID"] = $row["PROV_ID"];
                        $output["EMP_ID"] = $row["EMP_ID"];
                        $output["PROV_NOM"] = $row["PROV_NOM"];
                        $output["PROV_RUC"] = $row["PROV_RUC"];
                        $output["PROV_TELF"] = $row["PROV_TELF"];
                        $output["PROV_DIRECC"] = $row["PROV_DIRECC"];
                        $output["PROV_CORREO"] = $row["PROV_CORREO"];
                    
                    }
                    /* TODO:Codificamos el resultado en un JSON y asi pasarlo a la vista Proveedor */
                    echo json_encode($output);
                }
        break;




        case "eliminar":
            $proveedor->delete_proveedor($_POST["prov_id"]);

        break;

          /* TODO: Listado de Proveedor Select-option */
          case "combo";
                $datos=$proveedor->get_proveedor_x_emp_id($_POST["emp_id"]);
                if(is_array($datos)==true and count($datos)>0){
                    $html="";
                    $html.="<option value='0' selected>Seleccionar</option>";
                    foreach($datos as $row){
                        $html.= "<option value='".$row["PROV_ID"]."'>".$row["PROV_NOM"]."</option>";
                    }
                    echo $html;
                }
          break;

    
   }


?>