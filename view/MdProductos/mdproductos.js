
var suc_id = $('#SUC_IDx').val(); 
var cat_id = $('#CAT_IDx').val();


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
       url:"../../controller/producto.php?op=guardaryeditar",
       type:"POST",
       data:formData,
       contentType:false,
       processData:false,
       success:function(data){
           $('#tabla_producto').DataTable().ajax.reload();
           $('#Modalproducto').modal('hide'); 

           /* TODO: Mensaje Registro de producto Confirmado*/
           swal.fire({
               title:'Producto',
               text: 'Registro Confirmado',
               icon: 'success',
               showConfirmButton: false,
               timer: 1500
           }); 
        } 
    });

}


$(document).ready(function(){

        /* TODO:Valores para el Select Cactegoria */
        $.post("../../controller/categoria.php?op=combo",{suc_id:suc_id},function(data){
            $("#cat_id").html(data);
        });

        /* TODO:Valores para el Select Unidad CONTROLADOR DE UNIDAD */
        $.post("../../controller/unidad.php?op=combo",{suc_id:suc_id},function(data){
            $("#und_id").html(data);
        });

        /* TODO:Valores para el Select Moneda CONTROLADOR DE MONEDA*/
        $.post("../../controller/moneda.php?op=combo",{suc_id:suc_id},function(data){
            $("#mon_id").html(data);
        });
    

        /* TODO: Listar informacion de productos en el datatable js */
        $('#tabla_producto').DataTable({
            "aProcessing": true,
            "aServerSide": true,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
            ],
            "ajax":{
                url:"../../controller/producto.php?op=listar",
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




/* TODO:FUNCION EDITAR REGISTRO PRODUCTO  SEGUN PROD_ID */
function editar(prod_id){
   $.post("../../controller/producto.php?op=mostrar",{prod_id:prod_id},function(data){
       data=JSON.parse(data);
       console.log(data);
       $('#prod_id').val(data.PROD_ID);
       $('#prod_nom').val(data.PROD_NOM);
       $('#suc_id').val(data.SUC_ID);   
       $('#prod_descrip').val(data.PROD_DESCRIP);
       $('#cat_id').val(data.CAT_ID);
       $('#und_id').val(data.UND_ID);
       $('#mon_id').val(data.MON_ID);
       $('#prod_pcompra').val(data.PROD_PCOMPRA);
       $('#costosadd').val(data.COSTOSADD);
       $('#utilidad').val(data.UTILIDAD);
       $('#prod_pventa').val(data.PROD_PVENTA);
       $('#prod_stock').val(data.PROD_STOCK);
       $('#code_barr').val(data.CODE_BARR);
       $('#prod_img').val('');   /* Mostrar Vacio el valor del campo usu_img al ejecutar el metodo mostrar (editar) */
       $('#pre_imagen').html(data.PROD_IMG);

   });
   $('#lbltitulo').html('Editar Registro');
   /* TODO: Mostrar Modal */
   $('#Modalproducto').modal('show');
   
}


/* TODO:FUNCION ELIMINAR DE LISTA A PRODUCTO  SEGUN PROD_ID */
function eliminar(prod_id){
   swal.fire({
       title:"Eliminar!",
       text:"Seguro de Eliminar el Registro?",
       icon: "warning",
       confirmButtonText : "Si",
       showCancelButton : true,
       cancelButtonText: "No",
   }).then((result)=>{
       if (result.value){
           $.post("../../controller/producto.php?op=eliminar",{prod_id:prod_id},function(data){
               console.log(data);
           });

           $('#tabla_producto').DataTable().ajax.reload();

           swal.fire({
               title:'Producto',
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
   $('#prod_id').val('');
   $('#prod_nom').val('');
   $('#prod_descrip').val('');
   $('#und_id').val('');
   $('#mon_id').val('');
   $('#prod_pcompra').val('');
   $('#prod_pventa').val('');
   $('#prod_stock').val('');
   $('#prod_fechaven').val('');
   $('#prod_img').val('');
   $('#lbltitulo').html('Nuevo Registro');
   $('#pre_imagen').html('<img src="../../assets/images/productos/no_image.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_producto_imagen" value="" />');
   $("#mantenimiento_form")[0].reset();
   /* TODO: Mostrar Modal */
   $('#Modalproducto').modal('show');
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


$(document).on('change','#prod_img',function(){
    filePreview(this);
});


/* TODO:Imagen Por defecto cuando no seleciones una imagen para el producto */
$(document).on("click","#btnremovephoto",function(){
    $('#prod_img').val('');
    $('#pre_imagen').html('<img src="../../assets/images/productos/no_image.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_producto_imagen" value="" />');
});


init();