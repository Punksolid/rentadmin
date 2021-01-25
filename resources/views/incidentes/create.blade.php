@extends ('layouts.admin')
@section ('contenido')

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Incidente</h3>
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {!! Form::open(array('url' => 'incidentes', 'method' => 'POST', 'autocomplete' => 'off')) !!}
            {{Form::token()}}
            <div class="form-group">
                <label>Arrendador</label>
                <input type="text" class="form-control tipo-propiedad" id="arrendadorname" placeholder="Arrendador..." disabled required>
                <button type="button" onclick="limpiarInci()" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-arrendador"><i class="fa fa-search"></i></button>
                <input type="hidden" id="id_arrendador" name="id_arrendador" value="" required>
            </div>
            <div class="form-group">
                <label>Inmueble</label>
                <input type="text" class="form-control tipo-propiedad" id="propiedadnombre" placeholder="Inmueble..." disabled required>
                <button type="button" class="btn buscar-btn btn-sm btn-primary" onclick="filtrado()" data-toggle="modal" data-target="#modal-propiedad"><i class="fa fa-search"></i></button>
                <input type="hidden" id="id_propiedad_contrato" name="id_finca" value="" required>
            </div>
            <div class="form-group">
                <label for="reporto">Quien Reportó</label>
                <input type="text" name="reporto" class="form-control" placeholder="Quien Reportó..." required>
            </div>
            <div class="form-group">
                <label for="fecha_reporte">Fecha de Reporte</label>
                <input type="date" name="fecha_reporte" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="area">Tipo de Incidente</label><br>
                <select class="form-control tipo-propiedad" id="id_tipo_mantenimiento" name="area">
                    <option value="" selected>Seleccione el Tipo de Incidente</option>
                    @foreach($incidente as $p)
                        @if($p->estatus == 0)
                        @else
                            <option name="area" value="{{$p->tipo_incidente}}">{{$p->tipo_incidente}}</option>
                        @endif
                    @endforeach
                </select>
                <a data-target="#modal-tipo" data-toggle="modal"><button id="agg" class="btn btn-success">+</button></a>
            </div>
            <div class="form-group">
                <label for="incidente">Incidente</label>
                <input type="text" name="incidente" class="form-control" placeholder="Incidente..." required>
            </div>
            <div class="form-group">
                <label for="asignado">Asignado</label>
                <input type="text" name="asignado" class="form-control" placeholder="Asignado..." required>
            </div>
            <div class="form-group">
                <label for="area">Telefono de Asignado</label>
                <input type="tel" name="tel_asignado" data-mask="(000) 000 0000" class="form-control" placeholder="Telefono..." required>
            </div>
            <div class="form-group">
                <label for="area">Fecha de Asignacion</label>
                <input type="date" name="fecha_asignacion" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="area">Hora</label>
                <input type="time" name="hora" class="form-control" required>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" onclick="return checarmantid()" type="submit">Guardar</button>
                <a class="btn btn-danger" href="./">Cancelar</a>
            </div>

            {!! Form::close() !!}
            @include('incidentes.modal')

        </div>
    </div>

    <script>
        function limpiarInci() {
            document.getElementById('id_propiedad_contrato').value = null;
            document.getElementById('propiedadnombre').value = null;
        }

        function filtrado() {
            var id_arrendador = document.getElementById('id_arrendador').value;
            var fincas = document.getElementsByClassName('fincafiltro');
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
        function checarmantid() {
            var id_finca = document.getElementById('propiedadnombre').value;
            var id_tipo = document.getElementById('id_tipo_mantenimiento').value;
            var id_radio_arr = document.getElementById('arrendador_radio').checked;
            var id_radio_tario = document.getElementById('arrendatario_radio').checked;

            if (id_finca == '' || id_finca == null) {
                alert('Seleccione la finca');
                return false;
            }
            if (id_tipo == '' || id_tipo == null) {
                alert('Seleccione el tipo de incidente');
                return false;
            }
            if (!id_radio_arr && !id_radio_tario){
                alert('Seleccione a quien se le cargara el pago')
                return false;
            }
            return true
        }
    </script>

@endsection
