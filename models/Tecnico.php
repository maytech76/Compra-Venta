<?php
  
  class Tecnico extends Conectar{

        /* TODO:Listado de Registros por Sucursal ## DATA_TABLE*/
        public function get_tecnico_x_suc_id($suc_id){
            
          $conectar=parent::Conexion();
          $sql=" call SP_L_TECNICO_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }



        /* TODO:Mostrar Registro Especifico po tec_id  */
        public function get_tecnico_x_tec_id($tec_id){

            $conectar=parent::Conexion();
            $sql="call SP_L_TECNICO_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $tec_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
         

        }


         /* TODO:Mostrar Registro Especifico poR VEND_id  */
        public function datos_pagar_comision2($tec_id){

        $conectar=parent::Conexion();
        $sql="call SP_PAGO_COMISION_2 (?)";
        $query=$conectar->prepare($sql);
        $query->bindValue(1, $tec_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
     

        }



        /* TODO:Eliminar Registros por ID */
        public function delete_tecnico($tec_id){

            $conectar=parent::Conexion();
            $sql="call SP_D_TECNICO_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $tec_id);
            $query->execute();
           

        }




        /* TODO:Insertar Nuevo Registro de Tecnicos */
        public function insert_tecnico($suc_id,$tec_nom,$tec_ape,$tec_doc,$tec_celular,$tec_correo,$comision_porc,$tec_img){

          $conectar=parent::Conexion();


         /*  TODO:Funcion que tomara el dato recivido por la Variable $_FILES Y asignara un valor al campo tec_img */
          require_once("Tecnico.php");
          $tec = new Tecnico();
          $tec_img='';

          if($_FILES["tec_img"]["name"] !=''){
              $tec_img=$tec->upload_image();
              
          }

          $sql="call SP_I_TECNICO (?,?,?,?,?,?,?,?)";
          $query=$conectar->prepare($sql);
            $query->bindValue(1, $suc_id);
            $query->bindValue(2, $tec_nom);
            $query->bindValue(3, $tec_ape);
            $query->bindValue(4, $tec_doc);
            $query->bindValue(5, $tec_celular);       
            $query->bindValue(6, $tec_correo);       
            $query->bindValue(7, $comision_porc);
            $query->bindValue(8, $tec_img);
           $query->execute();
          
          

        }




        /* TODO:Actualizar Registro de tecnico por TEC_ID */
        public function update_tecnico($tec_id,$suc_id,$tec_nom,$tec_ape,$tec_doc,$tec_celular,$tec_correo,$comision_porc,$tec_img){

          $conectar=parent::Conexion();

          /*  TODO:Funcion que tomara el dato recivido por la Variable $_FILES Y asignara un valor al campo tec_img */
          require_once("Tecnico.php");
          $tec=new Tecnico();
          $tec_img='';

          if($_FILES["tec_img"]["name"] !=''){
              $tec_img=$tec->upload_image();
              
          }
          $sql="call SP_UP_TEC_01 (?,?,?,?,?,?,?,?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $tec_id);
          $query->bindValue(2, $suc_id);
          
          $query->bindValue(3, $tec_nom);
          $query->bindValue(4, $tec_ape);
          $query->bindValue(5, $tec_doc);
          $query->bindValue(6, $tec_celular);
          $query->bindValue(7, $tec_correo);
         
          $query->bindValue(8, $comision_porc);
          $query->bindValue(9, $tec_img);
          $query->execute();


        }




        /* TODO:Funcion para Actualizar Password de tecnico */
        public function update_tecnico_pass($tec_id,$tec_pass){
            $conectar=parent::Conexion();
            $sql="call SP_U_TECNICO_02 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$tec_id);
            $query->bindValue(2,$tec_pass);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }


        /* TODO:Acceso al Sistema */
        public function login(){
            $conectar=parent::Conexion();
            if (isset($_POST["enviar"])){
                /* TODO: Recepcion de Parametros desde la Vista Login */
                $sucursal = $_POST["suc_id"];
                $correo = $_POST["tec_correo"];
                $pass =  $_POST["tec_pass"];
                /* TODO:Validamos si estan vacion los siguientes parametros de login */
                if (empty($sucursal) and empty($correo) and empty($pass)){
                    exit();
                }else{
                    $sql="call SP_L_TECNICO_04 (?,?,?)";
                    $query=$conectar->prepare($sql);
                    $query->bindValue(1,$sucursal);
                    $query->bindValue(2,$correo);
                    $query->bindValue(3,$pass);
                    $query->execute();
                    $resultado = $query->fetch();


                    if (is_array($resultado) and count($resultado)>0){
                        /* TODO:Generar variables de Session del Tecnico */
                        $_SESSION["TEC_ID"]=$resultado["TEC_ID"];
                        $_SESSION["TEC_NOM"]=$resultado["TEC_NOM"];
                        $_SESSION["TEC_APE"]=$resultado["TEC_APE"];
                        $_SESSION["TEC_CORREO"]=$resultado["TEC_CORREO"];
                        $_SESSION["SUC_ID"]=$resultado["SUC_ID"];
                        $_SESSION["COM_ID"]=$resultado["COM_ID"];
                        $_SESSION["EMP_ID"]=$resultado["EMP_ID"];
                        $_SESSION["ROL_ID"]=$resultado["ROL_ID"];
                        $_SESSION["TEC_IMG"]=$resultado["TEC_IMG"];


                        /* TODO:Ya capturas las variables de session de tecnico dirigete a home */
                        header("Location:".Conectar::ruta()."view/home/");
                    }else{
                        exit();
                    }
                }
            }else{
                exit();
            }

        }


        /* TODO: Subir imagen del tecnico */
        public function upload_image(){
            if (isset($_FILES["tec_img"])){
                $extension = explode('.', $_FILES['tec_img']['name']);
                $new_name = rand() . '.' . $extension[1];
                $destination = '../assets/images/tecnicos/' . $new_name;
                move_uploaded_file($_FILES['tec_img']['tmp_name'], $destination);
                return $new_name;
            }
        }

  }


?>