var emp_id = $('#EMP_IDx').val(); 

function init(){
   $("#mantenimiento_form").on("submit",function(e){
       guardaryeditar(e);
   });
} 

/* TODO:FUNCION EDITAR - REGISTRAR */
function guardaryeditar(e){
   e.preventDefault();
   var formData = new FormData($("#mantenimiento_form")[0]);
   formData.append('emp_id',$('#EMP_IDx').val()); 
   /* TODO: Guardar Informacion */
   $.ajax({
       url:"../../controller/cliente.php?op=guardaryeditar",
       type:"POST",
       data:formData,
       contentType:false,
       processData:false,
       success:function(data){
           $('#tablacliente').DataTable().ajax.reload();
           $('#Modalcliente').modal('hide'); 

           /* TODO: Mensaje Registro de cliente Confirmado*/
           swal.fire({
               title:'Cliente',
               text: 'Registro Confirmado',
               icon: 'success',
               showConfirmButton: false,
               timer: 1500
           }); 
        } 
    });

}


$(document).ready(function(){
   

   /* TODO: Listar informacion en el datatable js */
   $('#tablacliente').DataTable({
       "aProcessing": true,
       "aServerSide": true,
       dom: 'Bfrtip',
       buttons: [
           'copyHtml5',
           'excelHtml5',
           'csvHtml5',
       ],
       "ajax":{
           url:"../../controller/cliente.php?op=listar",
           type:"post",
           data:{emp_id:emp_id}
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

});


/* TODO:FUNCION EDITAR REGISTRO CLIENTE  SEGUN CLI_ID */
function editar(cli_id){
   $.post("../../controller/cliente.php?op=mostrar",{cli_id:cli_id},function(data){
       data=JSON.parse(data);
       console.log(data);
       /* TODO:Campos a Mostrar en Modal Editar */
       $('#cli_id').val(data.CLI_ID);
       $('#cli_nom').val(data.CLI_NOM);
       $('#cli_ruc').val(data.CLI_RUC);
       $('#cli_telf').val(data.CLI_TELF);
       $('#cli_correo').val(data.CLI_CORREO);
      
   });
   $('#lbltitulo').html('Editar Registro');
   /* TODO: Mostrar Modal */
   $('#Modalcliente').modal('show');
}


/* TODO:FUNCION ELIMINAR DE LISTA A CLIENTE  SEGUN CLI_ID */
function eliminar(cli_id){
   swal.fire({
       title:"Eliminar!",
       text:"Seguro de Eliminar el Registro?",
       icon: "warning",
       confirmButtonText : "Si",
       showCancelButton : true,
       cancelButtonText: "No",
   }).then((result)=>{
       if (result.value){
           $.post("../../controller/cliente.php?op=eliminar",{cli_id:cli_id},function(data){
               console.log(data);
           });

           $('#tablacliente').DataTable().ajax.reload();

           swal.fire({
               title:'Cliente',
               text: 'Registro Eliminado',
               icon: 'success',
               showConfirmButton: false,
               timer: 1500
           });
       }
   });
}



$(document).on("click","#btnNuevo",function(){
   /* TODO: Limpiar informacion */
   $('#cli_id').val('');
   $('#cli_nom').val('');
   $('#cli_ruc').val('');
   $('#cli_telf').val('');
   $('#cli_correo').val('');
   $('#cli_direcc').val('');
   $('#lbltitulo').html('Nuevo Registro');
   $("#mantenimiento_form")[0].reset();
   /* TODO: Mostrar Modal */
   $('#Modalcliente').modal('show');
});

init();