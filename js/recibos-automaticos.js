function arrendadorRecibo(id) {
    var nombre = document.getElementById("arrendador_recibo"+id).innerHTML;
    document.getElementById("arrendador_registro").value = nombre;
    document.getElementById("id_arrendador_registro").value = id;
}

function arrendadorParcial(id) {
    var nombre = document.getElementById("arrendador_parcial"+id).innerHTML;
    document.getElementById("arrendador_parcial").value = nombre;
    document.getElementById("id_arrendador_parcial").value = id;
}

function arrendatarioRecibo(id) {
    var nombre = document.getElementById("arrendatario_recibo"+id).innerHTML;
    document.getElementById("arrendatario_registro").value = nombre;
    document.getElementById("id_arrendatario_registro").value = id;
}

function propiedadRecibo(id, arrendador, id_arr) {
    var nombre = document.getElementById("propiedad_recibo"+id).innerHTML;
    document.getElementById("propiedad_registro").value = nombre;
    document.getElementById("id_propiedad_registro").value = id;
    document.getElementById('arrendador_registro').value = arrendador;
    document.getElementById('id_arrendador_registro').value = id_arr;
}

function propiedadParcial(id, arrendador, id_arr) {
    var nombre = document.getElementById("propiedad_parcial"+id).innerHTML;
    document.getElementById("propiedad_parcial").value = nombre;
    document.getElementById("id_propiedad_parcial").value = id;
    document.getElementById('arrendador_parcial').value = arrendador;
    document.getElementById('id_arrendador_parcial').value = id_arr;
}

