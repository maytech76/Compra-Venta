var emp_id = $('#EMP_IDx').val();
var suc_id = $('#SUC_IDx').val();
var usu_id = $('#USU_IDx').val();



/* JAVASCRIPT RECEPCION */

$(document).ready(function(){

    $('#cli_id').select2();

   /* TODO:FUNCIONES Y PARAMETROS PARA SELECT CLIENTE, MARCA, MODELO, TIPO_VH  */
  

    $.post("../../controller/cliente.php?op=combo",{emp_id:emp_id},function(data){
        $("#cli_id").html(data);
    });



    $.post("../../controller/marca.php?op=combo",{suc_id:suc_id},function(data){
        $("#mrc_id").html(data);
    });



    /* Marca 2 */
    $.post("../../controller/marca.php?op=combo",{suc_id:suc_id},function(data){
        $("#mrc2_id").html(data);
    });

    

    $.post("../../controller/modelo.php?op=combo",{suc_id:suc_id},function(data){
        $("#mod_id").html(data);
    });



    $.post("../../controller/tipovehiculo.php?op=combo",{suc_id:suc_id},function(data){
        $("#tipo_id").html(data);
    });



    $.post("../../controller/rol.php?op=correlativo",function(data){
        $("#correlativo").html(data);
    });



     /* TODO:Funcion Change para datos del proveedor selecionado */
    $("#cli_id").change(function(){
        $("#cli_id").each(function(){
            cli_id = $(this).val();
            $.post("../../controller/cliente.php?op=mostrar",{cli_id:cli_id},function(data){
                data=JSON.parse(data);
                /* Asignando a etiquetas id los valores de los campos RUT, DIRECCION DE PROVEEDOR, TELEFONO, CORREO */
                $('#cli_ruc').val(data.CLI_RUC);
                $('#cli_direcc').val(data.CLI_DIRECC);
                $('#cli_telf').val(data.CLI_TELF);
                $('#cli_correo').val(data.CLI_CORREO);
            });
        });
    });



    /* TODO:Funcion Change para datos del MODELO SEGUN MARCA SELECCIONADA */
    $("#mrc_id").change(function(){
        $("#mrc_id").each(function(){
            mrc_id = $(this).val();

            $.post("../../controller/modelo.php?op=combo2",{mrc_id:mrc_id},function(data){
                $("#mod_id").html(data);
            });

        });
    });




    /* TODO:Funcion Change para datos del MARCA EN EL SELECT MODELO SEGUN MARCA SELECCIONADA */
    $("#mrc_id").change(function(){
        $("#mrc_id").each(function(){
            mrc_id = $(this).val();

            $.post("../../controller/marca.php?op=combo2",{mrc_id:mrc_id},function(data){
                $("#mrc2_id").html(data);
            });

        });
    }); 


    $("#luces, #rueda, #cases, #docs, #casco, #fuel, #tools, #otros").on("click", function() {
        if ($(this).is(":checked")) {
            $(this).val($(this).attr("name"));
        } else {
            $(this).val("nada");
        }
    });


     /* VISUALIZAR TODAS LAS RECEPCIONES SEGUN SUC_ID */

    /* TODO: Listar informacion en el datatable js */
   $('#tabla_recepcion').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
    ],
    "ajax":{
        url:"../../controller/recepcion.php?op=listar",
        type:"post",
        data:{suc_id:suc_id}
    },
    "bDestroy": true,
    "responsive": true,
    "bInfo":true,
    "iDisplayLength": 10,
    "order": [[ 0, "asc" ]],
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


}); /* END DOCUMENT READY */




