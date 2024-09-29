<?php
  
  class Modelo extends Conectar{

        /* TODO:Listado de Registros por Sucursal*/
        public function get_modelo_x_suc_id($suc_id){
          $conectar=parent::Conexion();
          $sql="call SP_L_MODELO_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1,$suc_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }


         /* TODO:Listado de Registros por Sucursal*/
         public function get_modelo_x_mrc_id($mrc_id){
          $conectar=parent::Conexion();
          $sql="call SP_L_MODELO_03 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1,$mrc_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }
        

        /* TODO:Mostrar Registro Especifico por mod_id para EDITAR  */
        public function get_modelo_x_mod_id($mod_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_MODELO_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $mod_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
         

        }


        /* TODO:Eliminar Registros por ID */
        public function delete_modelo($mod_id){
            $conectar=parent::Conexion();
            $sql="call SP_D_MODELO_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $mod_id);
            $query->execute();
           

        }



        /* TODO:Insertar Nuevo Registro de Modelos */
        public function insert_modelo($suc_id, $mod_nom, $mrc_id){

          $conectar=parent::Conexion();
          $sql="call SP_I_MODELO_01 (?,?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->bindValue(2, $mod_nom);
          $query->bindValue(3, $mrc_id);
          $query->execute();
          
          

        }

        /* TODO:Actualizar Registro de modelo por MOD_ID */
        public function update_modelo($mod_id, $suc_id, $mod_nom, $mrc_id){

          $conectar=parent::Conexion();
          $sql="call SP_U_MODELO_01 (?, ?, ?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $mod_id);
          $query->bindValue(2, $suc_id);
          $query->bindValue(3, $mod_nom);
          $query->bindValue(4, $mrc_id);
          $query->execute();

          

        }


         /* TODO:Insertar Nuevo Registro de Modelos */
         public function insert_modelo2($suc_id, $mod_nom, $mrc2_id){

          $conectar=parent::Conexion();
          $sql="call SP_I_MODELO_01 (?,?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->bindValue(2, $mod_nom);
          $query->bindValue(3, $mrc2_id);
          $query->execute();
          
          

        }

        /* TODO:Actualizar Registro de modelo por MOD_ID */
        public function update_modelo2($mod_id, $suc_id, $mod_nom, $mrc2_id){

          $conectar=parent::Conexion();
          $sql="call SP_U_MODELO_01 (?, ?, ?, ?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $mod_id);
          $query->bindValue(2, $suc_id);
          $query->bindValue(3, $mod_nom);
          $query->bindValue(4, $mrc2_id);
          $query->execute();

          

        }


  }


?>