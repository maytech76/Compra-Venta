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
       url:"../../controller/proveedor.php?op=guardaryeditar",
       type:"POST",
       data:formData,
       contentType:false,
       processData:false,
       success:function(data){
           $('#tablaproveedor').DataTable().ajax.reload();
           $('#Modalproveedor').modal('hide'); 

           /* TODO: Mensaje Registro de proveedor Confirmado*/
           swal.fire({
               title:'Proveedor',
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
   $('#tablaproveedor').DataTable({
       "aProcessing": true,
       "aServerSide": true,
       dom: 'Bfrtip',
       buttons: [
           'copyHtml5',
           'excelHtml5',
           'csvHtml5',
       ],
       "ajax":{
           url:"../../controller/proveedor.php?op=listar",
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




/* TODO:FUNCION EDITAR REGISTRO PROVEEDOR  SEGUN PROV_ID */
function editar(prov_id){
   $.post("../../controller/proveedor.php?op=mostrar",{prov_id:prov_id},function(data){
       data=JSON.parse(data);
       console.log(data);
       /* TODO:Campos a Mostrar en Modal Editar */
       $('#prov_id').val(data.PROV_ID);
       $('#emp_id').val(data.EMP_ID);
       $('#prov_nom').val(data.PROV_NOM);
       $('#prov_ruc').val(data.PROV_RUC);
       $('#prov_telf').val(data.PROV_TELF);
       $('#prov_correo').val(data.PROV_CORREO);
       $('#prov_direcc').val(data.PROV_DIRECC);
      
   });
   $('#lbltitulo').html('Editar Registro');
   /* TODO: Mostrar Modal */
   $('#Modalproveedor').modal('show');
}




/* TODO:FUNCION ELIMINAR DE LISTA A PROVEEDOR  SEGUN PROV_ID */
function eliminar(prov_id){
   swal.fire({
       title:"Eliminar!",
       text:"Seguro de Eliminar el Registro?",
       icon: "warning",
       confirmButtonText : "Si",
       showCancelButton : true,
       cancelButtonText: "No",
   }).then((result)=>{
       if (result.value){
           $.post("../../controller/proveedor.php?op=eliminar",{prov_id:prov_id},function(data){
               console.log(data);
           });

           $('#tablaproveedor').DataTable().ajax.reload();

           swal.fire({
               title:'Proveedor',
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
   $('#prov_id').val('');
   $('#prov_nom').val('');
   $('#prov_ruc').val('');
   $('#prov_telf').val('');
   $('#prov_correo').val('');
   $('#prov_direcc').val('');
   $('#lbltitulo').html('Nuevo Registro');
   $("#mantenimiento_form")[0].reset();
   /* TODO: Mostrar Modal */
   $('#Modalproveedor').modal('show');
});

init();