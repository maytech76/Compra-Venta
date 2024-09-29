<?php

 class OrdenTrabajo extends Conectar{

        public function get_recepcion_x_rcn_id($rcn_id){
            
            $conectar=parent::Conexion();
            $sql="call SP_LIST_RECEPCION_SERV_01(?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $rcn_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

        

        }


        /* TODO: Insertar Registro usando parametros $suc_id - $usu_id*/
        public function insert_orden_x_suc_id($suc_id,$usu_id){

            $conectar=parent::Conexion();
            $sql="call SP_I_ORDEN_TEMP (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->bindValue(2,$usu_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }


        /* TODO: Registrar items en el detalle de orden  */
        public function insert_items_orden($ordt_id,$prod_id,$prod_pventa,$prod_cant){
            $conectar=parent::Conexion();
            $sql="call SP_I_ITEMS_DET_ORDEN (?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$ordt_id);
            $query->bindValue(2,$prod_id);
            $query->bindValue(3,$prod_pventa);
            $query->bindValue(4,$prod_cant);
            $query->execute();
            //return $query->fetchAll(PDO::FETCH_ASSOC);
        }

         /* TODO: Registrar items en el detalle de orden  */
         public function insert_orden_trabajo($rcn_id, $suc_id, $cli_id, $usu_id, $tec_id, $cli_nom, $cli_ruc, $cli_correo){
            $conectar=parent::Conexion();
            $sql="call SP_I_ORDEN_TRABAJO (?,?,?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$rcn_id);
            $query->bindValue(2,$suc_id);
            $query->bindValue(3,$cli_id);
            $query->bindValue(4,$usu_id);
            $query->bindValue(5,$tec_id);
            $query->bindValue(6,$cli_nom);  
            $query->bindValue(7,$cli_ruc);
            $query->bindValue(8,$cli_correo);
            $query->execute();
            //return $query->fetchAll(PDO::FETCH_ASSOC);
        }


         /* TODO: Mostrar el listado de items en la Orden de Trabajo */
         public function get_orden_detalle($ordt_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_ORD_DET(?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$ordt_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }


        /* TODO: Calcular SUBTOTAL, IGV y TOTAL */
        public function get_orden_calculo($ordt_id){
            $conectar=parent::Conexion();
            $sql="call SP_U_ORDEN_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$ordt_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }


        /* TODO: Eliminar Items de detalle de OT */
        public function delete_OT_detalle($detot_id){
            $conectar=parent::Conexion();
            $sql="call SP_D_ORDT_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$detot_id);
            $query->execute();
        }

        /* TODO: Actualizar  cabecera de venta a est=1 e incluir el reto de campos */
        public function update_ordent($ordt_id, 
            $rcn_id, $cli_id, $tec_id, $cli_nom, $cli_telf, $cli_ruc, $cli_correo, 
            $mrc_nom, $mod_nom, $tipo_nom, $tipo_serv, $klm, $serialch, $patente, $ordt_coment){
            $conectar=parent::Conexion();
            $sql="call SP_U_ORDEN_02 (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$ordt_id);
            $query->bindValue(2,$rcn_id);
            $query->bindValue(3,$cli_id);
            $query->bindValue(4,$tec_id);
            $query->bindValue(5,$cli_nom);
            $query->bindValue(6,$cli_telf);
            $query->bindValue(7,$cli_ruc);
            $query->bindValue(8,$cli_correo);
            $query->bindValue(9,$mrc_nom); 
            $query->bindValue(10,$mod_nom);

            $query->bindValue(11,$tipo_nom);
            $query->bindValue(12,$tipo_serv);

            $query->bindValue(13,$klm);
            $query->bindValue(14,$serialch);
            $query->bindValue(15,$patente);
            $query->bindValue(16,$ordt_coment);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

         /* TODO:INSERTAR VALORES DE COMISIONES A MECANICOS */
         public function insert_comisiones_orden(

        
            $ordt_id, $cli_id, $suc_id,  $tec_id, $tec_nom, $comision_porc, $sub_total, $comision_valor, ){
            $conectar=parent::Conexion();
            $sql="call SP_INSERT_COMISIONES_02(?,?,?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$ordt_id);
            $query->bindValue(2,$cli_id);
            $query->bindValue(3,$suc_id);
            $query->bindValue(4,$tec_id);
            $query->bindValue(5,$tec_nom);
            $query->bindValue(6,$comision_porc);
            $query->bindValue(7,$sub_total);
            $query->bindValue(8,$comision_valor);
            $query->execute();

        }


        /* TODO:CONSULTA SQL A TABLA tm_orden_trabajo, listar ordenes en datatable */
        public function list_orden_procesadas ($suc_id){

            $conectar=parent::Conexion();
            $sql="call SP_L_ORDENT_01(?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }



        public function view_ordent ($ordt_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_ORDENT_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $ordt_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }



        public function view_det_orden_x_ordt ($ordt_id){

            $conectar=parent::Conexion();
            $sql="call SP_L_ORDENT_DET_01(?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $ordt_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }


        public function view_det_orden_x_modal ($ordt_id){

            $conectar=parent::Conexion();
            $sql="call SP_L_ORDENTD_MODAL(?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $ordt_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }


    }
 

?>