var campo_max = 10;   //max de 10 campos
var z = 1;

$('#field_add').click (function(e) {
    e.preventDefault();     //prevenir novos clicks
    if (z < campo_max) {
        $('#list').append('\<div>\<input id="cc" type="text" name="guarantor[phones]['+z+'][telefono]" placeholder="Telefono..." class="mascara">&nbsp;<input id="desc" type="text" name="guarantor[phones]['+z+'][descripcion]" placeholder="Descripcion..."> <button style="margin-bottom: 4px" class="btn btn-sm btn-danger remove">-</button>\</div>');
        $('input[name="guarantor[phones]['+z+'][telefono]"]').mask('(000) 000 0000');
        z++;
    }
});

// Remover o div anterior
$('#list').on("click",".remove",function(e) {
    e.preventDefault();
    $(this).parent('div').remove();
    z--;
});
