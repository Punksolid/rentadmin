@extends ('layouts.admin')
@section ('contenido')

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Inmueble</h3>
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {!! Form::open(['url' => 'catalogos/finca', 'method' => 'POST', 'autocomplete' => 'off', 'files' => true]) !!}
            {{Form::token()}}
            <div class="form-group">
                <label for="finca_arrendada">Inmueble</label>
                <input type="text" name="name" value="{{ old('name') }}" class="verificar form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="Inmueble..." required>
            </div>
            <div class="form-group">
                <label for="lessor_id">Arrendador</label>
                <input type="text" class="form-control verificar tipo-propiedad" id="arrendadorname" placeholder="Arrendador..." disabled >
                <button id="lessor_modal" type="button" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-arrendador"><i class="fa fa-search"></i></button>
                <input type="hidden" id="id_arrendador" name="lessor_id" value="" >
            </div>

            <div class="form-group">
                <label for="id_tipo_propiedad">Tipo de Propiedad</label><br>
                    <select class="form-control verificar tipo-propiedad" name="property_type_id" required>
                        <option name="property_type_id" value="">Seleccione el Tipo de Propiedad</option>
                        @foreach($property_types as $property_type)
                            <option name="property_type_id" value="{{$property_type->id_tipo_propiedad}}" @if(old('property_type_id') == $property_type->id_tipo_propiedad) selected @endif>{{$property_type->tipo_propiedad}}</option>
                        @endforeach
                </select>
                <a data-target="#modal-propiedad" data-toggle="modal"><button id="agg" class="btn btn-success">+</button></a>
            </div>
            <div class="form-group">
                <label for="descripcion">Direccion</label>
                <input type="text" value="{{ old('address') }}" name="address" class="form-control verificar" onkeyup="this.value = this.value.toUpperCase();"  required placeholder="Direccion..." >
            </div>
            <div class="form-group">
                <label for="descripcion">Geolocalizacion</label>
                <input type="text" value="{{ old("geolocation") }}" name="geolocation" class="form-control verificar" onkeyup="this.value = this.value.toUpperCase();"  required placeholder="Geolocalizacion..." >
            </div>


            <div class="form-group">
                <label for="recibo">Recibo</label>
                <div style="display:block;">
                    <label>Fiscal</label>
                    <input style="margin-right: 20px" class="cb" onchange="cbChange(this)" type="radio" name="fiscal" @if(old('fiscal') == 'on') checked @endif>
                    <label>No Fiscal</label>
                    <input type="radio" class="cb" onchange="cbChange(this)" name="nofiscal" @if(old('nofiscal') == 'on') checked @endif>
                </div>
            </div>

            <div class="form-group">
                <label for="maintenance">Mantenimiento</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input id="currency-field" type="text" name="maintenance" value="{{ old('maintenance', '$0.00') }}" data-type="currency" required class="form-control verificar currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Mantenimiento..." >
                </div>
            </div>

            <div class="form-group">
                <label for="water_fee">Cuota de Agua</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input id="currency-field" type="text" name="water_fee" value="{{ old('water_fee', '$0.00') }}" data-type="currency" required class="form-control verificar currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Cuota de Agua..." >
                </div>
            </div>

            <div class="form-group">
                <label for="energy_fee">Servicio de Luz</label>
                <input type="text" name="energy_fee" value="{{ old('energy_fee') }}" class="form-control verificar" placeholder="XXX XXX XXX XXX" required>
            </div>
            <div class="form-group">
                <label for="water_account_number">Cuenta Japac</label>
                <input type="text" name="water_account_number" value="{{ old('water_account_number') }}" class="form-control verificar" placeholder="XXX XXX XXX" required>
            </div>

            <div class="form-group">
                <label for="predial">Numero de Predial</label>
                <input type="text" name="predial" class="form-control verificar" value="{{ old('predial') }}" placeholder="XXX XXX XXX XXX XXX XXX" required>
            </div>
            <div class="form-group">
                <label for="predial">Foto</label>
                <input type="file" name="photo" class="form-control verificar" >
            </div>

            <div class="form-group">
                <button id="verificar" class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="./">Cancelar</a>
            </div>

            {!! Form::close() !!}
            @include('catalogos.finca.modal')

        </div>
    </div>

    <script>

        jQuery(function ($) {
            $('.currency-field').mask("###,###,##0.00", {reverse: true});
            $('input[name="servicio_luz"]').mask('000 000 000 000');
            $('input[name="water_account_number"]').mask('000 000 000');
            $('input[name="predial"]').mask('000 000 000 000 000 000');
        });
    </script>

@endsection
