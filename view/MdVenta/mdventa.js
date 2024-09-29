var emp_id = $('#EMP_IDx').val();
var suc_id = $('#SUC_IDx').val();
var usu_id = $('#USU_IDx').val();

$(document).ready(function(){

    $.post("../../controller/venta.php?op=registrar",{suc_id:suc_id,usu_id:usu_id},function(data){
        data=JSON.parse(data);
        $('#vent_id').val(data.VENT_ID);
    });

    $('#cli_id').select2();

    $('#cat_id').select2();

    $('#prod_id').select2();

    $('#pag_id').select2();

    $('#mon_id').select2();

    $('#doc_id').select2();

    $('#vend_id').select2();


   /* TODO:FUNCIONES Y PARAMETROS PARA SELECT DOCUMENTO, PROVEEDOR, CATEGORIA, PAGO, MONEDA  */
     $.post("../../controller/documento.php?op=combo",{doc_tipo:"Venta"},function(data){
        $("#doc_id").html(data);
    }); 

    $.post("../../controller/cliente.php?op=combo",{emp_id:emp_id},function(data){
        $("#cli_id").html(data);
    });

    $.post("../../controller/categoria.php?op=combo",{suc_id:suc_id},function(data){
        $("#cat_id").html(data);
    });

    $.post("../../controller/pago.php?op=combo",function(data){
        $("#pag_id").html(data);
    });


    $.post("../../controller/moneda.php?op=combo",{suc_id:suc_id},function(data){
        $("#mon_id").html(data);
    });


    /* TODO:LISTADO DE VENDEDOR SEGUN SUCURSAL */
    $.post("../../controller/vendedor.php?op=combo",{suc_id:suc_id},function(data){
        $("#vend_id").html(data);   

    });



     /* TODO:Funcion Change para datos del cliente selecionado */
    $("#cli_id").change(function(){
        $("#cli_id").each(function(){
            cli_id = $(this).val();
            $.post("../../controller/cliente.php?op=mostrar",{cli_id:cli_id},function(data){
                data=JSON.parse(data);
                /* Asignando a etiquetas id los valores de los campos RUT, DIRECCION DE CLIENTE, TELEFONO, CORREO */
                $('#cli_ruc').val(data.CLI_RUC);
                $('#cli_direcc').val(data.CLI_DIRECC);
                $('#cli_telf').val(data.CLI_TELF);
                $('#cli_correo').val(data.CLI_CORREO);
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


     $("#vend_id").change(function(){
        $("#vend_id").each(function(){
            vend_id = $(this).val();

                /* TODO:PAQUETE DE INFORMACION SEGUN VEND_ID SELECCIONADO EN #vend_id */
                $.post("../../controller/vendedor.php?op=mostrar",{vend_id:vend_id},function(data){
                    
                    data=JSON.parse(data);
                    console.log(data);
                    $('#vend_id').val(data.VEND_ID);
                    $('#vend_nom').val(data.VEND_NOM);
                    $('#vend_correo').val(data.VEND_CORREO);
                    $('#vend_rut').val(data.VEND_RUT);
                    $('#vend_telef').val(data.VEND_TELEF);
                    $('#comision_porc').val(data.COMISION_PORC);
                    $('#comision_valor').val(data.COMISION_VALOR);
                    $('#vend_img').val(data.VEND_IMG);
                });

        });
     });

}); /* END DOCUMENT READY */




/* TODO:Bonton con EVENTO CLICK este agrega un producto a datatable detalle ventas  */
$(document).on("click","#btnagregar",function(){
    var vent_id = $("#vent_id").val();
    var prod_id = $("#prod_id").val();
    var prod_pventa = $("#prod_pventa").val();
    var detv_cant = $("#detv_cant").val();

    /* TODO:Validamos que los campos prod_id, prod_pventa, detv_cant NO LLEGEN VACIOS */
    if($("#prod_id").val()=='' || $("#prod_pventa").val()=='' || $("#detv_cant").val()=='' ){

        swal.fire({
            title:'Venta',
            text: 'Error Campos Vacios',
            icon: 'error'
        });

    }else{

       /*  Si los campos vent_id, prod_id, prod_pventa, detv_cant llegan con informacion asignarlos a variables */
        $.post("../../controller/venta.php?op=guardardetalle",{
            vent_id:vent_id,
            prod_id:prod_id,
            prod_pventa:prod_pventa,
            detv_cant:detv_cant
        },function(data){
            console.log(data);
        });

      

          /* TODO:Mostrar en input valores recibidos del controlador venta  usando metodo calculo */
               /* TODO:Actualiza los montos de los input SubTotal, VENT_IGV, VENT_TOTAL */
        $.post("../../controller/venta.php?op=calculo",{vent_id:vent_id},function(data){
            data=JSON.parse(data);
            $('#txtsubtotal').html(data.VENT_SUBTOTAL);
            $('#txtigv').html(data.VENT_IGV);
            $('#txttotal').html(data.VENT_TOTAL);
        });


       /*   TODO:Limpiamos los campo prod_pventa y detv_cant  */
        $("#prod_pventa").val('');
        $("#detv_cant").val('');

        listar(vent_id);

    }

});


/* TODO:FUNCION ELIMINAR PRODUCTO DE DATATABLE DETALLE VENTAS */
function eliminar(detv_id,vent_id){

    swal.fire({
        title:"Eliminar!",
        text:"Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText : "Si",
        showCancelButton : true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value){
            $.post("../../controller/venta.php?op=eliminardetalle",{detv_id:detv_id},function(data){
                console.log(data);
            });

            $.post("../../controller/venta.php?op=calculo",{vent_id:vent_id},function(data){
                data=JSON.parse(data);
                $('#txtsubtotal').html(data.VENT_SUBTOTAL);
                $('#txtigv').html(data.VENT_IGV);
                $('#txttotal').html(data.VENT_TOTAL);
            });

            listar(vent_id);

            swal.fire({
                title:'Venta',
                text: 'Registro Eliminado',
                icon: 'success'
            });
        }
    });

}



/* TODO:LISTADO DE LOS PRODUCTOS AGREGADOS A TABLA DE VENTAS DETALLES */
function listar(vent_id){
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
            url:"../../controller/venta.php?op=listardetalle",
            type:"post",
            data:{vent_id:vent_id}
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
    var vent_id = $("#vent_id").val();
    var doc_id = $("#doc_id").val();
    var pag_id = $("#pag_id").val();
    var cli_id = $("#cli_id").val();
    var cli_ruc = $("#cli_ruc").val();
    var cli_direcc = $("#cli_direcc").val();
    var cli_correo = $("#cli_correo").val();
    var vent_coment = $("#vent_coment").val();
    var mon_id = $("#mon_id").val();
    var vend_id =$("#vend_id").val();
    var vend_nom =$("#vend_nom").val();
    var comision_porc =$("#comision_porc").val();
    var sub_total =$("#txtsubtotal").html();
    var comision_valor =$("#comision_valor").val();
    var suc_id = $('#SUC_IDx').val();
    
    

    

      /* TODO:Validacion de Pago , Cliente , Moneda */
    if($("#doc_id").val()=='0' || $("#pag_id").val()=='0' || $("#cli_id").val()=='0' || $("#mon_id").val()=='0' || $("#vend_id").val()=='0'){
      
        swal.fire({
            title:'Venta',
            text: 'Error Campos Vacios',
            icon: 'error'
        });

    }else{

        $.post("../../controller/venta.php?op=calculo",{vent_id:vent_id},function(data){
            data=JSON.parse(data);
            console.log(data);
           /*  TODO:Validamos si el total de la venta es Null ó 0 */
            if (data.VENT_TOTAL==null){
                /* TODO:Validacion de DetalleS vacios */
                swal.fire({
                    title:'Venta',
                    text: 'Error No Existen Productos selecionados',
                    icon: 'error'
                });
            
               /*  TODO:Si el campo Vent_total tiene informacion = True
                   Guardar informacion en la tabla tm_venta */
            }else{
                $.post("../../controller/venta.php?op=guardar",{
                    vent_id:vent_id,
                    pag_id:pag_id,
                    cli_id:cli_id,
                    cli_ruc:cli_ruc,
                    cli_direcc:cli_direcc,
                    cli_correo:cli_correo,
                    vent_coment:vent_coment,
                    mon_id:mon_id,
                    doc_id:doc_id,
                    vend_id:vend_id
                    
                });


                $.post("../../controller/venta.php?op=insert_comisiones",{
                    vent_id:vent_id,
                    vend_id:vend_id,
                    suc_id:suc_id,
                    vend_nom:vend_nom,
                    comision_porc:comision_porc,
                    sub_total:sub_total,
                    comision_valor

                },function(data){
                    console.log(data);
                    /* TODO:Mensaje de Sweetalert */
                    swal.fire({
                        title:'Venta',
                        /* TODO:Mostrar mensaje con N° de Venta */
                        text: 'Venta registrada Correctamente con Nro: V-'+vent_id,
                        icon: 'success',
                        showConfirmButton: false,
                        /* TODO: Ruta para mostrar documento de venta en otra ventana del Explorador */
                        footer: "<a href='../ViewVenta/?v="+vent_id+"'>Desea ver el Documento?</a>"
                    });

                    setTimeout(function() {
                        window.location.href = "../ListVenta/";
                      }, 1500);

                });
            }

        });

    }

});


$(document).on("click","#btnlimpiar",function(){
    location.reload();
});