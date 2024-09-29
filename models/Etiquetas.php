<?php
  
  class Etiqueta extends Conectar{

        /* TODO:Listado de Registros en Datatable principal*/
        public function get_etiqueta_producto(){

          $conectar=parent::Conexion();
          $sql="call SP_L_ETIQUETA_01 (?)";
          $query=$conectar->prepare($sql);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
        }



    }



?>