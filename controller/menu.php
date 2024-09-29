<?php
   /* TODO:Llamamos las clases Conexion y Menu */
   require_once("../config/conexion.php");
   require_once("../models/Menu.php");

   /* TODO:Inicializamos la calse Menu */
   $menu = new Menu();


   /* TODO:Enviamos por Url los diferentes metodos y Parametros segun se el Case */
   switch ($_GET["op"]) { 


    
        
        case "listar":
                $datos = $menu->get_menu_x_rol_id($_POST["rol_id"]);
                $data = Array();

            /*TODO:Realizamos un Barrido a todos los reg de Catgoria y los Almacenamos en un Array $ub_array */
            foreach($datos as $row){
                $sub_array = array();
               
            
                $sub_array []= $row["MEN_NOM"];

                if ($row["MEND_PERMI"]=="Si"){
                    $sub_array[] = '<button type="button"  onClick="deshabilitar('.$row["MEND_ID"].')" id="'.$row["MEND_ID"].'" class="btn btn-success btn-label btn-sm"><i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i>'.$row["MEND_PERMI"].'</button>';
                }else{
                    $sub_array[] = '<button type="button" onClick="habilitar('.$row["MEND_ID"].')" id="'.$row["MEND_ID"].'" class="btn btn-danger btn-label btn-sm"><i class="ri-close-circle-line label-icon align-middle fs-16 me-2"></i> '.$row["MEND_PERMI"].'</button>';
                }
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

         /* TODO: habilitar permiso */
         case "habilitar":
            $menu->update_menu_habilitar($_POST["mend_id"]);
            break;




        /* TODO: deshabilitar permiso */
        case "deshabilitar":
            $menu->update_menu_deshabilitar($_POST["mend_id"]);
            break;

            

        /* TODO: Registrar Nueva opcion menu el listado de Modulos del Rol de usuario*/
        case "insert_new_modulo":
            $menu = new Menu();
            $menu->insert_menu_detalle_x_rol_id($_POST["rol_id"]);
        break; 





    
       
    
   }


?>