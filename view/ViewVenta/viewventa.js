
$(document).ready(function(){
    var vent_id = getUrlParameter('v');


   /* TODO: REALIZAMOS CONSULTA AL CONTOLADOR VENTA.PHP METODO MOSTRAR SEGUN VENT_ID */
    $.post("../../controller/venta.php?op=mostrar",{vent_id:vent_id},function(data){
       console.log(data);
        data=JSON.parse(data);


        /* TODO:EXPONEMOS EN LA VISTA LOS RESULTADOS EN DATA SEGUN VALOR RECIBIDO DEL CAMPO  */
        $('#txtdirecc').html(data.EMP_DIRECC);
        $('#txtruc').html(data.EMP_RUC);
        $('#txtemail').html(data.EMP_CORREO);
        $('#txtweb').html(data.EMP_PAG);
        $('#txttelf').html(data.EMP_TELF);

        $('#vent_id').html(data.VENT_ID);
        $('#fech_crea').html(data.FECH_CREA);
        $('#pag_nom').html(data.PAG_NOM);
        $('#txttotal').html(data.VENT_TOTAL);

        $('#vent_subtotal').html(data.VENT_SUBTOTAL);
        $('#vent_igv').html(data.VENT_IGV);
        $('#vent_total').html(data.VENT_TOTAL);
        $('#vent_coment').html(data.VENT_COMENT);

        $('#usu_nom').html(data.USU_NOM +' '+ data.USU_APE);
        $('#mon_nom').html(data.MON_NOM);

        $('#cli_nom').html("<b>Nombre: </b>"+data.CLI_NOM);
        $('#cli_ruc').html("<b>Rut: </b>"+data.CLI_RUC);
        $('#cli_direcc').html("<b>Dirección: </b>"+data.CLI_DIRECC);
        $('#cli_correo').html("<b>Correo: </b>"+data.CLI_CORREO);

    });

     /* TODO:CONSULTAMOS EL CONTROLADOR VENTA.PHP EL METODO LISTARDETALLEFORMATO SEGUN PARAMETRO VENT_ID */
    $.post("../../controller/venta.php?op=listardetalleformato",{vent_id:vent_id},function(data){

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