@extends ('layouts.layout-v2')
@section ('contenido')
<div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Mantenimiento</h3>
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
{!! Form::open(array('url' => 'mantenimiento', 'method' => 'POST', 'autocomplete' => 'off')) !!}
            {{Form::token()}}
            <div class="form-group">
                <label>Finca</label>
                <input type="text" class="form-control tipo-propiedad" id="fincaname" placeholder="Finca..." disabled required>
                <button type="button" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-finca"><i class="fa fa-search"></i></button>
                <input type="hidden" id="id_finca" name="id_finca" value="" required>
            </div>
            <div class="form-group">
            <label for="id_tipo_mantenimiento">Tipo de Mantenimiento</label><br>
                    <select class="form-control tipo-propiedad" id="id_tipo_mantenimiento" name="id_tipo_mantenimiento">
                        <option name="id_tipo_mantenimiento" value="" selected>Seleccione el Tipo de Mantenimiento</option>
                        @foreach($tipo as $t)
                            @if($t->estatus == 0)
                                @else
                                    <option name="id_tipo_mantenimiento" value="{{$t->id_tipo_mantenimiento}}">{{$t->tipo_mantenimiento}}</option>
                            @endif
                        @endforeach
                </select>
                <a data-target="#modal-tipo" data-toggle="modal"><button id="agg" class="btn btn-success">+</button></a>
            </div>

            <div class="form-group">
                <label for="tipo_propiedad">Descripción</label>
                <input type="text" name="descripcion_mantenimiento" class="form-control" placeholder="Descripcion" required>
            </div>

            <div class="form-group">
                <label for="tipo_propiedad">Ubicación</label>
                <input type="text" name="ubicacion" class="form-control" placeholder="Ubicación" required>
            </div>
            <div class="form-group">
                <label for="tipo_propiedad">Encargado</label>
                <input type="text" name="encargado" class="form-control" placeholder="Encargado" required>
            </div>
            <div class="form-group">
                <label for="tipo_propiedad">Telefono de Encargado</label>
                <input type="text" data-mask="(000) 000 0000" name="tel_encargado" class="form-control" placeholder="Telefono de Encargado" required>
            </div>
            <div class="form-group">
                <label for="tipo_propiedad">Fecha de Registro</label>
                <input type="date" name="fecha_registro" class="form-control" placeholder="Fecha de Registro" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" onclick="return checarmantid()" type="submit">Guardar</button>
                <a class="btn btn-danger" href="{{url('mantenimiento')}}">Cancelar</a>
            </div>

        {!! Form::close() !!}
        @include('mantenimiento.modal')
</div>
    <script>
        function checarmantid() {
            var id_finca = document.getElementById('fincaname').value;
            var id_tipo = document.getElementById('id_tipo_mantenimiento').value;

            if (id_finca == '' || id_finca == null){
                alert('Seleccione la finca');
                return false;
            }
            if (id_tipo == '' || id_tipo == null){
                alert('Seleccione el tipo de mantenimiento');
                return false;
            }
            return true;
        }
    </script>
@endsection
