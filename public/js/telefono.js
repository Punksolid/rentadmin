var campos_max = 10;   //max de 10 campos
var x = 1;

$('#add_field').click (function(e) {
    e.preventDefault();     //prevenir novos clicks
    if (x < campos_max) {
        $('#listas').append('\<div class="formulario-dos" style="display: inline-flex">\<input id="masc-tel'+x+'" onkeypress="return justNumbers(event)" type="text" name="phone_number['+x+'][telefono]" placeholder="Telefono...">&nbsp;<input id="desc" type="text" name="phone_number['+x+'][descripcion]" placeholder="Descripcion..."> <button style="margin-bottom: 4px" class="btn btn-sm btn-danger remover_campo">-</button>\</div><br>');
        $('input[name="phone_number['+x+'][telefono]"]').mask('(000) 000 0000');
        x++;
    }
});

// Remover o div anterior
$('#listas').on("click",".remover_campo",function(e) {
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
});

function justNumbers(e){
    var keynum = window.event ? window.event.keyCode : e.which;
    if (keynum < 48 || keynum > 57){
        return false;
    }
}
