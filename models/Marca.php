<?php
  
  class Marca extends Conectar{

        /* TODO:Listado de Registros por Sucursal*/
        public function get_marca_x_suc_id($suc_id){
          $conectar=parent::Conexion();
          $sql="call SP_L_MARCA_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1,$suc_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }

        /* TODO:Listado de Registros por Sucursal*/
        public function get_marca2_x_suc_id($suc_id){
          $conectar=parent::Conexion();
          $sql="call SP_L_MARCA_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1,$suc_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }
        

        /* TODO:Mostrar Registro Especifico por mrc_id para EDITAR  */
        public function get_marca_x_mrc_id($mrc_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_MARCA_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $mrc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
         

        }


        /* TODO:Eliminar Registros por ID */
        public function delete_marca($mrc_id){
            $conectar=parent::Conexion();
            $sql="call SP_D_MARCA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $mrc_id);
            $query->execute();
           

        }



        /* TODO:Insertar Nuevo Registro de Marcas */
        public function insert_marca($suc_id, $mrc_nom){

          $conectar=parent::Conexion();
          $sql="call SP_I_MARCA_01 (?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->bindValue(2, $mrc_nom);
          $query->execute();
            

        }


        

         /* TODO:Insertar Nuevo Registro de Marcas */
         public function insert_marca2($suc_id, $mrc_nom){

          $conectar=parent::Conexion();
          $sql="call SP_I_MARCA_01 (?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->bindValue(2, $mrc_nom);
          $query->execute();
            

        }

        /* TODO:Actualizar Registro de marca por MRC_ID */
        public function update_marca($mrc_id, $mrc_nom, $suc_id){

          $conectar=parent::Conexion();
          $sql="call SP_U_MARCA_01 (?, ?, ?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $mrc_id);
          $query->bindValue(2, $mrc_nom);
          $query->bindValue(3, $suc_id);
          $query->execute();
  

        }

         /* TODO:Actualizar Registro de marca por MRC_ID */
         public function update_marca2($mrc_id, $mrc_nom, $suc_id){

          $conectar=parent::Conexion();
          $sql="call SP_U_MARCA_01 (?, ?, ?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $mrc_id);
          $query->bindValue(2, $mrc_nom);
          $query->bindValue(3, $suc_id);
          $query->execute();
  

        }


  }


?>