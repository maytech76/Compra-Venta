
var emp_id = $('#EMP_IDx').val();
var suc_id = $('#SUC_IDx').val();
var usu_id = $('#USU_IDx').val();


$(document).ready(function(){




     $.post("../../controller/ordentrabajo.php?op=registrar",{suc_id:suc_id,usu_id:usu_id},function(data){
        data=JSON.parse(data);
        $('#ordt_id').val(data.ORDT_ID);
    }); 

    $('#rcn_id').select2();

    /* $('#tec_id').select2(); */

    $('#cat_id').select2();

    $('#prod_id').select2();

    


   /* TODO:FUNCIONES Y PARAMETROS PARA SELECT DOCUMENTO, PROVEEDOR, CATEGORIA, PAGO, MONEDA  */

    $.post("../../controller/recepcion.php?op=combo",{suc_id:suc_id},function(data){
        $("#rcn_id").html(data);
    });

    

    /* TODO:LISTADO DE VENDEDOR SEGUN SUCURSAL */
    $.post("../../controller/tecnico.php?op=combo",{suc_id:suc_id},function(data){
        $("#tec_id").html(data);   

    });


    $.post("../../controller/categoria.php?op=combo",{suc_id:suc_id},function(data){
        $("#cat_id").html(data);
    });



    /* TODO:RECIBE EL NUEMRO CORRELATIVO DE ORDEN DE TRABAJO */
    /* $.post("../../controller/rol.php?op=orden",function(data){
        $("#ordt_id").val(data);
    }); */


    /* TODO:RECIBE EL NUEMRO CORRELATIVO DE ORDEN DE TRABAJO */
     $.post("../../controller/rol.php?op=numero_ot",function(data){
        $("#numero_ot").html(data);
    }); 



     /* TODO:Funcion Change para datos de la RECEPCION selecionada */
    $("#rcn_id").change(function(){
        $("#rcn_id").each(function(){
            rcn_id = $(this).val();
            $.post("../../controller/recepcion.php?op=imprimir",{rcn_id:rcn_id},function(data){
                data=JSON.parse(data);
                /* Asignando a etiquetas id los valores de los campos RUT, DIRECCION DE CLIENTE, TELEFONO, CORREO */
                $('#cli_id').val(data.CLI_ID);
                $('#cli_nom').val(data.CLI_NOM);
                $('#cli_ruc').val(data.CLI_RUC);
                $('#cli_telf').val(data.CLI_TELF);
                $('#cli_correo').val(data.CLI_CORREO);
                $('#mrc_nom').val(data.MRC_NOM);
                $('#mod_nom').val(data.MOD_NOM);
                $('#tipo_nom').val(data.TIPO_NOM);
                $('#tipo_serv').val(data.TIPO_SERV);
                $('#klm').val(data.KLM);
                $('#serialch').val(data.SERIALCH);
                $('#patente').val(data.PATENTE);
            });
        });
    });



     /* TODO:Funcion Change para datos del PRODUCTO SEGUN CATEGORIA SELECIONADA "SELECT" */
    $("#cat_id").change(function(){
        $("#cat_id").each(function(){
            cat_id = $(this).val();

            $.post("../../controller/producto.php?op=combo",{cat_id:cat_id},function(data){
                $("#prod_id").html(data);
            });

        });
    });




    /* TODO:Funcion Change para datos (PRECIO, STOCK, NOMBRE DE UNIDAD)del PRODUCTO SELECIONADO */
    $("#prod_id").change(function(){
        $("#prod_id").each(function(){
            prod_id = $(this).val();

                $.post("../../controller/producto.php?op=mostrar",{prod_id:prod_id},function(data){
                    data=JSON.parse(data);
                    $('#prod_pventa').val(data.PROD_PVENTA);
                    $('#prod_stock').val(data.PROD_STOCK);
                    $('#und_nom').val(data.UND_NOM);
                });

        });
     });


     
     $("#tec_id").change(function(){
        $("#tec_id").each(function(){
            tec_id = $(this).val();

                /* TODO:PAQUETE DE INFORMACION SEGUN VEND_ID SELECCIONADO EN #vend_id */
                $.post("../../controller/tecnico.php?op=mostrar",{tec_id:tec_id},function(data){
                    
                    data=JSON.parse(data);
                    console.log(data);
                    $('#tec_id').val(data.TEC_ID);
                    $('#tec_nom').val(data.TEC_NOM);
                    $('#comision_valor').val(data.COMISION_VALOR);
                    $('#comision_porc').val(data.COMISION_PORC);
                    
                });

        });
     });

    

}); /* END DOCUMENT READY */



