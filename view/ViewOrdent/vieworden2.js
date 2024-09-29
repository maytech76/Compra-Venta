/* CLASES Y FUNCIONES PARA MOSTRAR DATOS DE ORDENES DE TRABAJOS Y DETALLES DE PRODUCTOS Y SERVICIOS
VICULADOS A CADA OT GENERADAD SEGUN SU ORDT_ID */

var suc_id = $('#SUC_IDx').val(); 
var emp_id = $('#EMP_IDx').val();

$(document).ready(function(){
    var ordt_id = getUrlParameter('OT');

   /* TODO: REALIZAMOS CONSULTA AL CONTROLADOR VENTA.PHP METODO MOSTRAR SEGUN VENT_ID */
   $.post("../../controller/ordentrabajo.php?op=view_ordent",{ordt_id:ordt_id},function(data){
    console.log(data);
     data=JSON.parse(data);


     /* TODO:EXPONEMOS EN LA VISTA LOS RESULTADOS EN DATA SEGUN VALOR RECIBIDO DEL CAMPO  */
     $('#ordt_id').html(data.ORDT_ID);
     $('#cli_ruc').html(data.CLI_RUC);
     $('#cli_nom').html(data.CLI_NOM);
     $('#cli_direcc').html(data.CLI_DIRECC);
     $('#cli_correo').html(data.CLI_CORREO);

     $('#txtpatente').html(data.PATENTE);
     $('#txtmarca').html(data.MRC_NOM);
     $('#txtmodelo').html(data.MOD_NOM);
     $('#txttipo').html(data.TIPO_NOM);
     $('#txttiposerv').html(data.TIPO_SERV);
     $('#txtcomentario').html(data.ORDT_COMENT);
     $('#txtfecha').html(data.FECH_CREA);
     $('#txtklm').html(data.KLM);

    
     $('#txtnombret').html(data.TEC_NOM);
     $('#txtcomision').html(data.COMISION_PORC);
     $('#txtsucursal').html(data.SUC_NOM);
            
     
     $('#ordt_subtotal').html(data.ORDT_SUBTOTAL);
     $('#ordt_iva').html(data.ORDT_IVA);
     $('#txttotalg').html(data.ORDT_TOTALG);
     $('#txtuserid').html(data.USU_ID);
     /* $('#txtusername').html(data.USU_NOM); */
     $('#usu_nom').html(data.USU_NOM +' '+ data.USU_APE);
     $('#txtuserlast').html(data.USU_APE);
     

     $('#txtnombre').html(data.EMP_NOM);
     $('#txtdirecc').html(data.EMP_DIRECC);
     $('#txtruc').html(data.EMP_RUC);
     $('#txtemail').html(data.EMP_CORREO);
     $('#txtpagina').html(data.EMP_PAG);
     $('#txttelf').html(data.EMP_TELF);
     
    


 });

     /* TODO:CONSULTAMOS EL CONTROLADOR VENTA.PHP EL METODO LISTARDETALLEFORMATO SEGUN PARAMETRO VENT_ID */
    $.post("../../controller/ordentrabajo.php?op=listar_detalles_items_ordent",{ordt_id:ordt_id},function(data){

        /* TODO:EL RESULTADO DE DATA LOS PASAMOS AL ELEMENTO #listardetalle de la datatable viewVenta */
        $('#listdetalle').html(data);
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

/* TODO:Creamos Funcion que permitirar llamar y mostrar el Modal Detalles */

function ver(ordt_id){

    $('#detalle_data').DataTable({
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


    

    /* TODO:Mostrar en input valores recibidos del controlador venta  usando metodo calculo */
    /* TODO:Actualiza los montos de los input SubTotal, VENT_IGV, VENT_TOTAL */
    $.post("../../controller/ordentrabajo.php?op=calculo",{ordt_id:ordt_id},function(data){
        data=JSON.parse(data);
        $('#txtsubtotal').html(data.ORDT_SUBTOTAL);
        $('#txtigv').html(data.ORDT_IVA);
        $('#txttotal').html(data.ORDT_TOTALG);
    });

    /* $('#ModalDetalles').modal('show'); */
}