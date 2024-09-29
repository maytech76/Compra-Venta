<?php
  
  class Recepcion extends Conectar{

        /* TODO:Listado de Registros por Sucursal*/
        public function get_recepcion_x_suc_id($suc_id){

          $conectar=parent::Conexion();
          $sql="call SP_LIST_RECEPCION_SERV_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
        }


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


        /* ESTA FUNCION SE EJECUTA AL CLICK DEL BOTON EDITAR DEL DATA TABLE */
        /* TODO:Mostrar Registro Especifico por rcn_id  */
        public function get_recepcion_x_rcn_id($suc_id){

            $conectar=parent::Conexion();
            $sql="call SP_LIST_RECEPCION_SERV_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }



         /* ESTA FUNCION SE EJECUTA AL CLICK DEL BOTON VER DEL DATA TABLE List_recepcion */
        /* TODO:Mostrar Registro Especifico por rcn_id  */
        public function print_recepcion_x_rcn_id($rcn_id){

          $conectar=parent::Conexion();
          $sql="call SP_LIST_RECEPCION_SERV_03 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1,$rcn_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
      }



        /* TODO:Eliminar del Listado Registro de Recepcion por el usuario*/
        public function delete_recepcion($rcn_id){

            $conectar=parent::Conexion();
            $sql="call SP_D_RECEPCION_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $rcn_id);
            $query->execute();
           

        }



        /* TODO:Recepcion enviada a Orden de Servicio*/
        public function send_rcp_orden_servicio($rcn_id){

          $conectar=parent::Conexion();
          $sql="call SP_D_RECEPCION_02 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1,$rcn_id);
          $query->execute();
         

      }



        /* TODO:Insertar Nuevo Registro de Recepcions */
        public function insert_recepcion(
            $suc_id, $usu_id, $cli_id, $mrc_id, $mod_id, $tipo_id, $tipo_serv, $klm, $serialch, 
            $patente, $luces,$rueda,$cases, $docs, $casco, $fuel, $tools, $otros, $coment
            ){

          $conectar=parent::Conexion();

          $sql="call SP_I_RECEPCION_01 (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
          
          $query=$conectar->prepare($sql);
          $query->bindValue(1,  $suc_id);
          $query->bindValue(2,  $usu_id);
          $query->bindValue(3,  $cli_id);
          $query->bindValue(4,  $mrc_id);
          $query->bindValue(5,  $mod_id);
          $query->bindValue(6,  $tipo_id);
          $query->bindValue(7,  $tipo_serv);
          $query->bindValue(8,  $klm);
          $query->bindValue(9,  $serialch);
          $query->bindValue(10,  $patente);
          $query->bindValue(11, $luces);
          $query->bindValue(12, $rueda);
          $query->bindValue(13, $cases);
          $query->bindValue(14, $docs);
          $query->bindValue(15, $casco);
          $query->bindValue(16, $fuel);
          $query->bindValue(17, $tools);
          $query->bindValue(18, $otros);
          $query->bindValue(19, $coment);
       
          $query->execute();
          
          

        }



        /* TODO:Actualizar Registro de recepcion por REC_ID */
        public function update_recepcion_01(
          $rcn_id, $mrc_id, $mod_id, $tipo_id, $tipo_serv, $klm, $serialch, 
          $patente)
        
        
          {

            $conectar=parent::Conexion();
            $sql="call SP_UP_RECEPCION_SERV_01 (?,?,?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,  $rcn_id);
            $query->bindValue(2,  $mrc_id);
            $query->bindValue(3,  $mod_id);
            $query->bindValue(4,  $tipo_id);
            $query->bindValue(5,  $tipo_serv);
            $query->bindValue(6,  $klm);
            $query->bindValue(7, $serialch);
            $query->bindValue(8, $patente);
            $query->execute();
            var_dump($sql);

          

        }



         /* TODO: Subir imagen del recepcion a carpera recepcions */
        public function upload_image(){
          if (isset($_FILES["rec_img"])){
              $extension = explode('.', $_FILES['rec_img']['name']);
              $new_name = rand() . '.' . $extension[1];
              $destination = '../assets/images/recepcions/' . $new_name;
              move_uploaded_file($_FILES['rec_img']['tmp_name'], $destination);
              return $new_name;
          }
      }



  }


?>