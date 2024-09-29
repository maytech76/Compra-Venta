<?php
/* TODO:Llamamos las clases Conexion y Producto */
require_once("../config/conexion.php");
require_once("../models/Etiqueta.php");

/* TODO:Inicializamos la calse Producto */
$etiqueta = new Etiqueta();

 /* TODO:Enviamos por Url los diferentes metodos y Parametros segun se el Case */
 switch ($_GET["op"]) {

    case 'mostrar_eiqueta':
        $datos=$etiqueta->get_etiqueta_producto();
        while($datos = $row){
          
            $output["CODE_BARR"] = $row["CODE_BARR"];
    
    break;

        }
/* TODO:Codificamos el resultado en un JSON y asi pasarlo a la vista Producto */
echo json_encode($output);



  }


?>
