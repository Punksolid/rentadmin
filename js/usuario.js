function tipoUsuario() {
    var id = $("#tipo_usuario").val();
    var nombre = document.getElementById("tipo_usuario").innerHTML;
    document.getElementById("tipousuario").value = nombre;
    document.getElementById("id_tipo_usuario").value = id;
}

function buscadorTipoUsuario() {
    var nombres = $('.nombrestipousuario');
    var buscando = $('#buscadortipousuario').val();
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
