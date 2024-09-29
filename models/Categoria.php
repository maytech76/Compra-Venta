<?php
  
  class Categoria extends Conectar{

        /* TODO:Listado de Registros por Sucursal*/
        public function get_categoria_x_suc_id($suc_id){
          $conectar=parent::Conexion();
          $sql="call SP_L_CATEGORIA_01 (?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1,$suc_id);
          $query->execute();
          return $query->fetchAll(PDO::FETCH_ASSOC);


        }
        

        /* TODO:Mostrar Registro Especifico por cat_id para EDITAR  */
        public function get_categoria_x_cat_id($cat_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_CATEGORIA_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $cat_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
         

        }


        /* TODO:Eliminar Registros por ID */
        public function delete_categoria($cat_id){
            $conectar=parent::Conexion();
            $sql="call SP_D_CATEGORIA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $cat_id);
            $query->execute();
           

        }



        /* TODO:Insertar Nuevo Registro de Categorias */
        public function insert_categoria($suc_id, $cat_nom){

          $conectar=parent::Conexion();
          $sql="call SP_I_CATEGORIA_01 (?,?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $suc_id);
          $query->bindValue(2, $cat_nom);
          $query->execute();
          
          

        }

        /* TODO:Actualizar Registro de categoria por CAT_ID */
        public function update_categoria($cat_id, $suc_id, $cat_nom){

          $conectar=parent::Conexion();
          $sql="call SP_U_CATEGORIA_01 (?, ?, ?)";
          $query=$conectar->prepare($sql);
          $query->bindValue(1, $cat_id);
          $query->bindValue(2, $suc_id);
          $query->bindValue(3, $cat_nom);
          $query->execute();

          

        }


  }


?>