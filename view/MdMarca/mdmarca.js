var suc_id = $('#SUC_IDx').val(); 

function init(){
   $("#mantenimiento_form").on("submit",function(e){
       guardaryeditar(e);
   });
} 

/* TODO:FUNCION EDITAR - REGISTRAR */
function guardaryeditar(e){
   e.preventDefault();
   var formData = new FormData($("#mantenimiento_form")[0]);
   formData.append('suc_id',$('#SUC_IDx').val()); 
   /* TODO: Guardar Informacion */
   $.ajax({
       url:"../../controller/marca.php?op=guardaryeditar",
       type:"POST",
       data:formData,
       contentType:false,
       processData:false,
       success:function(data){
           $('#tablamarca').DataTable().ajax.reload();
           $('#Modalmarca').modal('hide'); 

           /* TODO: Mensaje Registro de marca Confirmado*/
           swal.fire({
               title:'Marca',
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
   $('#tablamarca').DataTable({
       "aProcessing": true,
       "aServerSide": true,
       dom: 'Bfrtip',
       buttons: [
           'copyHtml5',
           'excelHtml5',
           'csvHtml5',
       ],
       "ajax":{
           url:"../../controller/marca.php?op=listar",
           type:"post",
           data:{suc_id:suc_id}
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


/* TODO:FUNCION EDITAR REGISTRO MARCA  SEGUN MRC_ID */
function editar(mrc_id){
   $.post("../../controller/marca.php?op=mostrar",{mrc_id:mrc_id},function(data){
       data=JSON.parse(data);
       console.log(data);
       $('#mrc_id').val(data.MRC_ID);
       $('#mrc_nom').val(data.MRC_NOM);
   });
   $('#lbltitulo').html('Editar Registro');
   /* TODO: Mostrar Modal */
   $('#Modalmarca').modal('show');
}


/* TODO:FUNCION ELIMINAR DE LISTA A MARCA  SEGUN MRC_ID */
function eliminar(mrc_id){
   swal.fire({
       title:"Eliminar!",
       text:"Seguro de Eliminar el Registro?",
       icon: "warning",
       confirmButtonText : "Si",
       showCancelButton : true,
       cancelButtonText: "No",
   }).then((result)=>{
       if (result.value){
           $.post("../../controller/marca.php?op=eliminar",{mrc_id:mrc_id},function(data){
               console.log(data);
           });

           $('#tablamarca').DataTable().ajax.reload();

           swal.fire({
               title:'Marca',
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
   $('#mrc_id').val('');
   $('#mrc_nom').val('');
   $('#lbltitulo').html('Nuevo Registro');
   $("#mantenimiento_form")[0].reset();
   /* TODO: Mostrar Modal */
   $('#Modalmarca').modal('show');
});

init();