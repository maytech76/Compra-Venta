<?php

class Editrecepcion extends Conectar{


        /* ESTA FUNCION SE EJECUTA AL CLICK DEL BOTON EDITAR DEL DATA TABLE */
        /* TODO:Mostrar Registro Especifico por rcn_id  */
        public function mostrando($rcn_id){

            $conectar=parent::Conexion();
            $sql="call SP_LIST_RECEPCION_SERV_03 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$rcn_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

}



?>