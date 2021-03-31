@extends ('layouts.layout-v2')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Reportes</h3>
            <div style="margin-top: 20px">
                <h5>Filtros</h5>
                <div class="form-group" style="width: 200%">
                    <input type="text" class="form-control recibo-input" id="arrendador_registro" placeholder="Arrendador..." disabled required>
                    <button type="button" onclick="limpiarinm()" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-arrendador-recibo"><i class="fa fa-search"></i></button>
                    <input type="hidden" id="id_arrendador_registro" name="" value="" required>
                    <label style="margin-left: 20px">Estatus de Pago:</label>
                    <label style="margin-left: 20px">Pagado</label>
                    <input onchange="cbChange(this)" class="cb" id="check-pagado" type="checkbox" style="display: inline-block" value="Pagado">
                    <label style="margin-left: 20px">Pendiente</label>
                    <input onchange="cbChange(this)" class="cb" id="check-pendiente" type="checkbox" style="display: inline-block" value="Pendiente">
                    <label style="margin-left: 20px">Todos</label>
                    <input onchange="cbChange(this)" class="cb" id="check-todos" type="checkbox" style="display: inline-block" value="Todos" checked>

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
                    <button style="display:inline-block; margin-left: 20px" class="btn btn-primary" onclick="limpiarReporte()">Limpiar</button>
                    <button style="display:inline-block; margin-left: 278px" class="btn btn-primary" onclick="busquedaReportes()">Buscar</button>
                    <button style="display:inline-block; margin-left: 5px" class="btn btn-danger" onclick="pdfreporte()">PDF</button>
                    <button style="display:none; margin-left: 5px" class="btn btn-success">XLS</button>
                </div>
            </div>
        </div>
        <table id="tablados" style="width: 100% !important; margin-top: 1rem; margin-left: 15px; margin-right: 15px" class="table table-sm table-striped table-bordered table-condensed table-hover">
            <thead class="thead-light">
            <th>Inmueble</th>
            <th class="text-center">Mes</th>
            <th class="text-center">Estatus</th>
            <th class="text-center">Fecha de Pago</th>
            <th class="text-center">Total</th>
            <th class="text-center">Usuario</th>
            </thead>

            <tbody>
            </tbody>

        </table>
    </div>

    <div style="display: none">
        <input id="urlbase" style="display: none" value="{{url('/')}}">
        <input id="urlrecibo" style="display: none" value="{{url('recibos-automaticos/recibo')}}">
        <input id="urlpdf" style="display: none" value="{{url("recibos-automaticos/pdf")}}">
        <input id="urlregistro" style="display: none" value="{{url("recibos-automaticos/registro")}}">
        <input id="urlarrendador" style="display: none" value="{{url("recibos-automaticos")}}">
        <input id="urlfiltro" style="display: none" value="{{url("recibos-automaticos/revision")}}">
        <input id="token" style="display: none" value="{{csrf_token()}}">
    </div>

    @include('recibos.modal')
@endsection
