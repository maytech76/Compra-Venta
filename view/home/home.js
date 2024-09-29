var suc_id = $('#SUC_IDx').val();

$.post("../../controller/compra.php?op=listartopproducto",{suc_id:suc_id},function(data){
    $("#top5compras").html(data);  
});


$.post("../../controller/venta.php?op=top5ventas",{suc_id:suc_id},function(data){
    $("#top5ventas").html(data);
    console.log(data);
});