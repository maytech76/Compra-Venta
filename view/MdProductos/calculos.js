$(document).ready(function() {

    /* Calculo de precio de venta Calculando costo y utilidad */
    $('#calcular').click(function(e) {

        e.preventDefault();

        var costo = parseFloat($('#prod_pcompra').val());
        var costo2 = parseFloat($('#costosadd').val());
        var utilidad = parseFloat($('#utilidad').val());

        if (isNaN(costo2)){
            var costo2 = 0
        }

        var calculoutil = '';
        
        if (!isNaN(costo) && !isNaN(utilidad)) {
                        
            var calculoutil = 1 - (utilidad / 100);
            var CostoTotal = costo + costo2;  
            var precioVenta = CostoTotal/calculoutil;
            $('#prod_pventa').val(precioVenta.toFixed(2));
        }
    });


    /* calculo de utilidad con datos de costo y precio */
    $('#precio').on('input', function() {
        /* var costo = parseFloat($('#costo').val()); */

       /*  var precioVenta = parseFloat($(this).val()); */

       var precioVenta = parseFloat($('#prod_pventa').val());
        var CostoTotal = costo + costo2;
        if (!isNaN(CostoTotal) && !isNaN(precioVenta)) {
            var utilidad = ((precioVenta - CostoTotal) / CostoTotal) * 100;
            $('#utilidad').val(utilidad.toFixed(2));
        }
    });
});