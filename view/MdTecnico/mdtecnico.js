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
       url:"../../controller/tecnico.php?op=guardaryeditar",
       type:"POST",
       data:formData,
       contentType:false,
       processData:false,
       success:function(data){
           $('#tabla_tecnico').DataTable().ajax.reload();
           $('#Modaltecnico').modal('hide'); 

           /* TODO: Mensaje Registro de tecnico Confirmado*/
           swal.fire({
               title:'Tecnico',
               text: 'Registro Confirmado',
               icon: 'success',
               showConfirmButton: false,
               timer: 1500
           }); 
        } 
    });

}

/* TODO:FUNCION LISTAR CATEGORIA SEGUN SUC_ID */
$(document).ready(function(){


   /* TODO: Listar informacion en el datatable js */
   $('#tabla_tecnico').DataTable({
       "aProcessing": true,
       "aServerSide": true,
       dom: 'Bfrtip',
       buttons: [
           'copyHtml5',
           'excelHtml5',
           'csvHtml5',
       ],
       "ajax":{
           url:"../../controller/tecnico.php?op=listar",
           type:"post",
           data:{suc_id:suc_id}
       },
       "bDestroy": true,
       "responsive": true,
       "bInfo":true,
       "iDisplayLength": 6,
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


 /* MODAL EDITAR REGISTRO */
/* TODO:FUNCION EDITAR REGISTRO TECNICO  SEGUN TEC_ID */
function editar(tec_id){
   $.post("../../controller/tecnico.php?op=mostrar",{tec_id:tec_id},function(data){
       data=JSON.parse(data);
       console.log(data);
       $('#tec_id').val(data.TEC_ID);
       $('#suc_id').val(data.SUC_ID);
       $('#tec_doc').val(data.TEC_DOC);
       $('#tec_nom').val(data.TEC_NOM);
       $('#tec_ape').val(data.TEC_APE);
       $('#tec_celular').val(data.TEC_CELULAR);
       $('#tec_correo').val(data.TEC_CORREO);
       $('#comision_porc').val(data.COMISION_PORC);
       $('#pre_imagen').html(data.TEC_IMG);
    });
    $('#lbltitulo').html('Editar Registro');
    /* TODO: Mostrar Modal */
    $('#Modaltecnico').modal('show');
}



/* TODO:FUNCION ELIMINAR DE LISTA A TECNICO  SEGUN TEC_ID */
function eliminar(tec_id){
   swal.fire({
       title:"Eliminar!",
       text:"Seguro de Eliminar el Registro?",
       icon: "warning",
       confirmButtonText : "Si",
       showCancelButton : true,
       cancelButtonText: "No",
   }).then((result)=>{
       if (result.value){
           $.post("../../controller/tecnico.php?op=eliminar",{tec_id:tec_id},function(data){
               console.log(data);
           });

           $('#tabla_tecnico').DataTable().ajax.reload();

           swal.fire({
               title:'Tecnico',
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
   $('#tec_id').val('');
   $('#tec_nom').val('');
   $('#lbltitulo').html('Nuevo Registro');
   $("#mantenimiento_form")[0].reset();
   /* TODO: Mostrar Modal */
   $('#Modaltecnico').modal('show');
});



function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#pre_imagen').html('<img src='+e.target.result+' class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}


$(document).on('change','#tec_img',function(){
    filePreview(this);
});



/* TODO:Imagen Por defecto cuando no seleciones una imagen para el producto */
$(document).on("click","#btnremovephoto",function(){
    $('#tec_img').val('');
    $('#pre_imagen').html('<img src="../../assets/images/tecnicos/not_photo.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_producto_imagen" value="" />');
});

init();