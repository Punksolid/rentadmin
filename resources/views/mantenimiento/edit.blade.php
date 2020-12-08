@extends ('layouts.admin')
@section ('contenido')
<div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Mantenimiento</h3>
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            {!! Form::model($mant, ['method' => 'PATCH', 'route' =>['mantenimiento.update', $mant->id_mantenimiento]]) !!}
            {{Form::token()}}
            @php($finca = \App\Models\CatFinca::findOrFail($mant->id_finca))
            @php($user = \App\Models\User::findOrFail($mant->id_usuario))
            @php($tipo = \App\Models\TipoMantenimiento::findOrFail($mant->id_tipo_mantenimiento))
            <div class="form-group">
                <label>Finca</label>
                <p>{{ $finca->finca_arrendada }}</p>
            </div>
            <hr>
            <div class="form-group">
                <label>Tipo de Mantenimiento</label>
                <p>{{$tipo->tipo_mantenimiento}}</p>
            </div>
            <hr>
            <div class="form-group">
                <label for="tipo_propiedad">Descripción</label>
                <p>{{ $mant->descripcion_mantenimiento }}</p>
            </div>
            <hr>
            <div class="form-group">
                <label>Pago a cargo de:</label>
                <br>
                <label>Arrendador</label>
                @if($mant->pago == 'arrendador')
                    <input checked style="margin-right: 40px" type="radio" id="arrendador_radio" onclick="if (this.checked){document.getElementById('arrendatario_radio').checked = false}" name="pago" value="arrendador">
                @else
                    <input style="margin-right: 40px" type="radio" id="arrendador_radio" onclick="if (this.checked){document.getElementById('arrendatario_radio').checked = false}" name="pago" value="arrendador">
                @endif
                <label>Arrendatario</label>
                @if($mant->pago == 'arrendatario')
                    <input checked type="radio" id="arrendatario_radio" onclick="if (this.checked){document.getElementById('arrendador_radio').checked = false}" name="pago" value="arrendatario">
                @else
                    <input type="radio" id="arrendatario_radio" onclick="if (this.checked){document.getElementById('arrendador_radio').checked = false}" name="pago" value="arrendatario">
                @endif
            </div>
            <hr>
            <div class="form-group">
                <label for="tipo_propiedad">Ubicación</label>
                <p>{{ $mant->ubicacion }}</p>
            </div>
            <hr>
            <div class="form-group">
                <label for="tipo_propiedad">Encargado</label>
                <p>{{ $mant->encargado }}</p>
            </div>
            <hr>
            <div class="form-group">
                <label for="tipo_propiedad">Telefono de Encargado</label>
                <p>{{ $mant->tel_encargado }}</p>
            </div>
            <hr>
            <div class="form-group">
                <label for="tipo_propiedad">Fecha de Registro</label>
                <p>{{ $mant->fecha_registro }}</p>
            </div>
            <hr>
            <div class="form-group">
                <label for="tipo_propiedad">Recurrente</label>
                @if($mant->recurrente)
                    <input class="form-check-input" style='margin-left:5px' type="checkbox" name="recurrente" id="recurrente" checked>
                @else
                    <input class="form-check-input" style='margin-left:5px' type="checkbox" id="recurrente" name="recurrente">
                @endif
            </div>
            <div class="form-group">
                <label class="prox_mantenimiento" for="tipo_propiedad">Proximo Mantenimiento</label>
                @if($mant->recurrente)
                    <input type="date" id="prox_mantenimiento" name="prox_mantenimiento" class="form-control prox_mantenimiento" value="{{ $mant->prox_mantenimiento }}" placeholder="Fecha del Proximo Mantenimiento" required>
                @else
                    <input type="date" id="prox_mantenimiento" name="prox_mantenimiento" class="form-control prox_mantenimiento" placeholder="Fecha del Proximo Mantenimiento">
                @endif
            </div>
            <hr>
            <div class="form-group">
                <label for="tipo_propiedad">Estatus de proceso</label>
                <select class="form-control tipo-propiedad" name="estatus_proceso">
                    @if($mant->estatus_proceso)
                        <option name="estatus_proceso" value="En Proceso">En Proceso</option>
                        <option name="estatus_proceso" value="Terminado" selected>Terminado</option>
                    @else
                        <option name="estatus_proceso" value="En Proceso" selected>En Proceso</option>
                        <option name="estatus_proceso" value="Terminado">Terminado</option>
                    @endif
                </select>
            </div>
            <hr>
            <div class="form-group">
                <label for="tipo_propiedad">Observaciones</label>
                <input type="text" name="observaciones" class="form-control" value="{{ $mant->observaciones }}" placeholder="Observaciones">
            </div>
            <hr>
            <div class="form-group">
                <label for="tipo_propiedad">Costo</label>
                <input type="text" onclick="this.value = null" id="moneda" name="costo" class="form-control" value="{{ $mant->costo }}" placeholder="Costo..." required>
            </div>
            <hr>
            <div class="form-group">
                <label>Usuario</label>
                @php($user = \App\Models\User::findOrFail($mant->id_usuario))
                <p style="margin-left: 5px">{{$user->nombre}}</p>
            </div>
            <hr>
            <div class="form-group">
                <button class="btn btn-primary" onclick="return checarmantid()" type="submit">Guardar</button>
                <a class="btn btn-danger" href="{{url('mantenimiento')}}">Cancelar</a>
            </div>

{!! Form::close() !!}
@include('mantenimiento.modal')
</div>
    <script>
        document.getElementById("moneda").onblur =function (){
            this.value = '$'+parseFloat(this.value.replace(/,/g, ""))
                .toFixed(2)
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        }
        function checarmantid() {
            var id_radio_arr = document.getElementById('arrendador_radio').checked;
            var id_radio_tario = document.getElementById('arrendatario_radio').checked;

            if (!id_radio_arr && !id_radio_tario){
                alert('Seleccione a quien se le cargara el pago')
                return false;
            }
            return true
        }
    </script>
@endsection
