<?php
   /* TODO:Llamamos las clases Conexion y Cliente */
   require_once("../config/conexion.php");
   require_once("../models/Cliente.php");

   /* TODO:Inicializamos la calse Cliente */
   $cliente = new Cliente();


   /* TODO:Enviamos por Url los diferentes metodos y Parametros segun se el Case */
   switch ($_GET["op"]) { 


    
        case "guardaryeditar":
            /* TODO:Aplicamos Condicional si Recibimos parametro se Edita de lo contrario Se Registra */
            if(empty($_POST["cli_id"])){
                $cliente->insert_cliente(
                    $_POST["emp_id"],
                    $_POST["cli_nom"],
                    $_POST["cli_ruc"],
                    $_POST["cli_telf"],
                    $_POST["cli_direcc"],
                    $_POST["cli_correo"]);
            }else{
                $cliente->update_cliente(
                    $_POST["cli_id"],
                    $_POST["emp_id"],
                    $_POST["cli_nom"],
                    $_POST["cli_ruc"],
                    $_POST["cli_telf"],
                    $_POST["cli_direcc"],
                    $_POST["cli_correo"]);
            }
            
        break;

        
        case "listar":
            $datos = $cliente->get_cliente_x_emp_id($_POST["emp_id"]);
            $data = Array();

            /*TODO:Realizamos un Barrido a todos los reg de Catgoria y los Almacenamos en un Array $ub_array */
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["CLI_NOM"];
                $sub_array[] = $row["CLI_RUC"];
                $sub_array[] = $row["CLI_TELF"];
                $sub_array []= $row["CLI_CORREO"];
                $sub_array []= $row["FECH_CREA"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["CLI_ID"].')" id="'.$row["CLI_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line text-center"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["CLI_ID"].')" id="'.$row["CLI_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light text-center"><i class="ri-delete-bin-5-line text-center"></i></button>';
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
             $datos = $cliente->get_cliente_x_cli_id($_POST["cli_id"]);

             /*TODO: Verificamos si es un Array y los datos son mayor a cero */
            if(is_array($datos)==true and count($datos)>0){
                /* TODO:Aplicamos un forearch asignando cada campo recibido de la db a una valor $output */
                foreach($datos as $row){
                    $output["CLI_ID"] = $row["CLI_ID"];
                    $output["EMP_ID"] = $row["EMP_ID"];
                    $output["CLI_NOM"] = $row["CLI_NOM"];
                    $output["CLI_RUC"] = $row["CLI_RUC"];
                    $output["CLI_TELF"] = $row["CLI_TELF"];
                    $output["CLI_CORREO"] = $row["CLI_CORREO"];
                    $output["CLI_DIRECC"] = $row["CLI_DIRECC"];
                  
                }
                /* TODO:Codificamos el resultado en un JSON y asi pasarlo a la vista Cliente */
                echo json_encode($output);
            }
        break;


        case "eliminar":
            $cliente->delete_cliente($_POST["cli_id"]);

        break;



        /* TODO: Opciones de  Listado de Clientes para Select */
        case "combo";
            $datos=$cliente->get_cliente_x_emp_id($_POST["emp_id"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option value='0' selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["CLI_ID"]."'>".$row["CLI_NOM"]."</option>";
                }
                echo $html;
            }
            break;

    
   }


?>