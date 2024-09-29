<?php
   /* TODO:Llamamos las clases Conexion y Recepcion */
   require_once("../config/conexion.php");
   require_once("../models/Recepcion.php");

   /* TODO:Inicializamos la calse Recepcion */
   $recepcion = new Recepcion();


   /* TODO:Enviamos por Url los diferentes metodos y Parametros segun se el Case */
   switch ($_GET["op"]) { 


       /*  TODO:GUARDAR O EDITAR RECEPCION MODULO RECEPCIONS */
        case "guardar":
            /* TODO:Aplicamos Condicional si Recibimos parametro se Edita de lo contrario Se Registra */
            
                $recepcion->insert_recepcion(
                    $_POST["suc_id"],
                    $_POST["usu_id"],
                    $_POST["cli_id"],
                    $_POST["mrc_id"],
                    $_POST["mod_id"],
                    $_POST["tipo_id"],
                    $_POST["tipo_serv"],
                    $_POST["klm"],
                    $_POST["serialch"],
                    $_POST["patente"],
                    $_POST["luces"],
                    $_POST["rueda"],
                    $_POST["cases"],
                    $_POST["docs"],
                    $_POST["casco"],
                    $_POST["fuel"],
                    $_POST["tools"],
                    $_POST["otros"],
                    $_POST["coment"],
                    
                );
                             
                    
                    
            
            
        break;



        /* TODO:LISTAR RECEPCIONS EN DATATABLE MODULO RECEPCIONS */
        case "listar":
            $datos = $recepcion->get_recepcion_x_suc_id($_POST["suc_id"]);
            $data = Array();

            /*TODO:Realizamos un Barrido a todos los reg de Catgoria y los Almacenamos en un Array $ub_array */
            foreach($datos as $row){
            $sub_array = array();
            $sub_array[] = $row["RCN_ID"];
            $sub_array[]= $row["CLI_NOM"];
            $sub_array[]= $row["MRC_NOM"];
            $sub_array[]= $row["MOD_NOM"];
            $sub_array[] = $row["PATENTE"];
            $sub_array[] = $row["FECH_CREA"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["RCN_ID"].')" id="'.$row["RCN_ID"].'" class="btn btn-warning mx-auto"><i class="ri-edit-2-line"></i></button>';
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["RCN_ID"].')" id="'.$row["RCN_ID"].'" class="btn btn-danger"><i class="ri-delete-bin-5-line"></i></button>';
            $sub_array[] = '<a href="../ViewRecepcion/?r='.$row["RCN_ID"].'" target="_blank" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-printer-line"></i></a>';
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


        case "mostrando": 
            /* TODO:Alamcenamos la resultante de esta consulta en una variable $datos y asi envialo como un JSON */
             $datos = $recepcion->mostrando($_POST["rcn_id"]);
    
             /*TODO: Verificamos si es un Array y los datos son mayor a cero */
            if(is_array($datos)==true and count($datos)>0){
                /* TODO:Aplicamos un forearch asignando cada campo recibido de la db a una valor $output */
                foreach($datos as $row){
                    $output["RCN_ID"] = $row["RCN_ID"];
                    $output["SUC_ID"] = $row["SUC_ID"];
                    $output["USU_NOM"] = $row["USU_NOM"];
                    $output["CLI_ID"] = $row["CLI_ID"];
                    $output["CLI_NOM"] = $row["CLI_NOM"];
                    $output["CLI_RUC"] = $row["CLI_RUC"];
                    $output["CLI_TELF"] = $row["CLI_TELF"];
                    $output["CLI_DIRECC"] = $row["CLI_DIRECC"];
                    $output["CLI_CORREO"] = $row["CLI_CORREO"];
                    $output["MRC_ID"] = $row["MRC_ID"];
                    $output["MRC_NOM"] = $row["MRC_NOM"];
                    $output["MOD_ID"] = $row["MOD_ID"];
    
                    $output["MOD_NOM"] = $row["MOD_NOM"];
    
                    $output["TIPO_ID"] = $row["TIPO_ID"];
                    $output["TIPO_NOM"] = $row["TIPO_NOM"];
    
                    $output["TIPO_SERV"] = $row["TIPO_SERV"];
                    $output["KLM"] = $row["KLM"];
                    $output["SERIALCH"] = $row["SERIALCH"];
                    $output["PATENTE"] = $row["PATENTE"];
    
                    $output["LUCES"] = $row["LUCES"];
                    $output["RUEDA"] = $row["RUEDA"];
                    $output["CASES"] = $row["CASES"];
                    $output["DOCS"] = $row["DOCS"];
                    $output["CASCO"] = $row["CASCO"];
                    $output["FUEL"] = $row["FUEL"];
                    $output["TOOLS"] = $row["TOOLS"];
                    $output["OTROS"] = $row["OTROS"];
                    $output["COMENT"] = $row["COMENT"];
                    $output["FECH_CREA"] = $row["FECH_CREA"];
                   
                   
    
                   /*  /* TODO:Datos para la ruta de Imagen del recepcion */
                    /*  if($row["REC__IMG"] != ''){
                        $output["REC__IMG"] = '<img src="../../assets/images/recepcions/'.$row["REC__IMG"].'" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_recepcion_imagen" value="'.$row["REC__IMG"].'" />';
                    }else{ */
                        /* $output["REC__IMG"] = '<img src="../../assets/images/recepcions/no_image.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_recepcion_imagen" value="" />';
                    } */ 
    
                }
    
    
                /* TODO:Codificamos el resultado en un JSON y asi pasarlo a la vista Recepcion */
                echo json_encode($output);
            }
        break;



        /* TODO:MOSTAR DATOS DEL RECEPCION OPCION EDITAR DEL MODULO RECEPCION */
        case "imprimir": 
            /* TODO:Alamcenamos la resultante de esta consulta en una variable $datos y asi envialo como un JSON */
             $datos = $recepcion->print_recepcion_x_rcn_id($_POST["rcn_id"]);

             /*TODO: Verificamos si es un Array y los datos son mayor a cero */
            if(is_array($datos)==true and count($datos)>0){
                /* TODO:Aplicamos un forearch asignando cada campo recibido de la db a una valor $output */
                foreach($datos as $row){
                    $output["RCN_ID"] = $row["RCN_ID"];
                    $output["SUC_ID"] = $row["SUC_ID"];
                    $output["USU_NOM"] = $row["USU_NOM"];
                    $output["CLI_ID"] = $row["CLI_ID"];
                    $output["CLI_NOM"] = $row["CLI_NOM"];
                    $output["CLI_RUC"] = $row["CLI_RUC"];
                    $output["CLI_TELF"] = $row["CLI_TELF"];
                    $output["CLI_DIRECC"] = $row["CLI_DIRECC"];
                    $output["CLI_CORREO"] = $row["CLI_CORREO"];
                    $output["MRC_ID"] = $row["MRC_ID"];
                    $output["MRC_NOM"] = $row["MRC_NOM"];
                    $output["MOD_ID"] = $row["MOD_ID"];
                    $output["MOD_NOM"] = $row["MOD_NOM"];
                    $output["TIPO_ID"] = $row["TIPO_ID"];
                    $output["TIPO_NOM"] = $row["TIPO_NOM"];
                    $output["TIPO_SERV"] = $row["TIPO_SERV"];
                    $output["KLM"] = $row["KLM"];
                    $output["SERIALCH"] = $row["SERIALCH"];
                    $output["PATENTE"] = $row["PATENTE"];
                
                    /* LUCES */
                    if ($row["LUCES"] == 'on') {
                        $output["LUCES"] = 'NO';
                    }else if($row["LUCES"] == 'SI'){
                        $output["LUCES"] = 'SI';
                    };
                    
                    /* RUEDAS */
                    if ($row["RUEDA"] == 'on') {
                        $output["RUEDA"] = 'NO';
                    }else if($row["RUEDA"] =='SI'){
                        $output["RUEDA"] = 'SI';
                    };
                
                    /* CARCASAS DE MOTO */
                    if ($row["CASES"] == 'on') {
                        $output["CASES"] = 'NO';
                    }else if($row["CASES"] == 'SI'){
                        $output["CASES"] = 'SI';
                    }

                    /* DOCUMENTOS */
                    if ($row["DOCS"] == 'on') {
                        $output["DOCS"] = 'NO' ;
                    } else if ($row["DOCS"] == 'SI'){
                        $output["DOCS"] = 'SI' ;
                    }
                    
                    /* CASCO RECIBIDO */
                    if ($row["CASCO"] == 'on') {
                        $output["CASCO"] = 'NO';
                    } else if($row["CASCO"] == 'SI'){
                        $output["CASCO"] = 'SI';
                    }
                    
                    /* COMBUSTIBLE */
                    if ($row["FUEL"] == 'on') {
                        $output["FUEL"] = 'NO';
                    } else if($row["FUEL"] == 'SI'){
                        $output["FUEL"] = 'NO';
                    }                  
                
                     /* HERRAMIENTAS */
                    if ($row["TOOLS"] == 'on') {
                        $output["TOOLS"] = 'NO';
                    } else if($row["TOOLS"] == 'SI'){
                        $output["TOOLS"] = 'SI';
                    }
                    
                    /* OTROS DATOS */
                    if ($row["OTROS"] == 'on') {
                        $output["OTROS"] = 'NO';
                    } else if($row["OTROS"] == 'SI'){
                        $output["OTROS"] = 'SI';
                    }
                    
                    $output["COMENT"] = $row["COMENT"];
                    $output["FECH_CREA"] = $row["FECH_CREA"];
                   
                   

                   /*  /* TODO:Datos para la ruta de Imagen del recepcion */
                    /*  if($row["REC__IMG"] != ''){
                        $output["REC__IMG"] = '<img src="../../assets/images/recepcions/'.$row["REC__IMG"].'" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_recepcion_imagen" value="'.$row["REC__IMG"].'" />';
                    }else{ */
                        /* $output["REC__IMG"] = '<img src="../../assets/images/recepcions/no_image.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_recepcion_imagen" value="" />';
                    } */ 

                }


                /* TODO:Codificamos el resultado en un JSON y asi pasarlo a la vista Recepcion */
                echo json_encode($output);
            }
        break;

        /* TODO:MOSTAR DATOS DEL RECEPCION OPCION EDITAR DEL MODULO RECEPCION */
        


         /*  TODO:GUARDAR O EDITAR PRODUCTO MODULO PRODUCTOS */
        case "editar":
            /* TODO:Aplicamos Condicional si Recibimos parametro se Edita de lo contrario Se Registra */   
                $recepcion->update_recepcion_01(
                    $_POST["rcn_id"],
                    $_POST["mrc_id"],
                    $_POST["mod_id"],
                    $_POST["tipo_id"],
                    $_POST["tipo_serv"],
                    $_POST["klm"],
                    $_POST["serialch"],
                    $_POST["patente"],
   
                   
                );  
            
        break;


        /* TODO:OPCION ELIMINAR RECEPCION SEGUN REC__ID MODULO RECEPCIONS */
        case "eliminar":
            /* TODO: Cambiar Estado del Registro a  0  */
            $recepcion->delete_recepcion($_POST["rcn_id"]);

        break;


        case 'sendorden':
            /* TODO: recepcion enviada a Orden de Servicio */
            $recepcion->send_rcp_orden_servicio($_POST["rec_id"]);
            
        break;



        /* TODO: Listado de Recepcions PARA OPCION SELECT */
        case "combo";
            $datos=$recepcion->get_recepcion_x_rcn_id($_POST["suc_id"]);
            if(is_array($datos)==true and count($datos)>0){
            $html="";
            $html.="<option selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row["RCN_ID"]."'>".'N°: '.' '.$row["RCN_ID"].' - '.$row["CLI_NOM"]."</option>";
            }
            echo $html;
          }
        break;


    
   }


?>