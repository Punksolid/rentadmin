function arrendadorContrato(id) {
    var nombre = document.getElementById("arrendador_contrato"+id).innerHTML;
    document.getElementById("arrendadornombre").value = nombre;
    document.getElementById("id_arrendador_contrato").value = id;
}

function arrendatarioContrato(id) {
    var nombre = document.getElementById("arrendatario_contrato"+id).innerHTML;
    document.getElementById("arrendatarionombre").value = nombre;
    document.getElementById("id_arrendatario_contrato").value = id;
}

function propiedadContrato(id, arrendador, id_arr) {
    var nombre = document.getElementById("propiedad_modal"+id).innerHTML;

    document.getElementById("propiedadnombre").value = nombre;
    document.getElementById("id_propiedad_contrato").value = id;
    document.getElementById('arrendadornombre').value = arrendador;
    document.getElementById('id_arrendador_contrato').value = id_arr;
}

function buscadorArrendatario() {
    var nombres = $('.nombresarrendatario');
    var buscando = $('#buscadorarrendatario').val();
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

function buscadorPropiedad() {
    var nombres = $('.nombrespropiedad');
    var buscando = $('#buscadorpropiedad').val();
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
/*
function filtrado(arrendador) {
    var id_arrendador = document.getElementById('id_arrendador_contrato').value;
    console.log('id arrendador '+ id_arrendador);
    console.log('arrendador propiedad '+ arrendador);
    if (id_arrendador != arrendador){
        document.getElementById('propiedad_modal'+id).hidden;
    }
}
*/

function BotonArrendador(id) {
    var nombre = document.getElementById("arrendador_contrato"+id).innerHTML;
    document.getElementById("arrendadornombre").value = nombre;
    document.getElementById("id_arrendador_contrato").value = id;
}













function peticionLiquidacion() {
    var trcomi = $('#comision');
    $('#tbodyid').empty();
    $('#tbodyid').append(trcomi);
    $('#tabladeposito tbody').empty();
    var urlfinca = document.getElementById('urlfinca').value;
    var comision = document.getElementById('comision');
    var datos = {
        id_arrendador: document.getElementById('id_arrendador_contrato').value,
        _token: document.getElementById('token').value,
    };
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0
    })

    if (datos.id_arrendador == ''){
        alert('Seleccione un arrendador');

    }else {
        if ($('#mes').val() == null){
            alert('Seleccione un mes');
        }else {
            $.ajax({
                url: urlfinca,
                data: datos,
                method: 'POST',
                dataType: 'json',
                success: function (result) {
                    var contratos = result['contrato'];
                    var fincas = result['finca'];
                    var fechas = result['fecha'];
                    var arrendatarios = result['arrendatario'];
                    var ivaconfig = result['ivacon'];
                    var recibos = result['recibos'];
                    var idfinca = 1;
                    fincas.forEach(function (res, index) {
                        var contrato = contratos.filter(cont => cont.id_finca == res.id_cat_fincas);

                        if (contrato == '') {
                            var htmlTags = '<tr class="tr-count">' +
                                '<td>'+ idfinca++ +'</td>' +
                                '<td>' + res.finca_arrendada + '</td>' +
                                '<td>' + '<strong>Desocupado</strong>' + '</td>' +
                                '<td></td>' +
                                '<td style="text-align: center">N/A</td>' +
                                '<td style="text-align: center">N/A</td>' +
                                '</tr>';
                        } else {
                            var mes = $("#mes").find(':selected').attr('mes').toString().substr(0, 3) + '/' + new Date().getFullYear().toString().substr(-2);
                            var arrendatario = arrendatarios.filter(arren => arren.id_cat_arrendatario == contrato[0].id_arrendatario);
                            var fecha = fechas.filter(cont => cont.id_contrato == contrato[0].id_contratos);
                            var mescom = $("#mes").find(':selected').attr('mes').toString();
                            var deposito = recibos.filter(depos => depos.id_contrato == contrato[0].id_contratos && depos.mes == mescom);
                            if (deposito == ''){}else{

                                var htmlDeposito = '<tr>' +
                                    '<td style="text-align: center">'+ mes +'</td>' +
                                    '<td style="text-align: center" class="depositosuma">'+ deposito[0].total +'</td>' +
                                    '</tr>';
                                $('#tabladeposito tbody').append(htmlDeposito);
                            }

                            fecha.forEach(function (resultado, index) {
                                var fecha_actual = new Date().getFullYear() + '-' + document.getElementById('mes').value;
                                var fecha_inicio = resultado.fecha_inicio.slice(0, -3);
                                var fecha_fin = resultado.fecha_fin.slice(0, -3);

                                if (fecha_inicio <= fecha_actual && fecha_fin >= fecha_actual) {

                                    var iva = (resultado.cantidad * ivaconfig)/100;
                                    if (res.recibo == 'Fiscal'){
                                        var htmlTags = '<tr class="tr-count reciboFiscal">' +
                                            '<td>'+ idfinca++ +'</td>' +
                                            '<td>' + res.finca_arrendada + '</td>' +
                                            '<td>' + arrendatario[0].nombre + ' ' + arrendatario[0].apellido_paterno + '</td>' +
                                            '<td style="text-align: center">' + mes + '</td>' +
                                            '<td style="text-align: center;" class="cantidades" >' + formatter.format(resultado.cantidad) + '.00' + '</td>' +
                                            '<td style="text-align: center;" class="ivasuma" >' + formatter.format(iva) + '.00' + '</td>' +
                                            '</tr>';
                                    }else{
                                        var htmlTags = '<tr class="tr-count">' +
                                            '<td>'+ idfinca++ +'</td>' +
                                            '<td>' + res.finca_arrendada + '</td>' +
                                            '<td>' + arrendatario[0].nombre + ' ' + arrendatario[0].apellido_paterno + '</td>' +
                                            '<td style="text-align: center">' + mes + '</td>' +
                                            '<td style="text-align: center;" class="cantidades" >' + formatter.format(resultado.cantidad) + '.00' + '</td>' +
                                            '<td style="text-align: center">N/A</td>' +
                                            '</tr>';
                                    }
                                    $('#tablaprueba tbody').append(htmlTags).after(comision);
                                }

                            })
                        }
                        $('#tablaprueba tbody').append(htmlTags);
                    })
                    var cantidades = document.getElementsByClassName('cantidades');
                    var ivasuma = document.getElementsByClassName('ivasuma');
                    var importe = 0;
                    var iva = 0;
                    $.each(cantidades,function (index, cantidad) {
                        var primero = cantidad.innerHTML.replace('$', '');
                        var segundo = primero.replace('.00', '');
                        var total = segundo.replace(',', '');
                        importe += parseInt(total);
                    })
                    $.each(ivasuma, function (index, ivasum) {
                        var ivauno = ivasum.innerHTML.replace('$', '');
                        var ivados = ivauno.replace('.00', '');
                        var tota = ivados.replace(',', '');
                        iva += parseInt(tota);
                    })
                    var htmlImporte = '<tr class="tr-count">' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td id="importevalor" style="border-top: black 2px solid; text-align: center">' + formatter.format(importe) + '.00' + '</td>' +
                        '<td style="border-top: black 2px solid; text-align: center;">' + formatter.format(iva) + '.00' + '</td>' +
                        '</tr>';
                    var htmlVacio = '<tr id="htmlvacio" class="tr-count">' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td style="text-align: center;">IVA</td>' +
                        '<td id="totalcomi" style="text-align: center; border-bottom: black 2px solid; border-right: black 2px solid">'+ formatter.format(iva)+ '.00' +'</td>' +
                        '<td></td>' +
                        '</tr>';
                    var tot = (importe + iva);

                    $('#tablaprueba tbody').append(htmlImporte);
                    $('#tablaprueba tbody').append(trcomi);
                    $('#tablaprueba tbody').append(htmlVacio);

                    var porcentaje = $('#porcen').val();
                    var comis = (importe * porcentaje) / 100;
                    var importefinal = tot+comis;
                    document.getElementById('comisionvalor').innerText = formatter.format(comis)+'.00';
                    var htmlTotal = '<tr id="htmltotal" class="tr-count">' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td id="importefinal" style="text-align: center">'+ formatter.format(importefinal)+ '.00' +'</td>' +
                        '<td></td>' +
                        '</tr>';

                    $('#tablaprueba tbody').append(htmlTotal);
                    comision.after(document.getElementById('htmlvacio'));
                    $('#htmlvacio').after($('#htmltotal'));

                    var trRecibo = $('.reciboFiscal');
                    var retiva = $('#retiva').val();
                    var retisr = $('#retisr').val();
                    var id_array = [];
                    var valorImporte = 0;
                    $.each(trRecibo, function (index, trNo) {
                        var idLinea = trNo.firstChild.innerHTML;
                        id_array.push(idLinea);
                        var anterior = trNo.childNodes[4].innerHTML;
                        var primero = anterior.replace('$', '');
                        var segundo = primero.replace('.00', '');
                        var valorFin = segundo.replace(',', '');
                        valorImporte += parseInt(valorFin);
                    });
                    var isrTotal = (valorImporte*retisr)/100;
                    var ivaTotal = (valorImporte*retiva)/100;
                    var totalretencion = isrTotal+ivaTotal;
                    var htmlIsr = '<tr class="tr-count">' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td style="text-align: center">' + 'RET. I.S.R. PROPIEDADES ' + id_array + '</td>' +
                        '<td id="isrTotal" style="text-align: center">'+ formatter.format(isrTotal)+ '.00' +'</td>' +
                        '<td></td>' +
                        '<td></td>' +
                        '</tr>';
                    var htmlIva = '<tr class="tr-count">' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td style="text-align: center">' + 'RET. I.V.A. PROPIEDADES ' + id_array + '</td>' +
                        '<td id="isrTotal" style="text-align: center; border-bottom: black 2px solid; border-right: black 2px solid">'+ formatter.format(ivaTotal)+ '.00' +'</td>' +
                        '<td id="importeRet" style="text-align: center; border-bottom: black 2px solid; border-right: black 2px solid">'+ formatter.format(totalretencion)+ '.00' +'</td>' +
                        '<td></td>' +
                        '</tr>';
                    $('#tablaprueba tbody').append(htmlIsr);
                    $('#tablaprueba tbody').append(htmlIva);

                    var importemenos = importefinal-totalretencion;
                    var htmlImporteFinal = '<tr class="tr-count">' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td></td>' +
                        '<td id="retTotal" style="text-align: center; border-bottom: black 3px double; border-right: black 2px solid">'+ formatter.format(importemenos)+ '.00' +'</td>' +
                        '<td></td>' +
                        '</tr>';
                    $('#tablaprueba tbody').append(htmlImporteFinal);

                    var depositosuma = $('.depositosuma');
                    var depositofinal = 0;
                    $.each(depositosuma, function (index, depos) {
                        var prime = depos.innerHTML.replace('$', '');
                        var segu = prime.replace('.00', '');
                        var depo = segu.replace(',', '');
                        depositofinal += parseInt(depo);
                    })

                    var htmlDepoFinal = '<tr>' +
                        '<td></td>' +
                        '<td style="text-align: center; border-bottom: black 1px solid; border-right: black 1px solid">'+ formatter.format(depositofinal)+ '.00' +'</td>' +
                        '</tr>';
                    $('#tabladeposito tbody').append(htmlDepoFinal);
                }
            });
        }
    }
}


$('#botongasto').click(function () {
    var htmlVacio = '<tr>' +
        '<td><input class="form-control"></td>' +
        '<td style="display: inline-flex"><input class="form-control gastosuma"><button onclick="this.parentNode.parentNode.remove()" style="margin-left: 10px" class="btn btn-sm btn-danger">Eliminar</button></td>' +
        '</tr>';
    $('#tablagastos tbody').append(htmlVacio).after($('#gastostr'));

});

$('#botontotal').click(function () {
    var sum = 0;
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0
    })
    $('.gastosuma').each(function(){
        if (this.value == ''){}
        else {
            sum += parseFloat(this.value);
        }
    });
    var formato = formatter.format(sum)+'.00';
    $('#totalgastos').html(formato);
})