/* TODO:Bonton con EVENTO CLICK este agrega un producto a datatable orden_detalle */
$(document).on("click","#btnagregar",function(){
    var ordt_id = $("#ordt_id").val();
    var prod_id = $("#prod_id").val();
    var prod_pventa = $("#prod_pventa").val();
    var prod_cant = $("#prod_cant").val();

   
    

    /* TODO:Validamos que los campos prod_id, prod_pventa, detv_cant NO LLEGEN VACIOS */
    if($("#ordt_id").val()=='' || $("#prod_pventa").val()=='' || $("#prod_cant").val()=='' || $("#cli_ruc").val()=='' ){

        swal.fire({
            title:'Orden de Trabajo',
            text: 'Error Campos Vacios',
            icon: 'error'
        });

    }else{

      /*TODO: Validamos que el campo tec_nom no llegue vacio, si llega vacio mostrar alert */
    if ($("#tec_nom").val()==='') {

        swal.fire({
            title:'No hay Mecanico',
            text: 'Error Seleciona un Mecanico',
            icon: 'error'
        });
        
           }else{ /* Ahora si el campo tec_nom llega con datos -> Proceder agregando items al detalle */
             
                        /*  Si los campos vent_id, prod_id, prod_pventa, detv_cant llegan con informacion asignarlos a variables */
                    $.post("../../controller/ordentrabajo.php?op=guardardetalle",{
                        ordt_id:ordt_id,
                        prod_id:prod_id,
                        prod_pventa:prod_pventa,
                        prod_cant:prod_cant
                    },function(data){
                        
                    });

                

                    /* TODO:Mostrar en input valores recibidos del controlador venta  usando metodo calculo */
                        /* TODO:Actualiza los montos de los input SubTotal, VENT_IGV, VENT_TOTAL */
                    $.post("../../controller/ordentrabajo.php?op=calculo",{ordt_id:ordt_id},function(data){
                        data=JSON.parse(data);
                        $('#txtsubtotal').html(data.ORDT_SUBTOTAL);
                        $('#txtigv').html(data.ORDT_IVA);
                        $('#txttotal').html(data.ORDT_TOTALG);
                    });


                /*   TODO:Limpiamos los campo prod_pventa y detv_cant  */
                    $("#prod_pventa").val('');
                    $("#prod_cant").val('');

                    listar(ordt_id);
                    
            
           }

      

    }

});



