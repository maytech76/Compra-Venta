




document.addEventListener("DOMContentLoaded", function() {
    var opcionesSelect = document.getElementById("tec_id");
    var labelOpciones = document.getElementById("labelOpciones");
    
    opcionesSelect.addEventListener("change", function() {
        if (opcionesSelect.value !== 'na') {
            labelOpciones.style.color = "black";
            opcionesSelect.classList.remove("form-select");
            opcionesSelect.classList.add("form-select-success");
        } else {
            labelOpciones.style.color = "red";
            opcionesSelect.classList.remove("form-select-success");
            opcionesSelect.classList.add("form-select");
        } 


   });

});
