<?php
   /* TODO:Llamamos las clases Conexion y Modelo */
   require_once("../config/conexion.php");
   require_once("../models/Modelo.php");

   /* TODO:Inicializamos la calse Modelo */
   $modelo = new Modelo();


   /* TODO:Enviamos por Url los diferentes metodos y Parametros segun se el Case */
   switch ($_GET["op"]) { 


    
        case "guardaryeditar":
            /* TODO:Aplicamos Condicional si Recibimos parametro se Edita de lo contrario Se Registra */
            if(empty($_POST["mod_id"])){
                $modelo->insert_modelo($_POST["suc_id"], $_POST["mod_nom"],$_POST["mrc_id"]);
            }else{
                $modelo->update_modelo($_POST["mod_id"],$_POST["suc_id"],$_POST["mod_nom"],$_POST["mrc_id"]);
            }
            
        break;


        case "guardaryeditar2":
            /* TODO:Aplicamos Condicional si Recibimos parametro se Edita de lo contrario Se Registra */
            if(empty($_POST["mod_id"])){
                $modelo->insert_modelo2(
                    $_POST["suc_id"], 
                    $_POST["mod_nom"],
                    $_POST["mrc2_id"]);
            }else{
                $modelo->update_modelo2(
                    $_POST["mod_id"],
                    $_POST["suc_id"],
                    $_POST["mod_nom"],
                    $_POST["mrc2_id"]);
            }
            
        break;

        
        case "listar":
            $datos = $modelo->get_modelo_x_suc_id($_POST["suc_id"]);
            $data = Array();

            /*TODO:Realizamos un Barrido a todos los reg de Catgoria y los Almacenamos en un Array $ub_array */
           foreach($datos as $row){
            $sub_array = array();
            $sub_array []= $row["MOD_ID"];
            $sub_array []= $row["MOD_NOM"];
            $sub_array []= $row["MRC_NOM"];
            $sub_array[] = $row["FECH_CREA"]; 
            $sub_array[] = '<button type="button" onClick="editar('.$row["MOD_ID"].')" id="'.$row["MOD_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["MOD_ID"].')" id="'.$row["MOD_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';  
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
             $datos = $modelo->get_modelo_x_mod_id($_POST["mod_id"]);

             /*TODO: Verificamos si es un Array y los datos son mayor a cero */
            if(is_array($datos)==true and count($datos)>0){
                /* TODO:Aplicamos un forearch asignando cada campo recibido de la db a una valor $output */
                foreach($datos as $row){
                    $output["MOD_ID"] = $row["MOD_ID"];
                    $output["MOD_NOM"] = $row["MOD_NOM"];
                    $output["MRC_ID"] = $row["MRC_ID"];
                    $output["SUC_ID"] = $row["SUC_ID"];
                }
                /* TODO:Codificamos el resultado en un JSON y asi pasarlo a la vista Modelo */
                echo json_encode($output);
            }
        break;
        


        case "eliminar":
            $modelo->delete_modelo($_POST["mod_id"]);

        break;



         /* TODO: Listar Modelos por Sucursal Combo */
        case "combo":
            $datos=$modelo->get_modelo_x_suc_id($_POST["suc_id"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["MOD_ID"]."'>".$row["MOD_NOM"]."</option>";
                }
                echo $html;
            }
        break;




         /* TODO: Listar Modelos por Sucursal Combo */
         case "combo2":
            $datos=$modelo->get_modelo_x_MRC_id($_POST["mrc_id"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option selected>Modelo...</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["MOD_ID"]."'>".$row["MOD_NOM"]."</option>";
                }
                echo $html;
            }
        break;

    
   }


?>