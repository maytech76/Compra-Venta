<?php
  
  class Sucursal extends Conectar{

        /* TODO:Listado de Registros por Sucursal*/
        public function get_sucursal_x_emp_id($emp_id){
          $conectar=parent::Conexion();
          $sql="call SP_L_SUCURSAL_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $emp_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }



        /* TODO:Mostrar Registro Especifico po suc_id  */
        public function get_sucursal_x_suc_id($suc_id){

            $conectar=parent::Conexion();
            $sql="call SP_L_SUCURSAL_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
         

        }



        /* TODO:Eliminar Registros por ID */
        public function delete_sucursal($suc_id){

            $conectar=parent::Conexion();
            $sql="call SP_D_SUCURSAL_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $suc_id);
            $query->execute();
           

        }





        /* TODO:Insertar Nuevo Registro de Sucursals */
        public function insert_sucursal($emp_id,$suc_nom){

          $conectar=parent::Conexion();
          $sql="call SP_I_SUCURSAL_01 (?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $emp_id);
          $query->bindValue(2, $suc_nom);
          $query->execute();
          
          

        }



        /* TODO:Actualizar Registro de sucursal por SUC_ID */
        public function update_sucursal($suc_id,$emp_id,$suc_nom){

          $conectar=parent::Conexion();
          $sql="call SP_U_SUC_01 (?,?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->bindValue(2, $emp_id);
          $query->bindValue(3, $suc_nom);
          $query->execute();

          

        }

       

  }


?>