/* AL realizar un click en btnguardar se alamacenaran todos los campos
en la tabla td_compra_detalle con sus valores recibidos desde la vista de cada input */
$(document).on("click","#btnguardar",function(){
    var suc_id = $('#SUC_IDx').val();
    var usu_id = $('#USU_IDx').val();
    var cli_id = $("#cli_id").val();
    var mrc_id = $("#mrc_id").val();
    var mod_id = $("#mod_id").val();
    var tipo_id = $("#tipo_id").val();
    var tipo_serv = $("#tipo_serv").val();

    var klm = $("#klm").val();
    var serialch = $("#serialch").val();
    var patente = $("#patente").val();

    var luces = $("#luces").val();
    var rueda = $("#rueda").val();
    var cases = $("#cases").val();
    var docs = $("#docs").val();
    var casco = $("#casco").val();
    var fuel = $("#fuel").val();
    var tools = $("#tools").val();
    var otros = $("#otros").val();
    var coment = $("#coment").val();

  
   

      /* TODO:Validacion de recepcion , Marca_vehiculo , Modelo_vehiculo, tipo_vehiculo */
       if($("#cli_id").val()=='0' || $("#mrc_id").val()=='0' || $("#mod_id").val()=='0' || $("#tipo_id").val()=='0'){
      
        swal.fire({
            title:'Recepcion',
            text: 'Error Campos Vacios',
            icon: 'error'
        });

       }else{ 
                /* Registro de recepcion de servicio en tabla tm_recepcion */
                $.post("../../controller/recepcion.php?op=guardar",{
                    suc_id,
                    usu_id:usu_id,
                    cli_id:cli_id,
                    mrc_id:mrc_id,
                    mod_id:mod_id,
                    tipo_id:tipo_id,
                    tipo_serv:tipo_serv,
                    klm:klm,
                    serialch:serialch,
                    patente:patente,
                    luces:luces,
                    rueda:rueda,
                    cases:cases,
                    docs:docs,
                    casco:casco,
                    fuel:fuel,
                    tools:tools,
                    otros:otros,
                    coment:coment,
                    
                },function(data){
                    console.log(data);
                    /* TODO:Mensaje de Sweetalert */
                    swal.fire({
                        title:'Recepcion',
                        /* TODO:Mostrar mensaje con N° de Compra */
                        text: 'Recepcion Registrada Correctamente.!'/* +rcn */,
                        icon: 'success',
                         /* TODO: Ruta para mostrar documento de compra en otra comprana del Explorador */
                        /*  footer: "<a href='../ViewRecepcion/?rc="+number+"'>Desea ver el Documento?</a>" */
                        showConfirmButton: false,
                        
                    });

                    setTimeout(function() {
                        window.location.href = "ListRecepcion.php";
                      }, 1500);

                   
                    

                });

            
            }

});



/* JAVASCRIPT RECEPCION */

function init(){
   $("#mantenimiento_form").on("submit",function(e){
       guardaryeditar(e);
   });

   

   $("#mantenimiento_form").on("submit",function(e){
    guardar_cliente(e);
  
   });


   $("#tipovh_form").on("submit",function(e){
    guardar_tipovh(e);
  
   });


   $("#marca_form").on("submit",function(e){
    guardar_marca(e);
  
   });


   $("#modelo_form").on("submit",function(e){
    guardar_modelo(e);
  
   });


} 

/* TODO:FUNCION QUE MUESTRA LOS CAMPOS DE RECEPCION  SEGUN RCN_ID */
function editar(rcn_id){
    $.post("../../controller/recepcion.php?op=mostrando",{rcn_id:rcn_id},function(data){
        data=JSON.parse(data);
        console.log(data);
        $('#rcn_id').val(data.RCN_ID);
        $('#suc_id').val(data.SUC_ID);
        $('#usu_nom').html(data.USU_NOM);
        $('#cli_id').val(data.CLI_ID);
        $('#cli_nom').val(data.CLI_NOM);
        $('#cli_ruc').val(data.CLI_RUC);
        $('#cli_telf').val(data.CLI_TELF);
        $('#cli_direcc').val(data.CLI_DIRECC);
        $('#cli_correo').val(data.CLI_CORREO);
        $('#mrc_id').val(data.MRC_ID);
        $('#mod_id').val(data.MOD_ID);
        $('#tipo_id').val(data.TIPO_ID);
        $('#tipo_serv').val(data.TIPO_SERV);
        $('#klm').val(data.KLM);
        $('#serialch').val(data.SERIALCH);
        $('#patente').val(data.PATENTE);
        $('#fech_crea').val(data.FECH_CREA);
    });
 
     /* TITULO PARA EL MODAL */
    $('#lbltitulo2').html('Editar Recepción');
    /* TODO: Mostrar Modal */
    $('#edit_recepcion').modal('show');
}





 /* TODO:FUNCION EDITAR - RECEPCION  */
