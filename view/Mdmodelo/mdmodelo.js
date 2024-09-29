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
       url:"../../controller/modelo.php?op=guardaryeditar",
       type:"POST",
       data:formData,
       contentType:false,
       processData:false,
       success:function(data){
           $('#tablamodelo').DataTable().ajax.reload();
           $('#Modalmodelo').modal('hide'); 

           /* TODO: Mensaje Registro de modelo Confirmado*/
           swal.fire({
               title:'Modelo',
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
     $.post("../../controller/marca.php?op=combo",{suc_id:suc_id},function(data){
        $("#mrc_id").html(data);
    });
   

    /* TODO: Listar informacion en el datatable js */
    $('#tablamodelo').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"../../controller/modelo.php?op=listar",
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


/* TODO:FUNCION EDITAR REGISTRO MODELO  SEGUN MOD_ID */
function editar(mod_id){
   $.post("../../controller/modelo.php?op=mostrar",{mod_id:mod_id},function(data){
       data=JSON.parse(data);
       console.log(data);
       $('#mod_id').val(data.MOD_ID);
       $('#mod_nom').val(data.MOD_NOM);
       $('#mrc_id').val(data.MRC_ID);
   });
   $('#lbltitulo').html('Editar Registro');
   /* TODO: Mostrar Modal */
   $('#Modalmodelo').modal('show');
}


/* TODO:FUNCION ELIMINAR DE LISTA A MODELO  SEGUN MOD_ID */
function eliminar(mod_id){
   swal.fire({
       title:"Eliminar!",
       text:"Seguro de Eliminar el Registro?",
       icon: "warning",
       confirmButtonText : "Si",
       showCancelButton : true,
       cancelButtonText: "No",
   }).then((result)=>{
       if (result.value){
           $.post("../../controller/modelo.php?op=eliminar",{mod_id:mod_id},function(data){
               console.log(data);
           });

           $('#tablamodelo').DataTable().ajax.reload();

           swal.fire({
               title:'Modelo',
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
   $('#mod_id').val('');
   $('#mod_nom').val('');
   $('#lbltitulo').html('Nuevo Registro');
   $("#mantenimiento_form")[0].reset();
   /* TODO: Mostrar Modal */
   $('#Modalmodelo').modal('show');
});

init();