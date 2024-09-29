var com_id = $('#COM_IDx').val(); 
 


function init(){
   $("#mantenimiento_form").on("submit",function(e){
       guardaryeditar(e);
   });
} 

/* TODO:FUNCION EDITAR - REGISTRAR */
function guardaryeditar(e){
   e.preventDefault();
   var formData = new FormData($("#mantenimiento_form")[0]);
   formData.append('com_id',$('#COM_IDx').val()); 
   /* TODO: Guardar Informacion */
   $.ajax({
       url:"../../controller/empresa.php?op=guardaryeditar",
       type:"POST",
       data:formData,
       contentType:false,
       processData:false,
       success:function(data){
           $('#tablaempresa').DataTable().ajax.reload();
           $('#Modalempresa').modal('hide'); 

           /* TODO: Mensaje Registro de empresa Confirmado*/
           swal.fire({
               title:'Empresa',
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
   $('#tablaempresa').DataTable({
       "aProcessing": true,
       "aServerSide": true,
       dom: 'Bfrtip',
       buttons: [
           'copyHtml5',
           'excelHtml5',
           'csvHtml5',
       ],
       "ajax":{
           url:"../../controller/empresa.php?op=listar",
           type:"post",
           data:{com_id:com_id}
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



/* TODO:FUNCION EDITAR REGISTRO EMPRESA  SEGUN EMP_ID */
function editar(emp_id){
   $.post("../../controller/empresa.php?op=mostrar",{emp_id:emp_id},function(data){
       data=JSON.parse(data);
       console.log(data);
       $('#emp_id').val(data.EMP_ID);
       $('#com_id').val(data.COM_ID);
       $('#emp_nom').val(data.EMP_NOM);
       $('#emp_ruc').val(data.EMP_RUC);
       $('#emp_correo').val(data.EMP_CORREO);
       $('#emp_telf').val(data.EMP_TELF);
       $('#emp_direcc').val(data.EMP_DIRECC);
       $('#emp_pag').val(data.EMP_PAG);
       $('#emp_img').val('');
       $('#pre_imagen').html(data.EMP_IMG);
   });

   $('#lbltitulo').html('Editar Registro');
   /* TODO: Mostrar Modal */
   $('#Modalempresa').modal('show');
}


/* TODO:FUNCION ELIMINAR DE LISTA A EMPRESA  SEGUN EMP_ID */
function eliminar(emp_id){
   swal.fire({
       title:"Eliminar!",
       text:"Seguro de Eliminar el Registro?",
       icon: "warning",
       confirmButtonText : "Si",
       showCancelButton : true,
       cancelButtonText: "No",
   }).then((result)=>{
       if (result.value){
           $.post("../../controller/empresa.php?op=eliminar",{emp_id:emp_id},function(data){
               console.log(data);
           });

           $('#tablaempresa').DataTable().ajax.reload();

           swal.fire({
               title:'Empresa',
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
   $('#emp_id').val('');
   $('#emp_nom').val('');
   $('#emp_ruc').val('');
   $('#emp_correo').val('');
   $('#emp_telf').val('');
   $('#emp_direcc').val('');
   $('#emp_pag').val('');
   $('#emp_img').val('');
   $('#lbltitulo').html('Nuevo Registro');
   $('#pre_imagen').html('<img src="../../assets/images/empresa/no_image.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_empresa_imagen" value="" />');
   $("#mantenimiento_form")[0].reset();
   /* TODO: Mostrar Modal */
   $('#Modalempresa').modal('show');
});



function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#pre_imagen').html('<img src='+e.target.result+' class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="empresa-profile-image"></img>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}


$(document).on('change','#emp_img',function(){
    filePreview(this);
});


/* TODO:Imagen Por defecto cuando no seleciones una imagen para el producto */
$(document).on("click","#btnremovephoto",function(){
    $('#emp_img').val('');
    $('#pre_imagen').html('<img src="../../assets/images/empresa/no_image.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="empresa-profile-image"></img><input type="hidden" name="hidden_empresa_imagen" value="" />');
});

init();