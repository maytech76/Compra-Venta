<?php
  
  class Rol extends Conectar{

        /* TODO:Listado de Registros por Sucursal*/
        public function get_rol_x_suc_id($suc_id){
          $conectar=parent::Conexion();
          $sql="call SP_L_ROL_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }
        

        /* TODO:Mostrar Registro Especifico po rol_id  */
        public function get_rol_x_rol_id($rol_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_ROL_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $rol_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
         

        }


        /* TODO:Eliminar Registros por ID */
        public function delete_rol($rol_id){
            $conectar=parent::Conexion();
            $sql="call SP_D_ROL_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $rol_id);
            $query->execute();
           

        }

        /* TODO:Insertar Nuevo Registro de Rols */
        public function insert_rol($suc_id, $rol_nom){

          $conectar=parent::Conexion();
          $sql="call SP_I_ROL_01 (?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->bindValue(2, $rol_nom);
          $query->execute();
          
          

        }

        /* TODO:Actualizar Registro de rol por ROL_ID */
        public function update_rol($rol_id, $suc_id, $rol_nom){

          $conectar=parent::Conexion();
          $sql="call SP_U_ROL_01 (?, ?, ?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $rol_id);
          $query->bindValue(2, $suc_id);
          $query->bindValue(3, $rol_nom);
          $query->execute();

          

        }

        /* TODO: Validar acceso ROL */
        public function validar_acceso_rol($usu_id,$men_identi){
          $conectar=parent::Conexion();
          $sql="call SP_L_MENU_03 (?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1,$usu_id);
          $query->bindValue(2,$men_identi);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
      }


      

      /* TODO:MOSTRAR EL PROXIMO NUMERO DE REGISTRO PARA N° DE RECEPCION*/
      public function get_correlativo_recp(){
        $conectar=parent::Conexion();
        $sql="call SP_LAST_NUM_RECEPCION()";
        $query=$conectar->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);


      }



      /* TODO:MOSTRAR EL PROXIMO NUMERO DE REGISTRO PARA N° DE ORDEN DE TRABAJO + 5 CEROS*/
      public function get_correlativo_ot(){
          $conectar=parent::Conexion();
          $sql="call SP_LAST_NUM_ORDENT()";
          $query=$conectar->prepare($sql);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


      } 


       /* TODO:MOSTRAR EL PROXIMO NUMERO DE REGISTRO PARA N° DE ORDEN DE TRABAJO REGISTRADAS*/
       public function get_correlativo_rg(){
        $conectar=parent::Conexion();
        $sql="call SP_LAST_NUM_ORDENT_RG()";
        $query=$conectar->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);


    } 



  }


?>