@extends ('layouts.layout-v2')
@section('page_title','Nuevo Inmueble')
@section ('contenido')
    <div class="box-header with-border"><h3 class="box-title">Inmueble</h3></div>
    @if(count($errors) > 0)
        <div class="row">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="box-body">
        <form action="{{ route('finca.store') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="finca_arrendada">Nombre</label>
                <input class="verificar form-control" name="name" style="text-transform:uppercase"
                       placeholder="Inmueble..."
                       required type="text" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="lessor_id">Arrendador</label>
                <div class="input-group">
                    <input type="text"
                           class="form-control verificar tipo-propiedad"
                           id="arrendadorname"
                           placeholder="Arrendador..." disabled>
                    <input type="hidden" id="id_arrendador" name="lessor_id" value="">
                    <div class="input-group-btn">
                        <button id="lessor_modal"
                                type="button"
                                class="btn btn-info btn-flat"
                                data-toggle="modal"
                                data-target="#modal-arrendador">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="id_tipo_propiedad">Tipo de Propiedad</label><br>
                <div class="input-group">
                    <select class="form-control verificar tipo-propiedad"
                            name="property_type_id"
                            required>
                        <option name="property_type_id" value="">Seleccione el Tipo de Propiedad</option>
                        @foreach($property_types as $property_type)
                            <option name="property_type_id" value="{{$property_type->id_tipo_propiedad}}"
                                    @if(old('property_type_id') == $property_type->id_tipo_propiedad) selected @endif>{{$property_type->tipo_propiedad}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-btn">
                        <a data-target="#modal-propiedad" data-toggle="modal">
                            <button id="agg" class="btn btn-success"><i class="fa fa-plus-circle"></i></button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="box-header with-border"><h3 class="box-title">Ubicación</h3></div>

            <div class="form-group">
                <label for="descripcion">Direccion</label>
                <input type="text" value="{{ old('address') }}" name="address" class="form-control verificar"
                       style="text-transform:uppercase" required placeholder="Direccion...">
            </div>
            <div class="form-group">
                <label for="descripcion">Geolocalizacion</label>
                <input type="text" value="{{ old("geolocation") }}" name="geolocation"
                       class="form-control verificar"
                       style="text-transform:uppercase" required
                       placeholder="Geolocalizacion...">
            </div>

            <label for="recibo">Recibo</label>

            <div class="form-group">
                <label for="fiscal">Fiscal</label>
                <input
                    id="fiscal"
                    class="cb"
                    type="radio" name="fiscal" value="{{ \App\Models\Property::RECIBO_STRING_FISCAL_VALUE }}"
                    @if(old('fiscal') === \App\Models\Property::RECIBO_STRING_FISCAL_VALUE) checked @endif
                >

                <label for="no_fiscal">No Fiscal</label>
                <input
                    id="no_fiscal"
                    class="cb"
                    type="radio" name="fiscal" value="{{ \App\Models\Property::RECIBO_STRING_NO_FISCAL_VALUE }}"
                    @if(old('fiscal') === \App\Models\Property::RECIBO_STRING_NO_FISCAL_VALUE) checked @endif>
            </div>

            <div class="form-group">
                <label for="maintenance">Mantenimiento</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <div class="input-group-text">$</div>
                    </div>
                    <input id="currency-field" type="text" name="maintenance"
                           value="{{ old('maintenance', '$0.00') }}"
                           data-type="currency" required class="form-control verificar currency-field"
                           pattern="^\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Mantenimiento...">
                </div>
            </div>

            <label for="water_fee">Cuota de Agua</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <div class="input-group-text">$</div>
                </div>
                <input id="currency-field" type="text" name="water_fee"
                       value="{{ old('water_fee', '$0.00') }}"
                       data-type="currency" required class="form-control verificar currency-field"
                       pattern="^\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Cuota de Agua...">
            </div>
            <div class="box-header with-border"><h3 class="box-title">Numeros de Cuenta/Cliente</h3></div>
            <label for="energy_fee">Servicio de Luz</label>
            <input type="text" name="energy_fee" value="{{ old('energy_fee') }}"
                   class="form-control verificar"
                   placeholder="XXX XXX XXX XXX" required>
            <label for="water_account_number">Cuenta Japac</label>
            <input type="text" name="water_account_number" value="{{ old('water_account_number') }}"
                   class="form-control verificar" placeholder="XXX XXX XXX" required>

            <label for="predial">Numero de Predial</label>
            <input type="text" name="predial" class="form-control verificar" value="{{ old('predial') }}"
                   placeholder="XXX XXX XXX XXX XXX XXX" required>
            <div class="form-group">
                <label for="predial">Foto</label>
                <input type="file" name="photo" class="form-control verificar">
            </div>

            <button id="verificar" class="btn btn-primary" type="submit">Guardar</button>
            <a class="btn btn-danger" href="./">Cancelar</a>
        </form>
    </div>


    @include('catalogos.finca.modal')

@endsection
@section('javascript')
    <script type="text/javascript">
        jQuery(function ($) {
            $('.currency-field').mask("###,###,##0.00", {reverse: true});
            $('input[name="servicio_luz"]').mask('000 000 000 000');
            $('input[name="water_account_number"]').mask('000 000 000');
            $('input[name="predial"]').mask('000 000 000 000 000 000');
        });
    </script>
@endsection
