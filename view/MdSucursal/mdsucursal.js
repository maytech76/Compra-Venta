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
       url:"../../controller/sucursal.php?op=guardaryeditar",
       type:"POST",
       data:formData,
       contentType:false,
       processData:false,
       success:function(data){
           $('#tablasucursal').DataTable().ajax.reload();
           $('#Modalsucursal').modal('hide'); 

           /* TODO: Mensaje Registro de sucursal Confirmado*/
           swal.fire({
               title:'Sucursal',
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
   $('#tablasucursal').DataTable({
       "aProcessing": true,
       "aServerSide": true,
       dom: 'Bfrtip',
       buttons: [
           'copyHtml5',
           'excelHtml5',
           'csvHtml5',
       ],
       "ajax":{
           url:"../../controller/sucursal.php?op=listar",
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


/* TODO:FUNCION EDITAR REGISTRO SUCURSAL  SEGUN SUC_ID */
function editar(suc_id){
   $.post("../../controller/sucursal.php?op=mostrar",{suc_id:suc_id},function(data){
       data=JSON.parse(data);
       console.log(data);
       $('#suc_id').val(data.SUC_ID);
       $('#suc_nom').val(data.SUC_NOM);
       $('#fech_crea').val(data.FECH_CREA);
    
   });
   $('#lbltitulo').html('Editar Registro');
   /* TODO: Mostrar Modal */
   $('#Modalsucursal').modal('show');
}


/* TODO:FUNCION ELIMINAR DE LISTA A SUCURSAL  SEGUN SUC_ID */
function eliminar(suc_id){
   swal.fire({
       title:"Eliminar!",
       text:"Seguro de Eliminar el Registro?",
       icon: "warning",
       confirmButtonText : "Si",
       showCancelButton : true,
       cancelButtonText: "No",
   }).then((result)=>{
       if (result.value){
           $.post("../../controller/sucursal.php?op=eliminar",{suc_id:suc_id},function(data){
               console.log(data);
           });

           $('#tablasucursal').DataTable().ajax.reload();

           swal.fire({
               title:'Sucursal',
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
   $('#suc_id').val('');
   $('#suc_nom').val('');
   $('#lbltitulo').html('Nuevo Registro');
   $("#mantenimiento_form")[0].reset();
   /* TODO: Mostrar Modal */
   $('#Modalsucursal').modal('show');
});

init();