/* TODO:FUNCION ELIMINAR PRODUCTO DE DATATABLE DETALLE VENTAS */
function eliminar(detot_id,ordt_id){

    swal.fire({
        title:"Eliminar!",
        text:"Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText : "Si",
        showCancelButton : true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value){
            $.post("../../controller/ordentrabajo.php?op=eliminardetalle",{detot_id:detot_id},function(data){
                console.log(data);
            });

            $.post("../../controller/ordentrabajo.php?op=calculo",{ordt_id:ordt_id},function(data){
                data=JSON.parse(data);
                $('#txtsubtotal').html(data.ORDT_SUBTOTAL);
                $('#txtigv').html(data.ORDT_IVA);
                $('#txttotal').html(data.ORDT_TOTALG);
            });

            listar(ordt_id);

            swal.fire({
                title:'Producto Eliminado',
                text: 'del Listado',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });

}



/* TODO:LISTADO DE LOS PRODUCTOS AGREGADOS A TABLA DE VENTAS DETALLES */
function listar(ordt_id){
    $('#table_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"../../controller/ordentrabajo.php?op=listardetalle",
            type:"post",
            data:{ordt_id:ordt_id}
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
}



/* AL realizar un click en btnguardar se alamacenaran todos los campos
en la tabla td_venta_detalle con sus valores recibidos desde la vista de cada input */
$(document).on("click","#btnguardar",function(){
    

    var ordt_id = $("#ordt_id").val();
    var rcn_id = $("#rcn_id").val();
    var cli_id = $("#cli_id").val();
    var tec_id = $("#tec_id").val();
    var tec_nom = $("#tec_nom").val();
    var cli_ruc = $("#cli_ruc").val();
    var cli_nom = $("#cli_nom").val();
    var cli_telf = $("#cli_telf").val();
    var cli_ruc = $("#cli_ruc").val();
    var cli_correo = $("#cli_correo").val();

    var mrc_nom =$("#mrc_nom").val();
    var mod_nom =$("#mod_nom").val();
    var tipo_nom =$("#tipo_nom").val();
    var tipo_serv =$("#tipo_serv").val();
    var tec_id =$("#tec_id").val();

    var klm = $("#klm").val();
    var serialch = $("#serialch").val();
    var patente = $("#patente").val();
    var ordt_coment = $("#ordt_coment").val();
    var sub_total = $("#txtsubtotal").html();
    var comision_porc = $("#comision_porc").val();
    var comision_valor = $("#comision_valor").val();

    

      /* TODO:Validacion de Pago , Cliente , Moneda */
    if($("#rcn_id").val()=='0' ||  $("#tec_id").val()==='na' || $("#cli_id").val()=='0' || $("#cat_id").val()=='0' || $("#prod_id").val()=='0'){
      
        swal.fire({
            title:'Orden de Trabajo',
            text: 'Error Campos Vacios',
            icon: 'error'
        });

    }else{

        $.post("../../controller/ordentrabajo.php?op=calculo",{ordt_id:ordt_id},function(data){
            data=JSON.parse(data);
            /* console.log(data); */
           /*  TODO:Validamos si el total de la venta es Null ó 0 */
            if (data.ORDT_TOTALG==null){
                /* TODO:Validacion de DetalleS vacios */
                swal.fire({
                    title:'Orden de Trabajo',
                    text: 'Error No Existen Productos-Servicios selecionados',
                    icon: 'error'
                });
            
               /*  TODO:Si el campo Vent_total tiene informacion = True
                   Guardar informacion en la tabla tm_venta */
            }else{
                $.post("../../controller/ordentrabajo.php?op=guardar",{

                    ordt_id:ordt_id,
                    rcn_id:rcn_id,
                    cli_id:cli_id,
                    tec_id:tec_id,
                    cli_nom:cli_nom, 
                    cli_telf:cli_telf,
                    cli_ruc:cli_ruc,
                    cli_correo:cli_correo, 

                    mrc_nom:mrc_nom,
                    mod_nom:mod_nom,
                    tipo_nom:tipo_nom,
                    tipo_serv:tipo_serv,
                    
                    klm:klm,
                    serialch:serialch,
                    patente:patente,
                    ordt_coment:ordt_coment
                    
                    
                });


                $.post("../../controller/ordentrabajo.php?op=insert_ot",{

                    rcn_id:rcn_id,
                    suc_id:suc_id,
                    cli_id:cli_id,
                    usu_id:usu_id,
                    tec_id:tec_id,
                    cli_nom:cli_nom,
                    cli_ruc:cli_ruc,
                    cli_correo:cli_correo

                });


                $.post("../../controller/ordentrabajo.php?op=insert_comisiones_mcn",{

                    ordt_id:ordt_id,
                    cli_id:cli_id,
                    suc_id:suc_id,
                    tec_id:tec_id,
                    tec_nom:tec_nom,
                    comision_porc:comision_porc,
                    sub_total:sub_total,
                    comision_valor

                },function(data){
                  /*   console.log(data); */
                    /* TODO:Mensaje de Sweetalert */
                    swal.fire({
                        title:'Orden de Trabajo',
                        /* TODO:Mostrar mensaje con N° de Venta */
                        text: 'Registrada Correctamente con Nro: OT-'+ordt_id,
                        icon: 'success',
                        /* TODO: Ruta para mostrar documento de venta en otra ventana del Explorador */
                        footer: "<a href='../ViewOrden/?OT="+ordt_id+"'>Desea ver el Documento?</a>"
                    });

                    setTimeout(function() {
                        window.location.href = "../ListOrdenTb/";
                      }, 1500);



                });
            }

        });

    }

});



$(document).on("click","#btnlimpiar",function(){
    location.reload();
});