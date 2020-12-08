function arrendador(id) {
    var nombre = document.getElementById("arrendadorse"+id).innerHTML;
    document.getElementById("arrendadorname").value = nombre;
    document.getElementById("id_arrendador").value = id;
}

function propiedad(id) {
    var nombre = document.getElementById("propiedades"+id).innerHTML;
    document.getElementById("fincaname").value = nombre;
    document.getElementById("id_finca").value = id;
}

function buscador() {
    var nombres = $('.nombres');
    var buscando = $('#buscador').val();
    var item = '';
    for (var i = 0; i < nombres.length; i++) {
        item = $(nombres[i]).html().toLowerCase();
        for (var x = 0; x < item.length; x++) {
            if (buscando.length <= 0 || item.indexOf(buscando) > -1) {
                $(nombres[i]).parents('.item').show();
            } else {
                $(nombres[i]).parents('.item').hide();
            }
        }
    }
}

prox_mant();
function prox_mant() {
    if($('#recurrente')[0].checked == true){
        $('.prox_mantenimiento').show();
    }
    else{
        $('.prox_mantenimiento').hide();
    }
}

$('#recurrente').on( "click", function() {
    if($('#recurrente')[0].checked == false){
        $('.prox_mantenimiento').hide();
        $("#prox_mantenimiento").prop('disabled', true);
    }
    else {
        $('.prox_mantenimiento').show();
        $("#prox_mantenimiento").prop('required', true);
        $("#prox_mantenimiento").prop('disabled', false);
    }
    
  });

function buscadorindex() {
    var nombres = $('.nombres');
    var buscando = $('#buscador').val();
    var item = '';
    for (var i = 0; i < nombres.length; i++) {
        item = $(nombres[i]).html().toLowerCase();
        for (var x = 0; x < item.length; x++) {
            if (buscando.length <= 0 || item.indexOf(buscando) > -1) {
                $(nombres[i]).parents('.item').fadeIn();
            } else {
                $(nombres[i]).parents('.item').fadeOut();
            }
        }
    }
}

$("input[data-type='currency']").on({
    keyup: function() {
        formatCurrency($(this));
    },
    blur: function() {
        formatCurrency($(this), "blur");
    }
});

function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") { return; }

    // original length
    var original_len = input_val.length;

    // initial caret position
    var caret_pos = input.prop("selectionStart");

    // check for decimal
    if (input_val.indexOf(".") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);

        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
            right_side += "00";
        }

        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = "$" + left_side + "." + right_side;

    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = "$" + input_val;

        // final formatting
        if (blur === "blur") {
            input_val += ".00";
        }
    }

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}
