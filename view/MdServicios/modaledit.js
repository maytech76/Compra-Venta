var emp_id = $('#EMP_IDx').val();
var suc_id = $('#SUC_IDx').val();
var usu_id = $('#USU_IDx').val();

/* TODO:FUNCION QUE MUESTRA LOS CAMPOS DE RECEPCION  SEGUN RCN_ID */
function editar(rcn_id){
    $.post("../../controller/editrecepcion.php?op=mostrando",{rcn_id:rcn_id},function(data){
        data=JSON.parse(data);
        console.log(data);
        $('#rcn_id').html(data.RCN_ID);
        $('#suc_id').val(data.SUC_ID);
        $('#usu_nom').html(data.USU_NOM);
        $('#cli_id').val(data.CLI_ID);
        $('#cli_nom').val(data.CLI_NOM);
        $('#cli_ruc').val(data.CLI_RUC);
        $('#cli_telf').val(data.CLI_TELF);
        $('#cli_direcc').val(data.CLI_DIRECC);
        $('#cli_correo').val(data.CLI_CORREO);
        $('#mrc_id').val(data.MRC_ID);
        $('#mod_id').val(data.MOD_ID);
        $('#tipo_id').val(data.TIPO_ID);
        $('#tipo_serv').val(data.TIPO_SERV);
        $('#klm').val(data.KLM);
        $('#serialch').val(data.SERIALCH);
        $('#patente').val(data.PATENTE);
        $('#fech_crea').val(data.FECH_CREA);
    });
 
     /* TITULO PARA EL MODAL */
    $('#lbltitulo2').html('Editar Recepción');
    /* TODO: Mostrar Modal */
    $('#edit_recepcion').modal('show');
}

 