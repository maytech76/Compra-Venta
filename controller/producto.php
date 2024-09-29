<?php
   /* TODO:Llamamos las clases Conexion y Producto */
   require_once("../config/conexion.php");
   require_once("../models/Producto.php");

   /* TODO:Inicializamos la calse Producto */
   $producto = new Producto();


   /* TODO:Enviamos por Url los diferentes metodos y Parametros segun se el Case */
   switch ($_GET["op"]) { 


       /*  TODO:GUARDAR O EDITAR PRODUCTO MODULO PRODUCTOS */
        case "guardaryeditar":
            /* TODO:Aplicamos Condicional si Recibimos parametro se Edita de lo contrario Se Registra */
            if(empty($_POST["prod_id"])){
                $producto->insert_producto(
                    $_POST["suc_id"],
                    $_POST["cat_id"],
                    $_POST["prod_nom"],
                    $_POST["prod_descrip"],
                    $_POST["und_id"],
                    $_POST["mon_id"],
                    $_POST["prod_pcompra"],
                    $_POST["prod_pventa"],
                    $_POST["prod_stock"],
                    $_POST["prod_img"],
                    $_POST["code_barr"],
                    $_POST["costosadd"],
                    $_POST["utilidad"]
                
                );
                    
                    
            }else{
                $producto->update_producto(
                    $_POST["prod_id"],
                    $_POST["suc_id"],
                    $_POST["cat_id"],
                    $_POST["prod_nom"],
                    $_POST["prod_descrip"],
                    $_POST["und_id"],
                    $_POST["mon_id"],
                    $_POST["prod_pcompra"],
                    $_POST["prod_pventa"],
                    $_POST["prod_stock"],
                    $_POST["prod_img"],
                    $_POST["code_barr"],
                    $_POST["costosadd"],
                    $_POST["utilidad"]

                    
                );
                    
                    
            }
            
        break;



        /* TODO:LISTAR PRODUCTOS EN DATATABLE MODULO PRODUCTOS */
        case "listar":
            $datos = $producto->get_producto_x_suc_id($_POST["suc_id"]);
            $data = Array();

            /*TODO:Realizamos un Barrido a todos los reg de Catgoria y los Almacenamos en un Array $ub_array */
            foreach($datos as $row){
            $sub_array = array();
            if ($row["PROD_IMG"] != ''){
                $sub_array[] =
                "<div class='d-flex align-items-center'>" .
                    "<div class='flex-shrink-0 me-2'>".
                        "<img src='../../assets/images/productos/".$row["PROD_IMG"]."' alt='' class='avatar-xs rounded-circle'>".
                    "</div>".
                "</div>";
            }else{
                $sub_array[] =
                "<div class='d-flex align-items-center'>" .
                    "<div class='flex-shrink-0 me-2'>".
                        "<img src='../../assets/images/productos/no_image.png' alt='' class='avatar-xs rounded-circle'>".
                    "</div>".
                "</div>";
            }
           
            $sub_array[] = $row["PROD_NOM"];
            $sub_array[]= $row["PROD_PCOMPRA"];
            $sub_array[]= $row["PROD_PVENTA"];
           /*  $sub_array[] = $row["MON_NOM"]; */
            $sub_array[] = '<p class = "text-center">'.$row["PROD_STOCK"].'</p>';
            $sub_array[] = $row["UND_NOM"];
            /* $sub_array[] = $row["FECH_CREA"]; */
            $sub_array[] = '<button type="button" onClick="editar('.$row["PROD_ID"].')" id="'.$row["PROD_ID"].'" class="btn btn-warning mx-auto"><i class="ri-edit-2-line"></i></button>';
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["PROD_ID"].')" id="'.$row["PROD_ID"].'" class="btn btn-danger"><i class="ri-delete-bin-5-line"></i></button>';
            $sub_array[] = '<button type="button" onClick="ver('.$row["PROD_ID"].')" id="'.$row["PROD_ID"].'" class="btn btn-success"><i class="ri-settings-2-line"></i></button>';
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



        /* TODO:MOSTAR DATOS DEL PRODUCTO OPCION EDITAR DEL MODULO PRODUCTO */
        case "mostrar": 
            /* TODO:Alamcenamos la resultante de esta consulta en una variable $datos y asi enviarlo como un JSON */
             $datos = $producto->get_producto_x_prod_id($_POST["prod_id"]);

             /*TODO: Verificamos si es un Array y los datos son mayor a cero */
            if(is_array($datos)==true and count($datos)>0){
                /* TODO:Aplicamos un forearch asignando cada campo recibido de la db a una valor $output */
                foreach($datos as $row){
                    $output["PROD_ID"] = $row["PROD_ID"];
                    $output["PROD_NOM"] = $row["PROD_NOM"];
                    $output["SUC_ID"] = $row["SUC_ID"];
                    $output["PROD_DESCRIP"] = $row["PROD_DESCRIP"];
                    $output["CAT_ID"] = $row["CAT_ID"];
                    $output["UND_ID"] = $row["UND_ID"];
                    $output["UND_NOM"] = $row["UND_NOM"];
                    $output["MON_ID"] = $row["MON_ID"];
                    $output["PROD_PCOMPRA"] = $row["PROD_PCOMPRA"];
                    $output["PROD_PVENTA"] = $row["PROD_PVENTA"];
                    $output["PROD_STOCK"] = $row["PROD_STOCK"];
                    $output["CODE_BARR"] = $row["CODE_BARR"];
                    $output["COSTOSADD"] = $row["COSTOSADD"];
                    $output["UTILIDAD"] = $row["UTILIDAD"];
                   

                    /* TODO:Datos para la ruta de Imagen del producto */
                     if($row["PROD_IMG"] != ''){
                        $output["PROD_IMG"] = '<img src="../../assets/images/productos/'.$row["PROD_IMG"].'" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_producto_imagen" value="'.$row["PROD_IMG"].'" />';
                    }else{
                        $output["PROD_IMG"] = '<img src="../../assets/images/productos/no_image.png" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_producto_imagen" value="" />';
                    } 
                }
                /* TODO:Codificamos el resultado en un JSON y asi pasarlo a la vista Producto */
                echo json_encode($output);
            }
        break;



        /* TODO:OPCION ELIMINAR PRODUCTO SEGUN PROD_ID MODULO PRODUCTOS */
        case "eliminar":
            /* TODO: Cambiar Estado del Registro a  0  */
            $producto->delete_producto($_POST["prod_id"]);

        break;



        /* TODO: Listado de Productos PARA OPCION SELECT */
        case "combo";
            $datos=$producto->get_producto_x_cat_id($_POST["cat_id"]);
            if(is_array($datos)==true and count($datos)>0){
            $html="";
            $html.="<option selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row["PROD_ID"]."'>".$row["PROD_NOM"]."</option>";
            }
            echo $html;
          }
        break;


    
   }


?>