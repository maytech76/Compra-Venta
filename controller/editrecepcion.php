<?php
   /* TODO:Llamamos las clases Conexion y Categoria */
   require_once("../config/conexion.php");
   require_once("../models/Editrecepcion.php");

   /* TODO:Inicializamos la calse Categoria */
   $editrecepcion = new Editrecepcion();


   /* TODO:Enviamos por Url los diferentes metodos y Parametros segun se el Case */
   switch ($_GET["op"]) { 

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
    
        
       

    
   }


?>