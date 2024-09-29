var emp_id = $('#EMP_IDx').val();
var suc_id = $('#SUC_IDx').val();
var usu_id = $('#USU_IDx').val();



$(document).ready(function(){

    
    var vend_id = getUrlParameter('Pg');


   /* TODO: REALIZAMOS CONSULTA AL CONTOLADOR VENTA.PHP METODO MOSTRAR SEGUN VENT_ID */
    $.post("../../controller/vendedor.php?op=recibo_pago",{vend_id:vend_id},function(data){
       console.log(data);
        data=JSON.parse(data);


        /* TODO:EXPONEMOS EN LA VISTA LOS RESULTADOS EN DATA SEGUN VALOR RECIBIDO DEL CAMPO  */
        $('#txtvend_id').html(data.VEND_ID);
        $('#txtvend_nom').html(data.VEND_NOM);
        $('#txtvend_rut').html(data.VEND_RUT);
        $('#txtvend_correo').html(data.VEND_CORREO);
        $('#txtcantvent').html(data.COUNT_VENTAS);
        $('#telefono').html(data.VEND_TELEF);
        $('#sucursal').html(data.SUC_NOM);
        $('#comisionporc').html(data.COMISION_PORC);
        $('#totalcomision').html(data.TOTAL_COMISION);
        $('#fech_registro').html(data.FECHA);
       
    

    });

     /* TODO:CONSULTAMOS EL CONTROLADOR VENTA.PHP EL METODO LISTARDETALLEFORMATO SEGUN PARAMETRO VENT_ID */
     $.post("../../controller/comisionventa.php?op=listardetalle",{vend_id:vend_id},function(data){

        /* TODO:EL RESULTADO DE DATA LOS PASAMOS AL ELEMENTO #listardetalle de la datatable viewVenta */
        $('#detalle_comision').DataTable({
            "aProcessing": true,
            "aServerSide": true,
            dom: 'Bfrtip',
            searching: false,
            paging: false,
             buttons: [
                
            ], 
            "ajax":{
                url:"../../controller/comisionventa.php?op=listardetalle",
                type:"post",
                data:{vend_id:vend_id}
            },
            "bDestroy": true,
            "responsive": true,
            "bInfo":true,
            "iDisplayLength": 10,
            "pagingType": "simple",
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
    
    }); 

});





/* TODO: Obtener parametro de URL */
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

