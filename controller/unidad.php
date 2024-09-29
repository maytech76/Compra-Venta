<?php
   /* TODO:Llamamos las clases Conexion y Unidad */
   require_once("../config/conexion.php");
   require_once("../models/Unidad.php");

   /* TODO:Inicializamos la calse Unidad */
   $unidad = new Unidad();


   /* TODO:Enviamos por Url los diferentes metodos y Parametros segun se el Case */
   switch ($_GET["op"]) { 


    
        case "guardaryeditar":
            /* TODO:Aplicamos Condicional si Recibimos parametro se Edita de lo contrario Se Registra */
            if(empty($_POST["und_id"])){
                $unidad->insert_unidad($_POST["suc_id"],$_POST["und_nom"]);
            }else{
                $unidad->update_unidad($_POST["und_id"],$_POST["suc_id"],$_POST["und_nom"]);
            }
            
        break;

        

        
        case "listar":
            $datos = $unidad->get_unidad_x_suc_id($_POST["suc_id"]);
            $data = Array();

            /*TODO:Realizamos un Barrido a todos los reg de Catgoria y los Almacenamos en un Array $ub_array */
            foreach($datos as $row){
            $sub_array = array();
            $sub_array[] = $row["UND_NOM"];
            $sub_array []= $row["FECH_CREA"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["UND_ID"].')" id="'.$row["UND_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["UND_ID"].')" id="'.$row["UND_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
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
             $datos = $unidad->get_unidad_x_und_id($_POST["und_id"]);

             /*TODO: Verificamos si es un Array y los datos son mayor a cero */
            if(is_array($datos)==true and count($datos)>0){
                /* TODO:Aplicamos un forearch asignando cada campo recibido de la db a una valor $output */
                foreach($datos as $row){
                    $output["UND_ID"] = $row["UND_ID"];
                    $output["SUC_ID"] = $row["SUC_ID"];
                    $output["UND_NOM"] = $row["UND_NOM"];
                }
                /* TODO:Codificamos el resultado en un JSON y asi pasarlo a la vista Unidad */
                echo json_encode($output);
            }
        break;



        case "eliminar":
            $unidad->delete_unidad($_POST["und_id"]);

        break;
        

         /* TODO: Listar Sucursales en SELECT - OPTION */
         case "combo";
            $datos=$unidad->get_unidad_x_suc_id($_POST["suc_id"]);
               if(is_array($datos)==true and count($datos)>0){
               $html="";
               $html.="<option selected>Seleccionar</option>";
             foreach($datos as $row){
                 $html.= "<option value='".$row["UND_ID"]."'>".$row["UND_NOM"]."</option>";
             }
             echo $html;
            }
         break;

    
   }


?>