<?php

 class Comisiones extends Conectar{

     /* DATA TABLEB */
   /* TODO:LISTADO PRINCIPAL DEL TOTAL DE COMISIONES DE SERVICIO POR TEC_ID AND SUC_ID */
    public function get_total_comision_x_tec_id($suc_id){
        $conectar=parent::Conexion();
        $slq="call SP_LISTA_TOTAL_COMISIONES_MCN (?)";
        $query=$conectar->prepare($slq);
        $query->bindValue(1,$suc_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }



    /* TODO: Obtener el listado de comisiones por tecnico  (MODAL)-> ListComServicio */
    public function get_comisiones_ot_detalles($tec_id){
      $conectar=parent::Conexion();
      $sql="call SP_LIST_OT_X_TECNICO (?)";
      $query=$conectar->prepare($sql);
      $query->bindValue(1,$tec_id);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }



     /* TODO: Obtener Datos de la cabecera de recibo de pago comisiones x mecanico*/
     public function reg_pago_comision($tec_id){
      $conectar=parent::Conexion();
      $sql="call SP_TECNICO_COMISION (?)";
      $query=$conectar->prepare($sql);
      $query->bindValue(1,$tec_id);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);

     }



      /* TODO: Insertamos registro en la tabla td_pago_comision_mcn  */
      public function insert_pago_comision($tec_id, $suc_id, $usu_nom, $suc_nom, $tec_nom, $tec_correo, $tec_doc, $tec_celular, $cant_ot, $total_comision, $comentario){

        $conectar=parent::Conexion();
        $sql="call SP_I_RECIBO_PAGO_COMISION_MCN (?,?,?,?,?,?,?,?,?,?,?)";
        $query=$conectar->prepare($sql);
        $query->bindValue(1,$tec_id);
        $query->bindValue(2,$suc_id);
        $query->bindValue(3,$usu_nom);
        $query->bindValue(4,$suc_nom);
        $query->bindValue(5,$tec_nom);
        $query->bindValue(6,$tec_correo);
        $query->bindValue(7,$tec_doc);
        $query->bindValue(8,$tec_celular);
        $query->bindValue(9,$cant_ot);
        $query->bindValue(10,$total_comision);
        $query->bindValue(11,$comentario);
        $query->execute();
        
      }


       /* TODO:ACTUALIZAR CAMPOS EST EN 2 TABLAS TD_COMISIONES_MCN / TM_ORDEN_TRABAJO */
       public function update_est_cms_ot($tec_id, $suc_id){

        $conectar=parent::Conexion();
        $sql="call SP_UPDATE_EST_COMISIONES_MCN (?, ?)";
        $query=$conectar->prepare($sql);
        $query->bindValue(1, $tec_id);
        $query->bindValue(2, $suc_id);
        $query->execute();

        

      }


       /* TODO:LISTADO DE COMISIONES PAGADAS */
      public function get_list_pago_comisiones_mcn(){
        $conectar=parent::Conexion();
        $slq="call SP_L_COMISIONES_MCN_PAGADAS ()";
        $query=$conectar->prepare($slq);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
      }

      

      /* TODO: Obtener ficha del tecnico  (MODAL) */
      public function get_ficha_tecnico($pago_id){
        $conectar=parent::Conexion();
        $sql="call SP_W_TOTAL_PAGO_X_RECIBO (?)";
        $query=$conectar->prepare($sql);
        $query->bindValue(1,$pago_id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
      }




 }





?>