function guardaryeditar(e){
   e.preventDefault();
   var formData = new FormData($("#mantenimiento_form")[0]);
   formData.append('suc_id',$('#SUC_IDx').val()); 
    /* TODO: Guardar Informacion  */
     $.ajax({
       url:"../../controller/recepcion.php?op=editar",
       type:"POST",
       data:formData,
       contentType:false,
       processData:false,
       success:function(data){
           $('#tabla_recepcion').DataTable().ajax.reload();
           $('#edit_recepcion').modal('hide'); 

             /* TODO: Mensaje Registro de categoria Confirmado */
               swal.fire({
               title:'Recepcion',
               text: 'Edicion Confirmada',
               icon: 'success',
               showConfirmButton: false,
               timer: 1500 
              });  
        } 
    }); 

}  


 /* TODO:FUNCION REGISTRAR NUEVO CLIENTE  */
 function guardar_cliente(e){
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
           $('#newcliente').modal('hide');

           $.post("../../controller/cliente.php?op=combo",{emp_id:emp_id},function(data){
            $("#cli_id").html(data); });
          
 
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



/* TODO:FUNCION REGISTRAR NUEVO TIPO DE MOTO  */
function guardar_tipovh(e){
    e.preventDefault();
    var formData = new FormData($("#tipovh_form")[0]);
    formData.append('suc_id',$('#SUC_IDx').val()); 
    /* TODO: Guardar Informacion */
    $.ajax({
        url:"../../controller/tipovehiculo.php?op=guardaryeditar",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            $('#tipovh').modal('hide'); 

            $.post("../../controller/tipovehiculo.php?op=combo",{suc_id:suc_id},function(data){
                $("#tipo_id").html(data); });
           
 
            /* TODO: Mensaje Registro de tipo Confirmado*/
            swal.fire({
                title:'Tipo',
                text: 'Registro Confirmado',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            }); 
         } 
     });
 
 }


 /* TODO:FUNCION  REGISTRAR  NUEVA MARCA*/
function guardar_marca(e){
    e.preventDefault();
    var formData = new FormData($("#marca_form")[0]);
    formData.append('suc_id',$('#SUC_IDx').val()); 
    /* TODO: Guardar Informacion */
    $.ajax({
        url:"../../controller/marca.php?op=guardaryeditar",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
           
            $('#new_marca').modal('hide');

            $.post("../../controller/marca.php?op=combo",{suc_id:suc_id},function(data){
                $("#mrc_id").html(data);
            });

 
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


 /* TODO:FUNCION REGISTRAR NUEVO MODELO */
function guardar_modelo(e){
    e.preventDefault();
    var formData = new FormData($("#modelo_form")[0]);
    formData.append('suc_id',$('#SUC_IDx').val()); 
    /* TODO: Guardar Informacion */
    $.ajax({
        url:"../../controller/modelo.php?op=guardaryeditar2",
        type:"POST",
        data:formData,
        contentType:false,
        processData:false,
        success:function(data){
            
            $('#new_modelo').modal('hide'); 

            $.post("../../controller/modelo.php?op=combo",{suc_id:suc_id},function(data){
                $("#mod_id").html(data); });
 
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


/* TODO:FUNCION ELIMINAR DE LISTA A RECEPCION  SEGUN RCN_ID */
function eliminar(rcn_id){
   swal.fire({
       title:"Eliminar!",
       text:"Seguro de Eliminar el Registro?",
       icon: "warning",
       confirmButtonText : "Si",
       showCancelButton : true,
       cancelButtonText: "No",
   }).then((result)=>{
       if (result.value){
           $.post("../../controller/recepcion.php?op=eliminar",{rcn_id:rcn_id},function(data){
               console.log(data);
           });

           $('#tabla_recepcion').DataTable().ajax.reload();

           swal.fire({
               title:'N° de Recepcion',
               text: 'Eliminada',
               icon: 'success',
               showConfirmButton: false,
               timer: 1500
           });
       }
   });
}



/* EJECUTAL MODALES SEGUN BOTON SELECIONADO */

    $(document).on("click","#btncliente",function(){
        /* TODO: Limpiar informacion */
        $('#cat_id').val('');
        $('#cat_nom').val('');
        $('#lbltitulo').html('Nuevo Cliente');
        $("#mantenimiento_form")[0].reset();
        /* TODO: Mostrar Modal */
        $('#newcliente').modal('show');
    });

 
    $(document).on("click","#btnmodelo",function(){
     /* TODO: Limpiar informacion */
     $('#mod_id').val('');
     $('#mod_nom').val('');
     $('#lblmodelo').html('Nuevo Modelo');
     $("#modelo_form")[0].reset();
     /* TODO: Mostrar Modal */
     $('#new_modelo').modal('show');
    });


    
    $(document).on("click","#btnmarca",function(){
        /* TODO: Limpiar informacion */
        $('#mrc_id').val('');
        $('#mrc_nom').val('');
        $('#lblmarca').html('Nueva Marca');
        $("#marca_form")[0].reset();
        /* TODO: Mostrar Modal */
        $('#new_marca').modal('show');
    });
    


    $(document).on("click","#btntipovh",function(){
       /* TODO: Limpiar informacion */
       $('#tipo_id').val('');
       $('#tipo_nom').val('');
       $('#lbltipovh').html('Nuevo Tipo de Vehiculo');
       $("#tipovh_form")[0].reset();
       /* TODO: Mostrar Modal */
       $('#tipovh').modal('show');
    });

init();