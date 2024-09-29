<?php
  
  class Unidad extends Conectar{

        /* TODO:Listado de Registros por Sucursal*/
        public function get_unidad_x_suc_id($suc_id){
          $conectar=parent::Conexion();
          $sql="call SP_L_UNIDAD_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }


        /* TODO:Mostrar Registro Especifico po und_id  */
        public function get_unidad_x_und_id($und_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_UNIDAD_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $und_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
         

        }



        /* TODO:Eliminar Registros por UND_ID */
        public function delete_unidad($und_id){
            $conectar=parent::Conexion();
            $sql="call SP_D_UNIDAD_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $und_id);
            $query->execute();
           

        }



        /* TODO:Insertar Nuevo Registro de Unidads */
        public function insert_unidad($suc_id, $und_nom){

          $conectar=parent::Conexion();
          $sql="call SP_I_UNIDAD_01 (?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->bindValue(2, $und_nom);
          $query->execute();
          
          

        }

        

        /* TODO:Actualizar Registro de unidad por UND_ID */
        public function update_unidad($und_id, $suc_id, $und_nom){

          $conectar=parent::Conexion();
          $sql="call SP_U_UND_01 (?, ?, ?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $und_id);
          $query->bindValue(2, $suc_id);
          $query->bindValue(3, $und_nom);
          $query->execute();

          

        }


  }


?>