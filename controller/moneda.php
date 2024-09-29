<?php
   /* TODO:Llamamos las clases Conexion y Moneda */
   require_once("../config/conexion.php");
   require_once("../models/Moneda.php");

   /* TODO:Inicializamos la calse Moneda */
   $moneda = new Moneda();


   /* TODO:Enviamos por Url los diferentes metodos y Parametros segun se el Case */
   switch ($_GET["op"]) { 


    
        case "guardaryeditar":
            /* TODO:Aplicamos Condicional si Recibimos parametro se Edita de lo contrario Se Registra */
            if(empty($_POST["mon_id"])){
                $moneda->insert_moneda($_POST["suc_id"], $_POST["mon_nom"], $_POST["mon_simb"]);
            }else{
                $moneda->update_moneda($_POST["mon_id"],$_POST["suc_id"],$_POST["mon_nom"], $_POST["mon_simb"]);
            }
            
        break;


        
        case "listar":
            $datos = $moneda->get_moneda_x_suc_id($_POST["suc_id"]);
            $data = Array();

            /*TODO:Realizamos un Barrido a todos los reg de Catgoria y los Almacenamos en un Array $ub_array */
            foreach($datos as $row){
            $sub_array = array();
            $sub_array []= $row["MON_NOM"];
            $sub_array []= $row["MON_SIMB"];
            $sub_array[] = $row["FECH_CREA"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["MON_ID"].')" id="'.$row["MON_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["MON_ID"].')" id="'.$row["MON_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
            $data[] = $sub_array;

            }
        
            /* TODO:Parametros necesario para enviar el total de registros de la consulta almacenada en $data y pasarlo al DataTable */
                $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);

            /* TODO:Codificamos el resultado en un JSON y asi pasarlo a la vista Moneda */
            echo json_encode($results);

        break;




    
        case "mostrar": 
            /* TODO:Alamcenamos la resultante de esta consulta en una variable $datos y asi envialo como un JSON */
             $datos = $moneda->get_moneda_x_mon_id($_POST["mon_id"]);

             /*TODO: Verificamos si es un Array y los datos son mayor a cero */
            if(is_array($datos)==true and count($datos)>0){
                /* TODO:Aplicamos un forearch asignando cada campo recibido de la db a una valor $output */
                foreach($datos as $row){
                    $output["MON_ID"] = $row["MON_ID"];
                    $output["SUC_ID"] = $row["SUC_ID"];
                    $output["MON_NOM"] = $row["MON_NOM"];
                    $output["MON_SIMB"] = $row["MON_SIMB"]; 
                }
                /* TODO:Codificamos el resultado en un JSON y asi pasarlo a la vista Moneda */
                echo json_encode($output);
            }
        break;





        case "eliminar":
            /* TODO: Eliminamos registro del listado  */
            $moneda->delete_moneda($_POST["mon_id"]);

        break;




       
         case "combo";
              /* TODO: Lista de Opciones de monedas por Sucursal para el Select */
            $datos=$moneda->get_moneda_x_suc_id($_POST["suc_id"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option value='0'selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["MON_ID"]."'>".$row["MON_NOM"]."</option>";
                }
                echo $html;
         }
         break;

    
   }


?>