<?php
  
  class Tipo_vehiculo extends Conectar{

        /* TODO:Listado de Registros por Sucursal*/
        public function get_tipo_vehiculo_x_suc_id($suc_id){
          $conectar=parent::Conexion();
          $sql="call SP_L_TIPO_VEHICULO_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1,$suc_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }
        

        /* TODO:Mostrar Registro Especifico por tipo_id para EDITAR  */
        public function get_tipo_vehiculo_x_tipo_id($tipo_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_TIPO_VEHICULO_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $tipo_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
         

        }


        /* TODO:Eliminar Registros por ID */
        public function delete_tipo_vehiculo($tipo_id){
            $conectar=parent::Conexion();
            $sql="call SP_D_TIPO_VEHICULO_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $tipo_id);
            $query->execute();
           

        }



        /* TODO:Insertar Nuevo Registro de Tipo_vehiculos */
        public function insert_tipo_vehiculo($suc_id, $tipo_nom){

          $conectar=parent::Conexion();
          $sql="call SP_I_TIPO_VEHICULO_01 (?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->bindValue(2, $tipo_nom);
          $query->execute();
          
          

        }

        

        /* TODO:Actualizar Registro de tipo_vehiculo por TIPO_ID */
        public function update_tipo_vehiculo($tipo_id, $suc_id, $tipo_nom){

          $conectar=parent::Conexion();
          $sql="call SP_U_TIPO_VEHICULO_01 (?, ?, ?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $tipo_id);
          $query->bindValue(2, $suc_id);
          $query->bindValue(3, $tipo_nom);
          $query->execute();

          

        }


  }


?>