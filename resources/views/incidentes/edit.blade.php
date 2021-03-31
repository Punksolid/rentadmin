@extends ('layouts.layout-v2')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Incidente</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::model($incidente, ['method' => 'PATCH', 'route' =>['incidentes.update', $incidente->id_cat_incidentes]]) !!}
            {{Form::token()}}


            <div style="margin-left: 10px;">
                <div class="form-group">
                    <label>Inmueble:</label>
                    @php($finca = \App\Models\Property::findOrFail($incidente->id_finca))
                    <p>{{$finca->finca_arrendada}}</p>
                </div>
                <hr>
                <div class="form-group">
                    <div style="display: inline-grid; width: 49.5%;">
                        <label>Quien Reportó:</label>
                        <p>{{$incidente->reporto}}</p>
                    </div>
                    <div style="display: inline-grid; width: 49.5%;">
                        <label>Fecha de Reporte:</label>
                        <p>{{$incidente->fecha_reporte}}</p>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label>Area:</label>
                    <p>{{$incidente->area}}</p>
                </div>
                <hr>
                <div class="form-group">
                    <label for="tipo_propiedad">Estatus de proceso</label>
                    <select class="form-control tipo-propiedad" name="estatus_proceso">
                        @if($incidente->estatus_proceso)
                            <option name="estatus_proceso" value="En Proceso">En Proceso</option>
                            <option name="estatus_proceso" value="Terminado" selected>Terminado</option>
                        @else
                            <option name="estatus_proceso" value="En Proceso" selected>En Proceso</option>
                            <option name="estatus_proceso" value="Terminado">Terminado</option>
                        @endif
                    </select>
                </div>
                <hr>

                    <div style="display: inline-grid; width: 49.5%;">
                        <label>Incidente:</label>
                        <p>{{$incidente->incidente}}</p>
                    </div>
                </div>
                <hr>
            <div class="form-group">
                <label>Pago a cargo de:</label>
                <br>
                <label>Arrendador</label>
                @if($incidente->pago == 'arrendador')
                    <input checked style="margin-right: 40px" type="radio" id="arrendador_radio" onclick="if (this.checked){document.getElementById('arrendatario_radio').checked = false}" name="pago" value="arrendador">
                @else
                    <input style="margin-right: 40px" type="radio" id="arrendador_radio" onclick="if (this.checked){document.getElementById('arrendatario_radio').checked = false}" name="pago" value="arrendador">
                @endif
                <label>Arrendatario</label>
                @if($incidente->pago == 'arrendatario')
                    <input checked type="radio" id="arrendatario_radio" onclick="if (this.checked){document.getElementById('arrendador_radio').checked = false}" name="pago" value="arrendatario">
                @else
                    <input type="radio" id="arrendatario_radio" onclick="if (this.checked){document.getElementById('arrendador_radio').checked = false}" name="pago" value="arrendatario">
                @endif
            </div>
                <hr>
                <div class="form-group">
                    <div style="display: inline-grid; width: 49.5%;">
                        <label>Asignado:</label>
                        <p>{{$incidente->asignado}}</p>
                    </div>
                    <div style="display: inline-grid; width: 49.5%;">
                        <label>Telefono de Asignado:</label>
                        <p>{{$incidente->tel_asignado}}</p>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div style="display: inline-grid; width: 49.5%;">
                        <label>Fecha de Asignacion:</label>
                        <p>{{$incidente->fecha_asignacion}}</p>
                    </div>
                    <div style="display: inline-grid; width: 49.5%;">
                        <label>Hora:</label>
                        <p>{{$incidente->hora}}</p>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label>Solucion:</label>
                    <input class="form-control" type="text" name="solucion" value="{{$incidente->solucion}}" placeholder="Solucion..." required>
                </div>
                <hr>
                <div class="form-group">
                    <label>Observaciones:</label>
                    <input class="form-control" type="text" name="observaciones" value="{{$incidente->observaciones}}" placeholder="Observaciones...">
                </div>
                <hr>
                <div class="form-group">
                    <label for="tipo_propiedad">Costo</label>
                    <input type="text" onclick="this.value = null" id="moneda" name="costo" class="form-control" value="{{ $incidente->costo }}" placeholder="Costo..." required>
                </div>
                <hr>
                <div class="form-group">
                    <label>Fecha de Termino:</label>
                    <input class="form-control" type="date" name="fecha_termino" value="{{$incidente->fecha_termino}}" required>
                </div>
                <hr>
                <div class="form-group">
                    <button class="btn btn-primary" onclick="return checarmantid()" type="submit">Guardar</button>
                    <a class="btn btn-danger" href="../">Cancelar</a>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
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
