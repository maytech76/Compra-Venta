/* TODO: Obtener parametro de URL */

$(document).ready(function(){
    var rcn_id = getUrlParameter('r');


   /* TODO: REALIZAMOS CONSULTA AL CONTOLADOR VENTA.PHP METODO MOSTRAR SEGUN VENT_ID */
    $.post("../../controller/recepcion.php?op=imprimir",{rcn_id:rcn_id},function(data){
       console.log(data);
        data=JSON.parse(data);

         /* TODO:EXPONEMOS EN LA VISTA LOS RESULTADOS EN DATA SEGUN VALOR RECIBIDO DEL CAMPO  */
         $('#rcn_id').html(data.RCN_ID);
         $('#suc_id').html(data.SUC_ID);
         $('#usu_nom').html(data.USU_NOM);
         $('#cli_nom').html(data.CLI_NOM);
         $('#cli_ruc').html(data.CLI_RUC);
         $('#cli_telf').html(data.CLI_TELF);
         $('#cli_direcc').html(data.CLI_DIRECC);
         $('#cli_correo').html(data.CLI_CORREO);
         $('#mrc_id').html(data.MRC_ID);
         $('#mrc_nom').html(data.MRC_NOM);

         $('#mod_id').html(data.MOD_ID);
         $('#mod_nom').html(data.MOD_NOM);

         $('#tipo_id').html(data.TIPO_ID);
         $('#tipo_nom').html(data.TIPO_NOM);

         $('#tipo_serv').html(data.TIPO_SERV);
         $('#klm').html(data.KLM);

         $('#serialch').html(data.SERIALCH);
         $('#patente').html(data.PATENTE);

         $('#luces').html(data.LUCES);
         $('#rueda').html(data.RUEDA);
         $('#cases').html(data.CASES);
         $('#docs').html(data.DOCS);

         $('#casco').html(data.CASCO);
         $('#fuel').html(data.FUEL);
         $('#tools').html(data.TOOLS);
         $('#otros').html(data.OTROS);

         $('#coment').html(data.COMENT);
         $('#fech_crea').html(data.FECH_CREA);



    });


});

$(document).on("click","#btnclose",function(){
    window.close();  
});



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