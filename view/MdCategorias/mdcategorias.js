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
        url:"../../controller/categoria.php?op=guardaryeditar",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            $('#tablacategoria').DataTable().ajax.reload();
            $('#Modalcategoria').modal('hide'); 

            /* TODO: Mensaje Registro de categoria Confirmado*/
            swal.fire({
                title:'Categoria',
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
    $('#tablacategoria').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"../../controller/categoria.php?op=listar",
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


/* TODO:FUNCION EDITAR REGISTRO CATEGORIA  SEGUN CAT_ID */
function editar(cat_id){
    $.post("../../controller/categoria.php?op=mostrar",{cat_id:cat_id},function(data){
        data=JSON.parse(data);
        console.log(data);
        $('#cat_id').val(data.CAT_ID);
        $('#cat_nom').val(data.CAT_NOM);
    });
    $('#lbltitulo').html('Editar Registro');
    /* TODO: Mostrar Modal */
    $('#Modalcategoria').modal('show');
}


/* TODO:FUNCION ELIMINAR DE LISTA A CATEGORIA  SEGUN CAT_ID */
function eliminar(cat_id){
    swal.fire({
        title:"Eliminar!",
        text:"Seguro de Eliminar el Registro?",
        icon: "warning",
        confirmButtonText : "Si",
        showCancelButton : true,
        cancelButtonText: "No",
    }).then((result)=>{
        if (result.value){
            $.post("../../controller/categoria.php?op=eliminar",{cat_id:cat_id},function(data){
                console.log(data);
            });

            $('#tablacategoria').DataTable().ajax.reload();

            swal.fire({
                title:'Categoria',
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
    $('#cat_id').val('');
    $('#cat_nom').val('');
    $('#lbltitulo').html('Nuevo Registro');
    $("#mantenimiento_form")[0].reset();
    /* TODO: Mostrar Modal */
    $('#Modalcategoria').modal('show');
});

init();