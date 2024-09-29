<?php
  
  class Compania extends Conectar{

        /* TODO:Listado de Registros por Compañia*/
        public function get_compania(){

          $conectar=parent::Conexion();
          $sql="call SP_L_COMPANIA_01";
          $query=$conectar->prepare($sql);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }


        /* TODO:Mostrar Registro Especifico po com_id  */
        public function get_compania_x_com_id($com_id){

            $conectar=parent::Conexion();
            $sql="call SP_L_COMPANIA_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $com_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
         

        }
        


        /* TODO:Eliminar Registros por COM_ID */
        public function delete_compania($com_id){

            $conectar=parent::Conexion();
            $sql="call SP_D_COMPANIA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $com_id);
            $query->execute();
           

        }



        /* TODO:Insertar Nuevo Registro de Compania */
        public function insert_compania($com_nom){

          $conectar=parent::Conexion();
          $sql="call SP_I_COMPANIA_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $com_nom);
          $query->execute();
          
          

        }


        /* TODO:Actualizar Registro de compania por COM_ID */
        public function update_compania($com_id,$com_nom){

          $conectar=parent::Conexion();
          $sql="call SP_U_COMPANIA_01 (?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $com_id);
          $query->bindValue(2, $com_nom);
          $query->execute();

          

        }


  }


?>