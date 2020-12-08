@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Vista de Recibo</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div style="margin-left: 10px;">
                <div class="form-group">
                    <label>Arrendador:</label>
                    <p>{{$recibo->nombre_arrendador}} {{$recibo->paterno_arrendador}} {{$recibo->materno_arrendador}}</p>
                </div>
                <hr>
                <div class="form-group">
                    <label>Inmueble:</label>
                    <p>{{$recibo->finca_arrendada}}</p>
                </div>
                <hr>
                <div class="form-group">
                    <label>Arrendatario:</label>
                    <p>{{$recibo->nombre_arrendatario}} {{$recibo->paterno_arrendatario}} {{$recibo->materno_arrendatario}}</p>
                </div>
                <hr>
                <div class="form-group">
                    <div style="display: inline-grid; width: 49.5%;">
                        <label>Mes:</label>
                        <p>{{$recibo->mes}}</p>
                    </div>
                    <div style="display: inline-grid; width: 49.5%;">
                        <label>Total:</label>
                        <p>{{$recibo->total}}</p>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div style="display: inline-grid; width: 49.5%;">
                        <label>Estatus de Pago:</label>
                        @if($recibo->estatus_pago == 0)
                            <input id="estatus_pago" type="checkbox" name="estatus_pago" data-toggle="toggle" data-on="Pagado" data-off="Pendiente" data-onstyle="success" data-offstyle="danger">
                        @else
                            <input id="estatus_pago" type="checkbox" checked name="estatus_pago" data-toggle="toggle" data-on="Pagado" data-off="Pendiente" data-onstyle="success" data-offstyle="danger">
                        @endif
                    </div>
                    <div style="display: inline-grid; width: 49.5%;">
                        <label>Fecha de Pago:</label>
                        @if($recibo->fecha_pago != null)
                            <input id="fecha_pago" class="form-control" type="date" value="{{$recibo->fecha_pago}}" required>
                        @else
                            <input id="fecha_pago" class="form-control" type="date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>

                        @endif
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label>Observaciones:</label>
                    @if($recibo->observaciones == null)
                        <p>No hay observaciones</p>
                    @else
                        <p>{{$recibo->observaciones}}</p>
                    @endif
                </div>
                <hr>
                <div class="form-group">
                    <label>Usuario:</label>
                    <p>{{$recibo->nombre_usuario}}</p>
                </div>
                <hr>
                <div class="form-group">
                    <button onclick="actualizar('{{$recibo->id}}', '{{url('control-pago/recibo')}}', '{{csrf_token()}}', '{{url('control-pago')}}')" class="btn btn-primary" type="submit">Guardar</button>
                    <a href="{{url('control-pago')}}"><button class="btn btn-danger">Regresar</button></a>
                </div>
            </div>

        </div>
    </div>
@endsection
