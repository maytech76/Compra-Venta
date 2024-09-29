<?php
  
  class Cliente extends Conectar{

        /* TODO:Listado de Registros por Sucursal*/
        public function get_cliente_x_emp_id($emp_id){

          $conectar=parent::Conexion();
          $sql="call SP_L_CLIENTE_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $emp_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }




        /* TODO:Mostrar Registro Especifico po cli_id  */
        public function get_cliente_x_cli_id($cli_id){

            $conectar=parent::Conexion();
            $sql="call SP_L_CLIENTE_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $cli_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
         

        }




        /* TODO:Eliminar Registros por ID */
        public function delete_cliente($cli_id){

            $conectar=parent::Conexion();
            $sql="call SP_D_CLIENTE_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $cli_id);
            $query->execute();
           

        }




        /* TODO:Insertar Nuevo Registro de Clientes */
        public function insert_cliente($emp_id,$cli_nom, $cli_ruc, $cli_telf,$cli_direcc,$cli_correo){

          $conectar=parent::Conexion();
          $sql="call SP_I_CLIENTE_01 (?,?,?,?,?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $emp_id);
          $query->bindValue(2, $cli_nom);
          $query->bindValue(3, $cli_ruc);
          $query->bindValue(4, $cli_telf);
          $query->bindValue(5, $cli_direcc);
          $query->bindValue(6, $cli_correo);
          $query->execute();
          
          

        }




        /* TODO:Actualizar Registro de cliente por CLI_ID */
        public function update_cliente($cli_id,$emp_id,$cli_nom,$cli_ruc,$cli_telf,$cli_direcc,$cli_correo){

          $conectar=parent::Conexion();
          $sql="call SP_U_CLIENTE_01 (?,?,?,?,?,?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $cli_id);
          $query->bindValue(2, $emp_id);
          $query->bindValue(3, $cli_nom);
          $query->bindValue(4, $cli_ruc);
          $query->bindValue(5, $cli_telf);
          $query->bindValue(6, $cli_direcc);
          $query->bindValue(7, $cli_correo);
          $query->execute();

          

        }


  }


?>