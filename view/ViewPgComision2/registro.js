var emp_id = $('#EMP_IDx').val();
var suc_id = $('#SUC_IDx').val();
var usu_id = $('#USU_IDx').val();
var usu_nom = $('#USU_NOMx').val();


$(document).ready(function(){


    /* AL realizar un click en btnguardar se alamacenaran todos los campos
    en la tabla td_venta_detalle con sus valores recibidos desde la vista de cada input */
    $(document).on("click","#btnpagar",function(){


        var tec_id = $('#txttec_id').html();
        var suc_id = $('#SUC_IDx').val(); 
        var usu_nom = $('#USU_NOMx').val();
        var suc_nom = $('#sucursal').html();
        var tec_nom = $('#txttec_nom').html();
        var tec_correo = $('#txttec_correo').html();
        var tec_doc = $('#txttec_doc').html();
        var tec_celular = $('#celular').html();
        var cant_ot = $('#txtcantot').html();
        var total_comision = $('#totalcomision').html();
        var comentario = $('#comentario').val();


        /* TODO:Validamos que los campos prod_id, prod_pventa, detv_cant NO LLEGEN VACIOS */
     if($("#comentario").val()=='' ){

        swal.fire({
            title:'Venta',
            text: 'Error El Campo Comentario esta Vacio..!',
            icon: 'error'
        });

    }else{ 



        swal.fire({
            title:"Pagar Comisión!",
            text:"Procederá al pago de este Recibo?",
            icon: "warning",
            confirmButtonText : "Si",
            showCancelButton : true,
            cancelButtonText: "No",
        }).then((result)=>{
            if (result.value){

    

        $.post("../../controller/comisionservicio.php?op=pagarcom",{
            
            tec_id:tec_id,
            suc_id:suc_id,
            usu_nom:usu_nom,
            suc_nom:suc_nom,
            tec_nom:tec_nom,
            tec_correo:tec_correo,
            tec_doc:tec_doc,
            tec_celular:tec_celular,
            cant_ot:cant_ot,
            total_comision:total_comision,
            comentario:comentario,
        
        
            
        },function(data){
            console.log(data);
        }
        
        );

    
       $.post("../../controller/comisionservicio.php?op=update_est",{
         tec_id:tec_id,
         suc_id:suc_id
        },function(data){
            

               window.close();

            $('#detalle_comision').DataTable().ajax.reload();  

        });


  


         }

      
      });
    }/* end else */
 });
});





