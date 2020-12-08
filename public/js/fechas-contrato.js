function mostrar() {
    var x = $('#duracion_c').val();
    var i, k;
    for (i = 1; i <= x; i++) {
        agregar(i);
        var divs = document.getElementsByClassName("hola").length;
        if (divs > x) {
            eliminar();
            for (k = 1; k <= x; k++) {
                agregar(k);
            }
        }
    }
}

function agregar(num) {
    $("#fechas_con").append('\<div class="hola" style="display: flex">\<input class="form-control" type="date" name="fecha_inicio'+(num)+'"><input class="form-control" type="date" name="fecha_fin'+(num)+'"><input id="currency-field" data-type="currency" class="form-control" type="text" name="cantidad'+(num)+'" placeholder="Cantidad...">\</div>');
}
function eliminar() {
    $('#fechas_con').empty();
}

function editar() {
    var z = $('#duracion_c').val();
    var y = document.getElementsByClassName('fec_i').length;
    var i, k;
    var x = (z-y);
    if (z<=y){
        eliminar();
    }
    for (i = 1; i <= x; i++) {
        agregar(i);
        var divs = document.getElementsByClassName("hola").length;
        if (divs > x) {
            eliminar();
            for (k = 1; k <= x; k++) {
                agregar(k);
            }
        }
    }
}
