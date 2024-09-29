<?php
   /* TODO:Llamamos las clases Conexion y Tipo */
   require_once("../config/conexion.php");
   require_once("../models/Tipovehiculo.php");

   /* TODO:Inicializamos la calse Tipo */
   $tipo = new Tipovehiculo();


   /* TODO:Enviamos por Url los diferentes metodos y Parametros segun se el Case */
   switch ($_GET["op"]) { 


    
        case "guardaryeditar":
            /* TODO:Aplicamos Condicional si Recibimos parametro se Edita de lo contrario Se Registra */
            if(empty($_POST["tipo_id"])){
                $tipo->insert_tipo($_POST["suc_id"], $_POST["tipo_nom"]);
            }else{
                $tipo->update_tipo($_POST["tipo_id"],$_POST["suc_id"],$_POST["tipo_nom"]);
            }
            
        break;

        
        case "listar":
            $datos = $tipo->get_tipo_x_suc_id($_POST["suc_id"]);
            $data = Array();

            /*TODO:Realizamos un Barrido a todos los reg de Catgoria y los Almacenamos en un Array $ub_array */
           foreach($datos as $row){
            $sub_array = array();
            $sub_array []= $row["TIPO_ID"];
            $sub_array []= $row["TIPO_NOM"];
            $sub_array[] = $row["FECH_CREA"]; 
            $sub_array[] = '<button type="button" onClick="editar('.$row["TIPO_ID"].')" id="'.$row["TIPO_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["TIPO_ID"].')" id="'.$row["TIPO_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';  
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
             $datos = $tipo->get_tipo_x_tipo_id($_POST["tipo_id"]);

             /*TODO: Verificamos si es un Array y los datos son mayor a cero */
            if(is_array($datos)==true and count($datos)>0){
                /* TODO:Aplicamos un forearch asignando cada campo recibido de la db a una valor $output */
                foreach($datos as $row){
                    $output["TIPO_ID"] = $row["TIPO_ID"];
                    $output["SUC_ID"] = $row["SUC_ID"];
                    $output["TIPO_NOM"] = $row["TIPO_NOM"];
                }
                /* TODO:Codificamos el resultado en un JSON y asi pasarlo a la vista Tipo */
                echo json_encode($output);
            }
        break;
        


        case "eliminar":
            $tipo->delete_tipo($_POST["tipo_id"]);

        break;



         /* TODO: Listar Tipos por Sucursal Combo */
        case "combo":
            $datos=$tipo->get_tipo_x_suc_id($_POST["suc_id"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["TIPO_ID"]."'>".$row["TIPO_NOM"]."</option>";
                }
                echo $html;
            }
        break;

    
   }


?>