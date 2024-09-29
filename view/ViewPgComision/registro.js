


$(document).ready(function(){


    /* AL realizar un click en btnguardar se alamacenaran todos los campos
    en la tabla td_venta_detalle con sus valores recibidos desde la vista de cada input */
    $(document).on("click","#btnpagar",function(){


        var vend_id = $('#txtvend_id').html();
        var suc_id = $('#SUC_IDx').val(); 
        var suc_nom = $('#sucursal').html();
        var vend_nom = $('#txtvend_nom').html();
        var vend_correo = $('#txtvend_correo').html();
        var vend_rut = $('#txtvend_rut').html();
        var cant_ventas = $('#txtcantvent').html();
        var vend_telef = $('#telefono').html();
        var total_comision = $('#totalcomision').html();


        swal.fire({
            title:"Pagar Comisión!",
            text:"Procederá al pago de este recibo?",
            icon: "warning",
            confirmButtonText : "Si",
            showCancelButton : true,
            cancelButtonText: "No",
        }).then((result)=>{
            if (result.value){

    

        $.post("../../controller/comisionventa.php?op=pagarcom",{
            
            vend_id:vend_id,
            suc_id:suc_id,
            suc_nom:suc_nom,
            vend_nom:vend_nom,
            vend_correo:vend_correo,
            vend_rut:vend_rut,
            cant_ventas:cant_ventas,
            vend_telef:vend_telef,
            total_comision:total_comision,
        
            
        });

    
       $.post("../../controller/comisionventa.php?op=update_est",{
         vend_id:vend_id,
         suc_id:suc_id
        },function(data){ 

               window.close();

            $('#detalle_comision').DataTable().ajax.reload();

        });
     }
   });
 });
});





