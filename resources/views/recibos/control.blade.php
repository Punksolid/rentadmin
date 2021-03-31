@extends ('layouts.layout-v2')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Control de Pagos</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
    @endif

        <!-- Registro de Recibos -->
            <div id="registrorecibos">
                <div class="form-group" style="width: 200%">
                    <input type="text" class="form-control recibo-input" id="arrendador_registro" placeholder="Arrendador..." disabled required>
                    <button type="button" onclick="limpiarinm()" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-arrendador-recibo"><i class="fa fa-search"></i></button>
                    <input type="hidden" id="id_arrendador_registro" name="" value="" required>
                    <label style="margin-left: 20px">Estatus de Pago:</label>
                    <label style="margin-left: 20px">Pagado</label>
                    <input onchange="cbChange(this)" class="cb" id="check-pagado" type="checkbox" style="display: inline-block" value="Pagado">
                    <label style="margin-left: 20px">Pendiente</label>
                    <input onchange="cbChange(this)" class="cb" id="check-pendiente" type="checkbox" style="display: inline-block" value="Pendiente" checked>
                    <label style="margin-left: 20px">Todos</label>
                    <input onchange="cbChange(this)" class="cb" id="check-todos" type="checkbox" style="display: inline-block" value="Todos">

                </div>
                <div style="width: 200%" class="form-group">
                    <input type="text" class="form-control recibo-input" id="propiedad_registro" placeholder="Inmueble..." disabled required>
                    <button type="button" class="btn buscar-btn btn-sm btn-primary" onclick="filtradoRegistro()" data-toggle="modal" data-target="#modal-propiedad-registro"><i class="fa fa-search"></i></button>
                    <input type="hidden" id="id_propiedad_registro" name="id_finca" value="" required>
                    <label style="margin-left: 10px">Fecha Inicio:</label>
                    <input class="form-control" style="width: 168px; display:inline-block;" type="date" id="fecha1">
                    <label style="margin-left: 5px">Fecha Fin:</label>
                    <input class="form-control" style="width: 168px; display:inline-block;" type="date" id="fecha2">
                </div>
                <div style="width: 200%" class="form-group">
                    <input type="text" class="form-control recibo-input" id="arrendatario_registro" placeholder="Arrendatario..." disabled required>
                    <button type="button" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-arrendatario-registro"><i class="fa fa-search"></i></button>
                    <input type="hidden" id="id_arrendatario_registro" name="id_arrendatario" value="" required>
                    <button style="display:inline-block; margin-left: 20px" class="btn btn-primary" onclick="limpiar()">Limpiar</button>
                    <button style="display:inline-block; margin-left: 10px" class="btn btn-primary" onclick="busquedaRecibos()">Buscar</button>

                </div>

                <table id="tablados" style="width: 204% !important; margin-top: 2rem" class="table table-sm table-striped table-bordered table-condensed table-hover">
                    <thead class="thead-light">
                    <th>Inmueble</th>
                    <th class="text-center">Mes</th>
                    <th class="text-center">Estatus</th>
                    <th class="text-center">Fecha de Pago</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Ver</th>
                    </thead>

                    <tbody>
                    </tbody>

                </table>
            </div>
            <!-- Termina Registro de Recibos -->

    @include('recibos.modal')

            <div style="display: none">
                <input id="urlbase" style="display: none" value="{{url('/')}}">
                <input id="urlrecibo" style="display: none" value="{{url('control-pago/recibo')}}">
                <input id="urlreciboimp" style="display: none" value="{{url('control-pago/recibo/imp')}}">
                <input id="urlpdf" style="display: none" value="{{url("recibos-automaticos/pdf")}}">
                <input id="urlregistro" style="display: none" value="{{url("recibos-automaticos/registro")}}">
                <input id="urlarrendador" style="display: none" value="{{url("recibos-automaticos")}}">
                <input id="urlfiltro" style="display: none" value="{{url("recibos-automaticos/revision")}}">
                <input id="token" style="display: none" value="{{csrf_token()}}">
            </div>
        </div>
    </div>
            <script>
                $(document).ready(function(){ registroRecibo(); })

                function registroRecibo() {
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
                    var urlreciboimp = $('#urlreciboimp').val();
                    var urlrecibo = $('#urlrecibo').val();
                    var urlregistro = $('#urlregistro').val();
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
                                    '<td class="text-center">'+'<a href="'+ urlreciboimp+"/"+ recibo.id_registro_recibos +'" target="_blank"><button class="btn btn-danger btn-sm">PDF</button></a> '+'<a href="'+ urlrecibo+"/"+ recibo.id_registro_recibos +'"><button type="button" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></button></a>'+'</td>'+
                                    '</tr>';
                                $('#tablados tbody').append(htmlTags);
                                var estado = document.getElementById('estatus_pago'+index).innerHTML;
                                var id_estado = '#estatus_pago'+index;

                                if (estado === 'Pendiente'){
                                    $(id_estado).css({'color': '#ff0000', 'font-weight': 700});
                                }else{
                                    $(id_estado).css({'color': '#12a308', 'font-weight': 700});
                                    var oc = document.getElementById('estatus_pago'+index);
                                    oc.parentNode.style.display = 'none';
                                }
                            });
                        },
                    });
                }
            </script>

@endsection
