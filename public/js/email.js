var campos_m = 10;   //max de 10 campos
var y = 1;

$('#add_f').click (function(e) {
    e.preventDefault();     //prevenir novos clicks
    if (y < campos_m) {
        $('#lista').append('\<div class="formulario-tres" style="display: inline-flex !important; align-items: baseline;">\<input id="cc" type="email" name="email'+(y+1)+'" class="form-control" placeholder="Correo Electronico..."> <button style="margin-bottom: 4px" class="btn btn-sm btn-danger remover_cota">-</button>\</div><br>');
        y++;
    }
});

// Remover o div anterior
$('#lista').on("click",".remover_cota",function(e) {
    e.preventDefault();
    $(this).parent('div').remove();
    y--;
});
