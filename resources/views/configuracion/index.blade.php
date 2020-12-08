@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h5>Configuración de Mantenimiento</h5>
        <div>
            {!! Form::model($correo, ['method' => 'PATCH', 'route' =>['configuracion.update', $correo->id_configuracion]]) !!}
            {{Form::token()}}
            <label>Dias de anticipación para el envio de correo</label>
            <input type="number" name="cantidad" min="1" max="30" value="{{$correo->cantidad}}" class="form-control formulario-cuatro">
            <button class="btn btn-primary" type="submit">Actualizar</button>
            {!! Form::close() !!}
        </div>
        <hr>

        <h5>Configuración de Liquidaciones</h5>
        <div>
            {!! Form::model($retiva, ['method' => 'PATCH', 'route' =>['configuracion.update', $retiva->id_configuracion]]) !!}
            {{Form::token()}}
            <label>Retencion IVA %</label>
            <input type="number" step="any" name="cantidad" value="{{$retiva->cantidad}}" class="form-control formulario-cuatro">
            <button class="btn btn-primary" type="submit">Actualizar</button>
            {!! Form::close() !!}
        </div>
        <div>
            {!! Form::model($retisr, ['method' => 'PATCH', 'route' =>['configuracion.update', $retisr->id_configuracion]]) !!}
            {{Form::token()}}
            <label>Retencion ISR %</label>
            <input type="number" step="any" name="cantidad" value="{{$retisr->cantidad}}" class="form-control formulario-cuatro">
            <button class="btn btn-primary" type="submit">Actualizar</button>
            {!! Form::close() !!}
        </div>
        <div>
            {!! Form::model($comision, ['method' => 'PATCH', 'route' =>['configuracion.update', $comision->id_configuracion]]) !!}
            {{Form::token()}}
            <label>Comision %</label>
            <input style="margin-left: 37px" step="any" type="number" name="cantidad" value="{{$comision->cantidad}}" class="form-control formulario-cuatro">
            <button class="btn btn-primary" type="submit">Actualizar</button>
            {!! Form::close() !!}
        </div>
        <div>
            {!! Form::model($iva, ['method' => 'PATCH', 'route' =>['configuracion.update', $iva->id_configuracion]]) !!}
            {{Form::token()}}
            <label for="formControlRange">IVA %</label>
            <input style="margin-left: 78px" step="any" type="number" name="cantidad" value="{{$iva->cantidad}}" class="form-control formulario-cuatro">
            <button class="btn btn-primary" type="submit">Actualizar</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
