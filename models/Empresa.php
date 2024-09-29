<?php
  
  class Empresa extends Conectar{


     /* TODO:Listado de Registros */
     public function get_empresa($com_id){
          
      $conectar=parent::Conexion();
      $sql="call SP_L_EMPRESA_03(?)";
      $query=$conectar->prepare($sql);
      $query->bindValue(1,$com_id);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);


     }
      
    
    
         /* TODO:Listado de Registros por Sucursal*/
        public function get_empresa_x_com_id($com_id){
          
          $conectar=parent::Conexion();
          $sql="call SP_L_EMPRESA_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1,$com_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }

        

        /* TODO:Mostrar Registro Especifico po emp_id  */
        public function get_empresa_x_emp_id($emp_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_EMPRESA_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $emp_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
         

        }





        /* TODO:Eliminar Registros por ID */
        public function delete_empresa($emp_id){
            $conectar=parent::Conexion();
            $sql="call SP_D_EMPRESA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $emp_id);
            $query->execute();
           

        }


  


        /* TODO:Insertar Nuevo Registro de Empresas */
        public function insert_empresa($com_id,$emp_nom,$emp_ruc, $emp_correo,$emp_telf,$emp_direcc,$emp_pag, $emp_img){

            $conectar=parent::Conexion();

            /*  TODO:Funcion que tomara el dato recivido por la Variable $_FILES Y asignara un valor al campo usu_img */
            require_once("Empresa.php");
            $empresa=new Empresa();
            $emp_img='';

            if($_FILES["emp_img"]["name"] !=''){
                $emp_img=$empresa->upload_image();
                
            }

            $sql="call SP_I_EMPRESA_01 (?,?,?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $com_id);
            $query->bindValue(2, $emp_nom);
            $query->bindValue(3, $emp_ruc);
            $query->bindValue(4, $emp_correo);
            $query->bindValue(5, $emp_telf);
            $query->bindValue(6, $emp_direcc);
            $query->bindValue(7, $emp_pag);
            $query->bindValue(8, $emp_img);
            $query->execute();


        }



        /* TODO:Actualizar Registro de empresa por EMP_ID */
        public function update_empresa($emp_id, $com_id, $emp_nom, $emp_ruc, 
                                       $emp_correo, $emp_telf, $emp_direcc, $emp_pag, $emp_img){

          $conectar=parent::Conexion();
          $sql="call SP_U_EMPRESA_01 (?,?,?,?,?,?,?,?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $emp_id);
          $query->bindValue(2, $com_id);
          $query->bindValue(3, $emp_nom);
          $query->bindValue(4, $emp_ruc);
          $query->bindValue(5, $emp_correo);
          $query->bindValue(6, $emp_telf);
          $query->bindValue(7, $emp_direcc);
          $query->bindValue(8, $emp_pag);
          $query->bindValue(9, $emp_img);
          $query->execute();

          

        }

        /* TODO: Subir imagen del usuario */
        public function upload_image(){
          if (isset($_FILES["emp_img"])){
              $extension = explode('.', $_FILES['emp_img']['name']);
              $new_name = rand() . '.' . $extension[1];
              $destination = '../assets/images/empresa/' . $new_name;
              move_uploaded_file($_FILES['emp_img']['tmp_name'], $destination);
              return $new_name;
        }
    }


  }


?>