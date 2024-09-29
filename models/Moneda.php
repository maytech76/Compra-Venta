<?php
  
  class Moneda extends Conectar{

        /* TODO:Listado de Registros por Sucursal*/
        public function get_moneda_x_suc_id($suc_id){

          $conectar=parent::Conexion();
          $sql="call SP_L_MONEDA_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }


        /* TODO:Mostrar Registro Especifico po mon_id  */
        public function get_moneda_x_mon_id($mon_id){

            $conectar=parent::Conexion();
            $sql="call SP_L_MONEDA_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $mon_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
         

        }


        /* TODO:Eliminar Registros por MON_ID */
        public function delete_moneda($mon_id){
          
            $conectar=parent::Conexion();
            $sql="call SP_D_MONEDA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $mon_id);
            $query->execute();
           

        }



        /* TODO:Insertar Nuevo Registro de Monedas */
        public function insert_moneda($suc_id, $mon_nom, $mon_simb){

          $conectar=parent::Conexion();
          $sql="call SP_I_MONEDA_01 (?,?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->bindValue(2, $mon_nom);
          $query->bindValue(3, $mon_simb);
          $query->execute();
          
          

        }




        /* TODO:Actualizar Registro de moneda por MON_ID */
        public function update_moneda($mon_id,$suc_id,$mon_nom,$mon_simb){

          $conectar=parent::Conexion();
          $sql="call SP_U_MON_01 (?, ?, ?, ?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $mon_id);
          $query->bindValue(2, $suc_id);
          $query->bindValue(3, $mon_nom);
          $query->bindValue(4, $mon_simb);
          $query->execute();

          

        }


  }


?>