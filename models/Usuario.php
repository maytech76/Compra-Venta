<?php
  
  class Usuario extends Conectar{

        /* TODO:Listado de Registros por Sucursal*/
        public function get_usuario_x_suc_id($suc_id){
            
          $conectar=parent::Conexion();
          $sql=" call SP_L_USUARIO_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }



        /* TODO:Mostrar Registro Especifico po usu_id  */
        public function get_usuario_x_usu_id($usu_id){

            $conectar=parent::Conexion();
            $sql="call SP_L_USUARIO_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $usu_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
         

        }



        /* TODO:Eliminar Registros por ID */
        public function delete_usuario($usu_id){

            $conectar=parent::Conexion();
            $sql="call SP_D_USUARIO_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $usu_id);
            $query->execute();
           

        }




        /* TODO:Insertar Nuevo Registro de Usuarios */
        public function insert_usuario($suc_id,$usu_correo,$usu_nom,$usu_ape,$usu_dni,$usu_telf,$usu_pass,$rol_id,$usu_img){

          $conectar=parent::Conexion();


         /*  TODO:Funcion que tomara el dato recivido por la Variable $_FILES Y asignara un valor al campo usu_img */
          require_once("Usuario.php");
          $usu=new Usuario();
          $usu_img='';

          if($_FILES["usu_img"]["name"] !=''){
              $usu_img=$usu->upload_image();
              
          }

          $sql="call SP_I_USUARIO_01 (?,?,?,?,?,?,?,?,?)";
          $query=$conectar->prepare($sql);
            $query->bindValue(1, $suc_id);
            $query->bindValue(2, $usu_correo);
            $query->bindValue(3, $usu_nom);
            $query->bindValue(4, $usu_ape);
            $query->bindValue(5, $usu_dni);
            $query->bindValue(6, $usu_telf);
            $query->bindValue(7, $usu_pass);
            $query->bindValue(8, $rol_id);
            $query->bindValue(9, $usu_img);
           $query->execute();
          
          

        }




      /* TODO:Actualizar Registro de usuario por USU_ID */
      public function update_usuario($usu_id,$suc_id,$usu_correo,$usu_nom,$usu_ape,$usu_dni,$usu_telf,$usu_pass,$rol_id,$usu_img){

          $conectar=parent::Conexion();

          /*  TODO:Funcion que tomara el dato recivido por la Variable $_FILES Y asignara un valor al campo usu_img */
          require_once("Usuario.php");
          $usu=new Usuario();
          $usu_img='';

          if($_FILES["usu_img"]["name"] !=''){
              $usu_img=$usu->upload_image();
              
          }
          $sql="call SP_U_USU_01 (?,?,?,?,?,?,?,?,?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $usu_id);
          $query->bindValue(2, $suc_id);
          $query->bindValue(3, $usu_correo);
          $query->bindValue(4, $usu_nom);
          $query->bindValue(5, $usu_ape);
          $query->bindValue(6, $usu_dni);
          $query->bindValue(7, $usu_telf);
          $query->bindValue(8, $usu_pass);
          $query->bindValue(9, $rol_id);
          $query->bindValue(10, $usu_img);
          $query->execute();


      }


      /* TODO:Funcion para Actualizar Password de usuario */   
      public function update_usuario_pass($usu_id,$usu_pass){
          $conectar=parent::Conexion();
          $sql="call SP_U_USUARIO_02 (?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1,$usu_id);
          $query->bindValue(2,$usu_pass);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);
      }


      /* TODO:Acceso al Sistema */
      public function login(){
        $conectar=parent::Conexion();
        if (isset($_POST["enviar"])){
            /* TODO: Recepcion de Parametros desde la Vista Login */
            $sucursal = $_POST["suc_id"];
            $correo = $_POST["usu_correo"];
            $pass =  $_POST["usu_pass"];
            /* TODO:Validamos si estan vacion los siguientes parametros de login */
            if (empty($sucursal) and empty($correo) and empty($pass)){
                exit();
            }else{
                $sql="call SP_L_USUARIO_04 (?,?,?)";
                $query=$conectar->prepare($sql);
                $query->bindValue(1,$sucursal);
                $query->bindValue(2,$correo);
                $query->bindValue(3,$pass);
                $query->execute();
                $resultado = $query->fetch();


                if (is_array($resultado) and count($resultado)>0){
                    /* TODO:Generar variables de Session del Usuario */
                    $_SESSION["USU_ID"]=$resultado["USU_ID"];
                    $_SESSION["USU_NOM"]=$resultado["USU_NOM"];
                    $_SESSION["USU_APE"]=$resultado["USU_APE"];
                    $_SESSION["USU_CORREO"]=$resultado["USU_CORREO"];
                    $_SESSION["SUC_ID"]=$resultado["SUC_ID"];
                    $_SESSION["COM_ID"]=$resultado["COM_ID"];
                    $_SESSION["EMP_ID"]=$resultado["EMP_ID"];
                    $_SESSION["ROL_ID"]=$resultado["ROL_ID"];
                    $_SESSION["USU_IMG"]=$resultado["USU_IMG"];


                    /* TODO:Ya capturas las variables de session de usuario dirigete a home */
                    header("Location:".Conectar::ruta()."view/home/");
                }else{
                    exit();
                }
            }
        }else{
            exit();
        }

    }

    

       /* TODO: Subir imagen del usuario */
      public function upload_image(){
          if (isset($_FILES["usu_img"])){
              $extension = explode('.', $_FILES['usu_img']['name']);
              $new_name = rand() . '.' . $extension[1];
              $destination = '../assets/images/users/' . $new_name;
              move_uploaded_file($_FILES['usu_img']['tmp_name'], $destination);
              return $new_name;
          }
      }

  }


?>