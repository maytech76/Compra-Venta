var suc_id = $('#SUC_IDx').val(); 

/* TODO: FUNCION BOTON SUMIT DEL FORMULARIO MANTENIMIENTO */
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
       url:"../../controller/vendedor.php?op=guardaryeditar",
       type:"POST",
       data:formData,
       contentType:false,
       processData:false,
       success:function(data){
           $('#tabla_vendedor').DataTable().ajax.reload();
           $('#Modalvendedor').modal('hide'); 

           /* TODO: Mensaje Registro de cliente Confirmado*/
           swal.fire({
               title:'Vendedor',
               text: 'Registro Confirmado',
               icon: 'success',
               showConfirmButton: false,
               timer: 1500
           }); 
        } 
    });
    console.log(data);

}


$(document).ready(function(){
   

   /* TODO: Listar informacion en el datatable js */
   $('#tabla_vendedor').DataTable({
       "aProcessing": true,
       "aServerSide": true,
       dom: 'Bfrtip',
       buttons: [
           'copyHtml5',
           'excelHtml5',
           'csvHtml5',
       ],
       "ajax":{
           url:"../../controller/vendedor.php?op=listar",
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


/* TODO:FUNCION EDITAR REGISTRO VENDEDOR  SEGUN VEND_ID */
function editar(vend_id){
   $.post("../../controller/vendedor.php?op=mostrar",{vend_id:vend_id},function(data){
       data=JSON.parse(data);
       console.log(data);
       /* TODO:Campos a Mostrar en Modal Editar */
       $('#vend_id').val(data.VEND_ID);
       $('#suc_id').val(data.SUC_ID);
       $('pre_imagen').html(data.VEND_IMG);
       $('#vend_nom').val(data.VEND_NOM);
       $('#vend_rut').val(data.VEND_RUT);
       $('#vend_telef').val(data.VEND_TELEF);
       $('#vend_correo').val(data.VEND_CORREO);
       $('#comision_porc').val(data.COMISION_PORC);
      
      
   });
   $('#lbltitulo').html('Editar Ficha de Vendedor');
   /* TODO: Mostrar Modal */
   $('#Modalvendedor').modal('show');
}


/* TODO:FUNCION ELIMINAR DE LISTA A CLIENTE  SEGUN VEND_ID */
function eliminar(vend_id){
   swal.fire({
       title:"Eliminar!",
       text:"Seguro de Eliminar el Registro?",
       icon: "warning",
       confirmButtonText : "Si",
       showCancelButton : true,
       cancelButtonText: "No",
   }).then((result)=>{
       if (result.value){
           $.post("../../controller/vendedor.php?op=eliminar",{vend_id:vend_id},function(data){
               console.log(data);
           });

           $('#tabla_vendedor').DataTable().ajax.reload();

           swal.fire({
               title:'Vendedor',
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
   $('#vend_id').val('');
   $('#pre_imagen').html('<img src="../../assets/images/vendedores/not_photo.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image"></img><input type="hidden" name="hidden_vendedor_imagen" value="" />');
   $('#vend_nom').val('');
   $('#vend_rut').val('');
   $('#vend_telef').val('');
   $('#vend_correo').val('');
   $('#comision_porc').val('');
   $('#lbltitulo').html('Nuevo Registro (Vendedor)');
   $("#mantenimiento_form")[0].reset();
   /* TODO: Mostrar Modal */
   $('#Modalvendedor').modal('show');
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

$(document).on('change','#vend_img',function(){
    filePreview(this);
});

/* TODO:Imagen Por defecto cuando no seleciones una imagen para el producto */
$(document).on("click","#btnremovephoto",function(){
    $('#vend_img').val('');
    $('#pre_imagen').html('<img src="../../assets/images/vendedores/not_photo.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_vendedor_imagen" value="" />');
});


init();