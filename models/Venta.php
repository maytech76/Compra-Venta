<?php
    class Venta extends Conectar{

        /* TODO: Listar Registro por ID en especifico */
        public function insert_venta_x_suc_id($suc_id,$usu_id){
            $conectar=parent::Conexion();
            $sql="call SP_I_VENTA_01 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->bindValue(2,$usu_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }



        /* TODO: Registrar detalle de venta  */
        public function insert_venta_detalle($vent_id,$prod_id,$prod_pventa,$detv_cant){
            $conectar=parent::Conexion();
            $sql="call SP_I_VENTA_02 (?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$vent_id);
            $query->bindValue(2,$prod_id);
            $query->bindValue(3,$prod_pventa);
            $query->bindValue(4,$detv_cant);
            $query->execute();
            //return $query->fetchAll(PDO::FETCH_ASSOC);
        }



        /* TODO:INSERTAR VALORES DE COMISIONES A VENDEDORES TB: TD_COMISIONES */
        public function insert_comisiones_vend($vent_id, $vend_id, $suc_id, $vend_nom, $comision_porc, $comision_valor, $sub_total){
            $conectar=parent::Conexion();
            $sql="call SP_INSERT_COMISIONES(?,?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$vent_id);
            $query->bindValue(2,$vend_id);
            $query->bindValue(3,$suc_id);
            $query->bindValue(4,$vend_nom);
            $query->bindValue(5,$comision_porc);
            $query->bindValue(6,$comision_valor);
            $query->bindValue(7,$sub_total);
            $query->execute();

        }



        /* TODO: Obtener el listado de detalle de venta para el modal que mostrara los produstos en la ventas, subtotal iva y TotalG */
        public function get_venta_detalle($vent_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_VENTA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$vent_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }



        /* TODO: Eliminar un detalle de la venta */
        public function delete_venta_detalle($detv_id){
            $conectar=parent::Conexion();
            $sql="call SP_D_VENTA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$detv_id);
            $query->execute();
        }



        /* TODO: Calcular SUBTOTAL, IGV y TOTAL */
        public function get_venta_calculo($vent_id){
            $conectar=parent::Conexion();
            $sql="call SP_U_VENTA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$vent_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }


        /* TODO: Actualizar  cabecera de venta a est=1 e incluir el reto de campos */
        public function update_venta($vent_id, $pag_id, $cli_id, $cli_ruc, $cli_direcc, $cli_correo, $vent_coment, $mon_id, $doc_id, $vend_id){
            $conectar=parent::Conexion();
            $sql="call SP_U_VENTA_03 (?,?,?,?,?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$vent_id);
            $query->bindValue(2,$pag_id);
            $query->bindValue(3,$cli_id);
            $query->bindValue(4,$cli_ruc);
            $query->bindValue(5,$cli_direcc);
            $query->bindValue(6,$cli_correo);
            $query->bindValue(7,$vent_coment);
            $query->bindValue(8,$mon_id);
            $query->bindValue(9,$doc_id);
            $query->bindValue(10,$vend_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }



        /* TODO: Obtener Datos de la cabecera de venta x VENT_ID */
        public function get_venta($vent_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_VENTA_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$vent_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }



        /* TODO: Obtener listado de todas las ventas por sucursal y mostrar en Dattable*/
        public function get_venta_listado($suc_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_VENTA_03 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } 



        /* TODO: Obtener top 5 de ventas */
        public function get_venta_top_productos($suc_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_VENTA_04 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }



        /* TODO: Listado de ventas TOP6 para el dashboard */
        public function get_venta_top_5($suc_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_VENTA_05 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }




        /* TODO: Obtener datos de venta y venta para actividades recientes */
        public function get_ventaventa($suc_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_VENTAVENTA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }



        /* TODO: Obtener consumo por categoria para Donut del dashboard */
        public function get_consumoventa_categoria($suc_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_VENTA_04 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        

        /* TODO: Obtener informacion para barra de ventas del dashboard */
        public function get_venta_barras($suc_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_VENTA_06 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>