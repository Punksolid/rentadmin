var banco_max = 3;   //max de 5 campos
var j = 1;

$('#add_banco').click (function(e) {
    e.preventDefault();     //prevenir novos clicks
    if (j < banco_max) {
        $('#banc').append('\<div class="form-group" style="display: inline-flex; align-items: baseline">\<input id="seg" class="form-control" type="text" name="banco'+(j+1)+'" onkeyup="this.value = this.value.toUpperCase();" placeholder="Banco...">&nbsp;' +
            '\<br><input id="cc" class="form-control" type="text" name="cuenta'+(j+1)+'" placeholder="Cuenta...">&nbsp;' +
            '\<br><input id="cc" class="form-control" type="text" onkeypress="return justNumbers(event)" name="clabe'+(j+1)+'" placeholder="Clabe...">&nbsp;' +
            '\<br><input id="cc" class="form-control" type="text" onkeyup="this.value = this.value.toUpperCase();" name="nombre_titular'+(j+1)+'" placeholder="Nombre del Titular...">&nbsp;<button style="margin-bottom: 4px" class="btn btn-sm btn-danger remover_banco">-</button>\</div>');
        j++;
    }
});

// Remover o div anterior
$('#banc').on("click",".remover_banco",function(e) {
    e.preventDefault();
    $(this).parent('div').remove();
    j--;
});
