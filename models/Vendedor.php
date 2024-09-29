<?php

class Vendedor extends Conectar{

     /* TODO:Listado de Vendedores por Sucursal*/
    public function get_vendedor_x_suc_id($suc_id){
            
        $conectar=parent::Conexion();
        $sql=" call SP_L_VENDEDOR_02 (?)";
        $query=$conectar->prepare($sql);
        $query->bindValue(1, $suc_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);


    }


      /* TODO: INSERTAR NUEVO REGISTRO VENDEDOR*/
    public function insert_vendedor_x_suc_id($suc_id, $vend_nom, $vend_correo, $vend_rut, $vend_telef, $comision_porc){
        $conectar=parent::Conexion();
        $sql="call SP_I_VENDEDOR_01 (?,?,?,?,?,?)";
        $query=$conectar->prepare($sql);
        $query->bindValue(1,$suc_id);
        $query->bindValue(2,$vend_nom);
        $query->bindValue(3,$vend_correo);
        $query->bindValue(4,$vend_rut);
        $query->bindValue(5,$vend_telef);
        $query->bindValue(6,$comision_porc);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


     /* TODO: Obtener listado de todos los Vendedores por sucursal */
     public function get_listar_vendedores_x_suc($suc_id){
        $conectar=parent::Conexion();
        $sql="call SP_L_VENDEDOR_02 (?)";
        $query=$conectar->prepare($sql);
        $query->bindValue(1,$suc_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } 


    /* TODO:Mostrar Registro Especifico poR VEND_id  */
    public function get_vendedor_x_vend_id($vend_id){

        $conectar=parent::Conexion();
        $sql="call SP_L_VENDEDOR_03 (?)";
        $query=$conectar->prepare($sql);
        $query->bindValue(1, $vend_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
     

    }


     /* TODO:Mostrar Registro Especifico poR VEND_id  */
     public function datos_pagar_comision($vend_id){

        $conectar=parent::Conexion();
        $sql="call SP_PAGO_COMISION (?)";
        $query=$conectar->prepare($sql);
        $query->bindValue(1, $vend_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
     

    }


    /* TODO:Eliminar Registros por ID */
    public function delete_vendedor($vend_id){

        $conectar=parent::Conexion();
        $sql="call SP_D_VENDEDOR_01 (?)";
        $query=$conectar->prepare($sql);
        $query->bindValue(1, $vend_id);
        $query->execute();
       

    }



    /* TODO:Insertar Nuevo Registro de VENDEDORs */
    public function insert_vendedor($suc_id, $vend_img, $vend_nom, $vend_correo,  $vend_rut, $vend_telef, $comision_porc){

      $conectar=parent::Conexion();/* (1- INSERTAR VENDEDOR) */


     /*  TODO:Funcion que tomara el dato recivido por la Variable $_FILES Y asignara un valor al campo vend_img */
      require_once("Vendedor.php");
      $vend=new Vendedor();
      $vend_img ='';

      if($_FILES["vend_img"]["name"] !=''){
          $vend_img=$vend->upload_image();
          
      }

      $sql="call SP_I_VENDEDOR_01 (?,?,?,?,?,?,?)";
      $query=$conectar->prepare($sql);
      $query->bindValue(1, $suc_id);
      $query->bindValue(2, $vend_img);
      $query->bindValue(3, $vend_nom);
      $query->bindValue(4, $vend_correo);
      $query->bindValue(5, $vend_rut);
      $query->bindValue(6, $vend_telef);
      $query->bindValue(7, $comision_porc);
      
      $query->execute();
      
      

    }


    

     /* TODO:Actualizar Registro de Vendedor por VEND_ID */
     public function update_vendedor($vend_id, $suc_id, $vend_img, $vend_nom, $vend_correo, $vend_rut,  $vend_telef, $comision_porc){

        $conectar=parent::Conexion();

        /*  TODO:Funcion que tomara el dato recivido por la Variable $_FILES Y asignara un valor al campo vend_img */
        require_once("Vendedor.php");
        $vend = new Vendedor();
        $vend_img ='';

        if($_FILES["vend_img"]["name"] !=''){
            $vend_img = $vend->upload_image();
            
        }else{
            $vend_img = $POST["hidden_vendedor_imagen"];
        }

        $sql="call SP_U_VENDEDOR_01 (?,?,?,?,?,?,?,?)";
        $query=$conectar->prepare($sql);
        $query->bindValue(1, $vend_id);
        $query->bindValue(2, $suc_id);
        $query->bindValue(3, $vend_img);
        $query->bindValue(4, $vend_nom);
        $query->bindValue(5, $vend_correo);
        $query->bindValue(6, $vend_rut);
        $query->bindValue(7, $vend_telef);
        $query->bindValue(8, $comision_porc);
        $query->execute();


      }

       /* TODO: Subir imagen del vendedor */
       public function upload_image(){
        if (isset($_FILES["vend_img"])){
            $extension = explode('.', $_FILES['vend_img']['name']);
            $new_name = rand() . '.' . $extension[1];
            $destination = '../assets/images/vendedores/' . $new_name;
            move_uploaded_file($_FILES['vend_img']['tmp_name'], $destination);
            return $new_name;
        }
    }
}





?>