function buscadorArrendadorRecibo() {
    var nombres = $('.nombresarrendadorrecibo');
    var buscando = $('#buscadorarrendadorrecibo').val();
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

function buscadorArrendadorParcial() {
    var nombres = $('.nombresarrendadorparcial');
    var buscando = $('#buscadorarrendadorparcial').val();
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

function buscadorArrendatarioRecibo() {
    var nombres = $('.nombresarrendatariorecibo');
    var buscando = $('#buscadorarrendatarioregistro').val();
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

function buscadorPropiedadRecibo() {
    var nombres = $('.nombrespropiedadrecibo');
    var buscando = $('#buscadorpropiedadrecibo').val();
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

function buscadorPropiedadParcial() {
    var nombres = $('.nombrespropiedadparcial');
    var buscando = $('#buscadorpropiedadparcial').val();
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

function revisarcheck() {
    var contador = document.getElementsByClassName('contarcheckbox');
    var con = 0;
    $.each(contador, function (index, check) {
        if (check.checked){
            con++;
        }
    });
    if (con<1){
        alert('Seleccione al menos un contrato a imprimir');
    }
}

$("#botones button").click(function(e){
    e.preventDefault();
    var toShow = $(this).attr('href');
    $(".collapse").fadeOut();
    $(toShow).fadeIn();
});

function filtradoRegistro() {
    var id_arrendador = document.getElementById('id_arrendador_registro').value;
    var fincas = document.getElementsByClassName('fincafiltroregistro');
    if (id_arrendador !== '') {
        $.each(fincas, function (i, cont) {
            var id_finca = document.getElementById(cont.getAttribute('id'));
            if (cont.getAttribute('href') === id_arrendador) {
                id_finca.style.display = "block";
            }else{
                id_finca.style.display = "none";
            }
        })
    }
}

function filtradoParcial() {
    var id_arrendador = document.getElementById('id_arrendador_parcial').value;
    var fincas = document.getElementsByClassName('fincaparcial');
    if (id_arrendador !== '') {
        $.each(fincas, function (i, cont) {
            var comp = cont.getAttribute('href');
            if (comp === id_arrendador) {
                cont.style.display = "block";
            }else{
                cont.style.display = "none";
            }
        })
    }
}

function limpiarparcialArre() {
    document.getElementById('arrendatario_parcial').value = null;
    document.getElementById('id_arrendatario_parcial').value = null;
}

function limpiarinm() {
    document.getElementById('id_propiedad_registro').value = null;
    document.getElementById('propiedad_registro').value = null;
    document.getElementById('arrendatario_registro').value = null;
    document.getElementById('id_arrendatario_registro').value = null;
}

function limpiarpar() {
    document.getElementById('id_propiedad_parcial').value = null;
    document.getElementById('propiedad_parcial').value = null;
    document.getElementById('arrendatario_parcial').value = null;
    document.getElementById('id_arrendatario_parcial').value = null;
}

function recibo() {
    var selec = $('#mes').val();
    var urlpdf = $('#urlpdf').val();

    if (selec === 'Seleccione mes para generar recibo'){
        alert('Seleccione un mes para generar el recibo');
    }else {
        var data = {};
        var urlbase = document.getElementById('urlbase').value + '/pdf/';
        data.id_arrendador = $('#id_arrendador_contrato').val();
        data.mes = $('#mes').val();
        var contador = document.getElementsByClassName('tr-count').length;
        data.contador = contador - 1;
        var i;
        for (i = 0; i < contador; i++) {
            if ($('#contrato' + i).prop('checked')) {
                data['id_contrato' + i] = $('#id_contrato' + i).val();
                data['contrato_observacion' + i] = $('#contrato_observacion' + i).val();
            }
        }
        $.ajax({
            url: urlpdf,
            dataType: "json",
            method: "GET",
            data: data,
            success: function (result) {
                let pdfWindow = window.open("");
                pdfWindow.document.write("<embed width='100%' height='100%' src='data:application/pdf;base64, " + encodeURI(result)+"'>");
            }
        });
    }
}

function vista(id_arrendador){
    $('#tablaprueba tbody').empty();
    var urlarrendador = $('#urlarrendador').val();
    $.ajax({
        url: urlarrendador + "/" + id_arrendador,
        dataType: "json",
        method: "GET",
        success: function(result){
            result.forEach(function (contrato, index) {
                var htmlTags = '<tr class="tr-count">'+
                    '<td style="text-align: center"><input class="contarcheckbox" id="contrato'+index+'" style="height: 32px" type="checkbox"></td>'+
                    '<td>'+ contrato.finca_arrendada +'</td>'+
                    '<td>'+ contrato.nombre +' '+ contrato.apellido_paterno +' '+ contrato.apellido_materno +'</td>'+
                    '<td ><input id="contrato_observacion'+index+'" type="text" class="form-control"><input id="id_contrato'+index+'" style="display: none" value="'+contrato.id_contratos+'"></td>'+
                    '</tr>';
                $('#tablaprueba tbody').append(htmlTags);
            });
        },
    });
}

function actualizar(id_recibo, urlrecibo, token, urlback) {
    var estatus_pago = document.getElementById('estatus_pago').checked;
    var fecha_pago = $('#fecha_pago').val();
    var data = {_token: token, estatus_pago: estatus_pago, fecha_pago: fecha_pago, activo: 1};

    if (estatus_pago === false){
        alert('No se ha pagado el recibo');
    }else {
        if (fecha_pago === '') {
            alert('Ingrese una fecha de pago');
        } else {
            $.ajax({
                url: urlrecibo + '/' + id_recibo + '/actualizar',
                dataType: 'json',
                method: 'PUT',
                data: data,
                success: function (result) {
                    alert(result);
                    window.location = urlback
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseJSON);
                }
            });
        }
    }
}

function completarArrendatarioParcial() {
    var arrendatarios = document.getElementsByClassName('nombresarrendatariorecibo');
    var arrendador =  document.getElementById('id_arrendador_parcial').value;
    var propiedad = document.getElementById('id_propiedad_parcial').value;
    var urlfiltro = document.getElementById('urlfiltro').value;
    var token = document.getElementById('token').value;
    var data = {_token: token, id_arrendador: arrendador, id_propiedad: propiedad};

    if (arrendador != null && propiedad != null){
        $.each(arrendatarios, function (index, result) {
            result.style.display = 'none';
        });
        $.ajax({
            url: urlfiltro,
            data: data,
            dataType: 'json',
            method: 'POST',
            success: function (result) {
                document.getElementById('arrendatario_parcial').value = result.nombre;
                document.getElementById('id_arrendatario_parcial').value = result.id;
                document.getElementById('importeparcial').value = result.importe;
                document.getElementById('bonifparcial').value = result.bonificacion;
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('No hay contrato para generar recibo');
            }
        });
    }
}

function calculoParcial(dias) {
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0
    });

    var str = document.getElementById('importeparcial').value;
    var qui1 = str.replace('$', '');
    var qui2 = qui1.replace(',', '');
    var importe = qui2.replace('.00', '');
    var bonif = document.getElementById('bonifparcial').value;
    var uno = bonif.replace('$', '');
    var dos = uno.replace(',','');
    var tres = dos.replace('.00', '');

    var qui4 = (importe/30)*dias;
    var total = Math.round(qui4);
    var cuatro = (tres/30)*dias;
    var bonificacion = Math.round(cuatro);

    document.getElementById('totalparcial').value = formatter.format(total)+'.00';
    document.getElementById('bonificacionparcial').value = formatter.format(bonificacion)+'.00';
}

function imprimirParcial() {
    var urlparcial = document.getElementById('urlparcial').value;
    var datos = {
        _token: document.getElementById('token').value,
        id_arrendador: document.getElementById('id_arrendador_parcial').value,
        id_finca: document.getElementById('id_propiedad_parcial').value,
        id_arrendatario: document.getElementById('id_arrendatario_parcial').value,
        dias: document.getElementById('numdiasparcial').value,
        mes: document.getElementById('mesparcial').value,
        total: document.getElementById('totalparcial').value,
        bonificacion: document.getElementById('bonificacionparcial').value
    };
    if (datos.dias > 31){
        alert('El numero de dias debe ser menor a 31');
    }else {
        if (datos.dias === '' || datos.mes === 'Seleccione mes para generar recibo') {
            alert('Complete todos los campos');
        } else {
            $.ajax({
                url: urlparcial,
                data: datos,
                dataType: 'json',
                method: 'post',
                success: function (result) {
                    let pdfWindow = window.open("");
                    pdfWindow.document.write("<embed width='100%' height='100%' src='data:application/pdf;base64, " + encodeURI(result) + "'>");
                }
            });
        }
    }
}

function completarArrendatario() {
    var arrendatarios = document.getElementsByClassName('nombresarrendatariorecibo');
    var arrendador =  document.getElementById('id_arrendador_registro').value;
    var propiedad = document.getElementById('id_propiedad_registro').value;
    var urlfiltro = document.getElementById('urlfiltro').value;
    var token = document.getElementById('token').value;
    var data = {_token: token, id_arrendador: arrendador, id_propiedad: propiedad};

    if (arrendador != null && propiedad != null){
        $.each(arrendatarios, function (index, result) {
            result.style.display = 'none';
        });
        $.ajax({
            url: urlfiltro,
            data: data,
            dataType: 'json',
            method: 'POST',
            success: function (result) {
                document.getElementById('arrendatario_registro').value = result.nombre;
                document.getElementById('id_arrendatario_registro').value = result.id;
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseJSON);
            }
        });
    }
}

function limpiarReporte() {
    document.getElementById('arrendador_registro').value = null;
    document.getElementById('id_arrendador_registro').value = null;
    document.getElementById('arrendatario_registro').value = null;
    document.getElementById('id_arrendatario_registro').value = null;
    document.getElementById('propiedad_registro').value = null;
    document.getElementById('id_propiedad_registro').value = null;
    document.getElementById('fecha1').value = null;
    document.getElementById('fecha2').value = null;
    document.getElementById('check-todos').checked = true;
    document.getElementById('check-pendiente').checked = false;
    document.getElementById('check-pagado').checked = false;
}

function limpiar() {
    document.getElementById('arrendador_registro').value = null;
    document.getElementById('id_arrendador_registro').value = null;
    document.getElementById('arrendatario_registro').value = null;
    document.getElementById('id_arrendatario_registro').value = null;
    document.getElementById('propiedad_registro').value = null;
    document.getElementById('id_propiedad_registro').value = null;
    document.getElementById('fecha1').value = null;
    document.getElementById('fecha2').value = null;
    document.getElementById('check-pendiente').checked = true;
    document.getElementById('check-todos').checked = false;
    document.getElementById('check-pagado').checked = false;
}

function cbChange(obj) {
    var cbs = document.getElementsByClassName("cb");

    for (var i = 0; i < cbs.length; i++) {
        cbs[i].checked = false;
    }
    obj.checked = true;
}

function pdfreporte() {
    var urlbase = document.getElementById('urlbase').value;
    var datos = {
        _token: document.getElementById('token').value,
        fechauno: document.getElementById('fecha1').value,
        fechados: document.getElementById('fecha2').value,
        propiedad: document.getElementById('id_propiedad_registro').value,
        arrendador: document.getElementById('id_arrendador_registro').value,
        arrendatario: document.getElementById('id_arrendatario_registro').value,
        pendiente: document.getElementById('check-pendiente').checked,
        pagado: document.getElementById('check-pagado').checked,
        todos: document.getElementById('check-todos').checked
    };

    $.ajax({
        url: urlbase + '/reportes/pdf',
        data: datos,
        dataType: 'json',
        method: 'POST',
        success: function (result) {
            let pdfWindow = window.open("");
            pdfWindow.document.write("<embed width='100%' height='100%' src='data:application/pdf;base64, " + encodeURI(result)+"'>");
        }
    });

}

function busquedaRecibos() {
    var urlreciboimp = $('#urlreciboimp').val();
    var urlrecibo = document.getElementById('urlrecibo').value;
    var urlregistro = document.getElementById('urlregistro').value;
    var datos = {
        _token: document.getElementById('token').value,
        fechauno: document.getElementById('fecha1').value,
        fechados: document.getElementById('fecha2').value,
        propiedad: document.getElementById('id_propiedad_registro').value,
        arrendador: document.getElementById('id_arrendador_registro').value,
        arrendatario: document.getElementById('id_arrendatario_registro').value,
        pendiente: document.getElementById('check-pendiente').checked,
        pagado: document.getElementById('check-pagado').checked,
        todos: document.getElementById('check-todos').checked
    };
    $('#tablados tbody').empty();
    $.ajax({
        url: urlregistro,
        data: datos,
        dataType: "json",
        method: "POST",
        success: function(result){
            $.each(result, function (index, recibo) {
                if (recibo.estatus_pago === 0){
                    recibo.estatus_pago = 'Pendiente';
                }else{
                    recibo.estatus_pago = 'Pagado';

                }
                if (recibo.fecha_pago === null){
                    recibo.fecha_pago = 'No Definido';
                }
                var htmlTags = '<tr class="mostrar-tr tr-count">'+
                    '<td>'+ recibo.finca_arrendada +'</td>'+
                    '<td class="text-center">'+ recibo.mes_recibo +'</td>'+
                    '<td id="estatus_pago'+index+'" class="text-center estatus-pago">'+ recibo.estatus_pago +'</td>'+
                    '<td class="text-center">'+ recibo.fecha_pago +'</td>'+
                    '<td class="text-center">'+ recibo.total +'</td>'+
                    '<td class="text-center">'+ recibo.nombre +'</td>'+
                    '<td class="id_arrenda" style="display: none">'+ recibo.id_arrendador +'</td>'+
                    '<td class="id_propie" style="display: none">'+ recibo.id_finca +'</td>'+
                    '<td class="id_arretario" style="display: none">'+ recibo.id_arrendatario +'</td>'+
                    '<td class="text-center">'+'<a href="'+ urlreciboimp+"/"+ recibo.id_registro_recibos +'"><button class="btn btn-danger btn-sm">PDF</button></a> '+'<a href="'+ urlrecibo+"/"+ recibo.id_registro_recibos +'"><button type="button" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></button></a>'+'</td>'+
                    '</tr>';
                $('#tablados tbody').append(htmlTags);
                var estado = document.getElementById('estatus_pago'+index).innerHTML;
                var id_estado = '#estatus_pago'+index;

                if (estado === 'Pendiente'){
                    $(id_estado).css({'color': '#ff0000', 'font-weight': 700});
                }else{
                    $(id_estado).css({'color': '#12a308', 'font-weight': 700});
                }
            });
            if (result.length === 0){
                alert('No se encontraron resultados');
            }
        },
    });
}

function busquedaReportes() {
    var urlregistro = document.getElementById('urlregistro').value;
    var datos = {
        _token: document.getElementById('token').value,
        fechauno: document.getElementById('fecha1').value,
        fechados: document.getElementById('fecha2').value,
        propiedad: document.getElementById('id_propiedad_registro').value,
        arrendador: document.getElementById('id_arrendador_registro').value,
        arrendatario: document.getElementById('id_arrendatario_registro').value,
        pendiente: document.getElementById('check-pendiente').checked,
        pagado: document.getElementById('check-pagado').checked,
        todos: document.getElementById('check-todos').checked
    };
    $('#tablados tbody').empty();
    $.ajax({
        url: urlregistro,
        data: datos,
        dataType: "json",
        method: "POST",
        success: function(result){
            $.each(result, function (index, recibo) {
                if (recibo.estatus_pago === 0){
                    recibo.estatus_pago = 'Pendiente';
                }else{
                    recibo.estatus_pago = 'Pagado';

                }
                if (recibo.fecha_pago === null){
                    recibo.fecha_pago = 'No Definido';
                }
                var htmlTags = '<tr class="mostrar-tr tr-count">'+
                    '<td>'+ recibo.finca_arrendada +'</td>'+
                    '<td class="text-center">'+ recibo.mes_recibo +'</td>'+
                    '<td id="estatus_pago'+index+'" class="text-center estatus-pago">'+ recibo.estatus_pago +'</td>'+
                    '<td class="text-center">'+ recibo.fecha_pago +'</td>'+
                    '<td class="text-center">'+ recibo.total +'</td>'+
                    '<td class="text-center">'+ recibo.nombre +'</td>'+
                    '<td class="id_arrenda" style="display: none">'+ recibo.id_arrendador +'</td>'+
                    '<td class="id_propie" style="display: none">'+ recibo.id_finca +'</td>'+
                    '<td class="id_arretario" style="display: none">'+ recibo.id_arrendatario +'</td>'+
                    '</tr>';
                $('#tablados tbody').append(htmlTags);
                var estado = document.getElementById('estatus_pago'+index).innerHTML;
                var id_estado = '#estatus_pago'+index;

                if (estado === 'Pendiente'){
                    $(id_estado).css({'color': '#ff0000', 'font-weight': 700});
                }else{
                    $(id_estado).css({'color': '#12a308', 'font-weight': 700});
                }
            });
            if (result.length === 0){
                alert('No se encontraron resultados');
            }
        },
    });
}

























