<?php

 class Comisiones extends Conectar{


   /* TODO:LISTADO PRINCIPAL DEL TOTAL DE COMISIONES DE VENTAS POR VEND_ID AND SUC_ID */
    public function get_total_comision_x_suc_id($suc_id){
        $conectar=parent::Conexion();
        $slq="call SP_LISTA_TOTAL_COMISIONES (?)";
        $query=$conectar->prepare($slq);
        $query->bindValue(1,$suc_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }



    /* TODO: Obtener el listado de comisiones por vendedor  (MODAL) */
    public function get_comisiones_detalles($vend_id){
      $conectar=parent::Conexion();
      $sql="call SP_LIST_VENT_X_VENDEDOR (?)";
      $query=$conectar->prepare($sql);
      $query->bindValue(1,$vend_id);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }



     /* TODO: Obtener Datos de la cabecera de recibo de pago */
     public function reg_pago_comision($vend_id){
      $conectar=parent::Conexion();
      $sql="call SP_VENDEDOR_COMISION (?)";
      $query=$conectar->prepare($sql);
      $query->bindValue(1,$vend_id);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);

     }



      /* TODO: Insertamos registro en la tabla td_pago_comision  */
      public function insert_pago_comision($vend_id, $suc_id, $suc_nom, $vend_nom, $vend_correo, $vend_rut, $cant_ventas, $vend_telef, $total_comision){

        $conectar=parent::Conexion();
        $sql="call SP_I_RECIBO_PAGO_COMISION (?,?,?,?,?,?,?,?,?)";
        $query=$conectar->prepare($sql);
        $query->bindValue(1,$vend_id);
        $query->bindValue(2,$suc_id);
        $query->bindValue(3,$suc_nom);
        $query->bindValue(4,$vend_nom);
        $query->bindValue(5,$vend_correo);
        $query->bindValue(6,$vend_rut);
        $query->bindValue(7,$cant_ventas);
        $query->bindValue(8,$vend_telef);
        $query->bindValue(9,$total_comision);
        $query->execute();
        
      }


       /* TODO:Actualizar Registro de categoria por CAT_ID */
       public function update_est_cms_vnt($vend_id, $suc_id){

        $conectar=parent::Conexion();
        $sql="call SP_UPDATE_EST_COMISIONES (?, ?)";
        $query=$conectar->prepare($sql);
        $query->bindValue(1, $vend_id);
        $query->bindValue(2, $suc_id);
        $query->execute();

        

      }


       /* TODO:LISTADO DE COMISIONES PAGADAS */
      public function get_list_pago_comisiones(){
        $conectar=parent::Conexion();
        $slq="call SP_L_COMISIONES_PAGADAS ()";
        $query=$conectar->prepare($slq);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
      }

      

      /* TODO: Obtener ficha del vendedor  (MODAL) */
      public function get_ficha_vendedor($pago_id){
        $conectar=parent::Conexion();
        $sql="call SP_W_TOTAL_PAGO_X_RECIBO (?)";
        $query=$conectar->prepare($sql);
        $query->bindValue(1,$pago_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
      }




 }





?>
