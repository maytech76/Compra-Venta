<?php
   /* TODO:Llamamos las clases Conexion y Rol */
   require_once("../config/conexion.php");
   require_once("../models/Rol.php");

   /* TODO:Inicializamos la calse Rol */
   $rol = new Rol();


   /* TODO:Enviamos por Url los diferentes metodos y Parametros segun se el Case */
   switch ($_GET["op"]) { 


    
        case "guardaryeditar":
            /* TODO:Aplicamos Condicional si Recibimos parametro se Edita de lo contrario Se Registra */
            if(empty($_POST["rol_id"])){
                $rol->insert_rol($_POST["suc_id"], $_POST["rol_nom"]);
            }else{
                $rol->update_rol($_POST["rol_id"],$_POST["suc_id"],$_POST["rol_nom"]);
            }
            
        break;  
        

        
        case "listar":
            $datos = $rol->get_rol_x_suc_id($_POST["suc_id"]);
            $data = Array();

            /*TODO:Realizamos un Barrido a todos los reg de Catgoria y los Almacenamos en un Array $ub_array */
            foreach($datos as $row){
                $sub_array = array();
                $sub_array []= $row["ROL_NOM"];
                $sub_array []= $row["FECH_CREA"];
                $sub_array[] = '<button type="button" onClick="permiso('.$row["ROL_ID"].')" id="'.$row["ROL_ID"].'" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-settings-2-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="editar('.$row["ROL_ID"].')" id="'.$row["ROL_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["ROL_ID"].')" id="'.$row["ROL_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
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
             $datos = $rol->get_rol_x_rol_id($_POST["rol_id"]);

             /*TODO: Verificamos si es un Array y los datos son mayor a cero */
            if(is_array($datos)==true and count($datos)>0){
                /* TODO:Aplicamos un forearch asignando cada campo recibido de la db a una valor $output */
                foreach($datos as $row){
                    $output["ROL_ID"] = $row["ROL_ID"];
                    $output["SUC_ID"] = $row["SUC_ID"]; 
                    $output["ROL_NOM"] = $row["ROL_NOM"];
                }
                /* TODO:Codificamos el resultado en un JSON y asi pasarlo a la vista Rol */
                echo json_encode($output);
            }
        break;


        case "eliminar":
            $rol->delete_rol($_POST["rol_id"]);

        break;



         /* TODO: Listar SELECT-OPTION */
         case "combo";
            $datos=$rol->get_rol_x_suc_id($_POST["suc_id"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["ROL_ID"]."'>".$row["ROL_NOM"]."</option>";
                }
                echo $html;
            }
         break;



         /* Mostrar numero correlativo para Recepcion */
        case "correlativo":
                $datos = $rol->get_correlativo_recp();
                $data = Array();

                /*TODO:Realizamos un Barrido a todos los reg de Catgoria y los Almacenamos en un Array $ub_array */
            foreach($datos as $row){
            
                $results = $row["NUMERO"];  
                }   

                    echo($results);
        break;



         /* Mostrar numero correlativo para Orden de Trabajo */
        case "orden":
                $datos = $rol->get_correlativo_ot();
                $data = Array();

                /*TODO:Realizamos un Barrido a todos los reg de Catgoria y los Almacenamos en un Array $ub_array */
            foreach($datos as $row){
            
                $results = $row["NUMERO2"];  
                }   

                    echo($results);
        break;



        /* Mostrar numero correlativo para Orden de Trabajo para el registro */
        case "numero_ot":
                    $datos = $rol->get_correlativo_rg();
                    $data = Array();

                    /*TODO:Realizamos un Barrido a todos los reg de Catgoria y los Almacenamos en un Array $ub_array */
                foreach($datos as $row){
                
                    $results = $row["NUMERO_OT"];  
                    }   

                        echo($results);
        break;



        

    
   }


?>