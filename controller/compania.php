<?php
   /* TODO:Llamamos las clases Conexion y Compania */
   require_once("../config/conexion.php");
   require_once("../models/Compania.php");

   /* TODO:Inicializamos la calse Compania */
   $compania = new Compania();


   /* TODO:Enviamos por Url los diferentes metodos y Parametros segun se el Case */
   switch ($_GET["op"]) { 


    
        case "guardaryeditar":
            /* TODO:Aplicamos Condicional si Recibimos parametro se Edita de lo contrario Se Registra */
            if(empty($_POST["com_id"])){
                $compania->insert_compania($_POST["com_nom"]);
            }else{
                $compania->update_compania($_POST["com_id"],$_POST["com_nom"]);
            }
            
        break;

        
        case "listar":
        $datos = $compania->get_compania();
        $data = Array();

        /*TODO:Realizamos un Barrido a todos los reg de Categoria y los Almacenamos en un Array $ub_array */
        foreach($datos as $row){
            $sub_array = array();
            $sub_array = $row["COM_NOM"];
            $sub_array = "Editar";
            $sub_array = "Eliminar";
            $data[] = $sub_array;

            /* TODO:Parametros necesario para enviar el total de registros de la consulta almacenada en $data y pasarlo al DataTable */
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
        }   
        break;


    
        case "mostrar": 
            /* TODO:Alamcenamos la resultante de esta consulta en una variable $datos y asi envialo como un JSON */
             $datos = $compania->get_compania_x_com_id($_POST["com_id"]);

             /*TODO: Verificamos si es un Array y los datos son mayor a cero */
            if(is_array($datos)==true and count($datos)>0){
                /* TODO:Aplicamos un forearch asignando cada campo recibido de la db a una valor $output */
                foreach($datos as $row){
                    $output["com_id"] = $row["com_id"];
                    $output["com_nom"] = $row["com_nom"];
                }
                /* TODO:Codificamos el resultado en un JSON y asi pasarlo a la vista Compania */
                echo json_encode($output);
            }
        break;


        case "eliminar":
            $compania->delete_compania($_POST["com_id"]);

        break;

    
   }


?>