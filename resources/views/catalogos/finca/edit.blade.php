@extends ('layouts.layout-v2')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Inmueble</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::model($finca, [
                    'method' => 'PATCH',
                    'files' => true,
                    'route' =>['finca.update', $finca->id]
            ]) !!}
            {{Form::token()}}
            <div class="form-group">
                <label for="name">Inmueble</label>
                <input type="text" name="name" class="form-control verificar" style="text-transform:uppercase" value="{{ $finca->name }}" placeholder="Inmueble..." required>
            </div>

            <div class="form-group">
                <label for="id_arrendador">Arrendador</label>
                <input type="text" class="form-control verificar tipo-propiedad" id="arrendadorname" placeholder="Arrendador..." value="{{$arrendadores->id}}-. {{$arrendadores->nombre}} {{$arrendadores->apellido_paterno}}" disabled required>
                <button class="btn buscar-btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#modal-arrendador"><i class="fa fa-search"></i></button>
                <input type="hidden" id="id_arrendador" name="lessor_id" value="{{$arrendadores->id}}" required>
            </div>

            <div class="form-group">
                <label for="id_tipo_propiedad">Tipo de Propiedad</label><br>
                <select class="form-control tipo-propiedad verificar" name="id_tipo_propiedad" required>
                    <option name="id_tipo_propiedad" value="{{$tipo->id_tipo_propiedad}}">{{$tipo->tipo_propiedad}}</option>
                    <optgroup label="---------------------------------------------------------------------------------------">
                    <option name="id_tipo_propiedad" value="">Seleccione el Tipo de Propiedad</option>
                    @foreach($propiedad as $p)
                        @if($p->estatus == 0)
                        @else
                            <option name="id_tipo_propiedad" value="{{$p->id_tipo_propiedad}}">{{$p->tipo_propiedad}}</option>
                        @endif
                    @endforeach
                    </optgroup>
                </select>
                <a data-target="#modal-propiedad" data-toggle="modal"><button id="agg" class="btn btn-success">+</button></a>
            </div>

            <div class="form-group">
                <label for="descripcion">Direccion</label>
                <input type="text" name="address" class="form-control verificar" style="text-transform:uppercase" value="{{ $finca->address }}" placeholder="Direccion..." required>
            </div>
            <div class="form-group">
                <label for="descripcion">Geolocalizacion</label>
                <input type="text" name="geolocation" class="form-control verificar" style="text-transform:uppercase" value="{{ $finca->geolocation }}" placeholder="Geolocalizacion..." required>
            </div>

            <div class="form-group">
                <label for="recibo">Recibo</label>
                <label style="margin-left: 200px !important;" for="estatus_renta">Estatus</label>
                <div style="display:block;">
                    <div style="display:block;">
                        <label>Fiscal</label>
                        <input  style="margin-right: 20px" class="cb"  type="radio" name="fiscal" value="{{ \App\Models\Property::RECIBO_STRING_FISCAL_VALUE }}" {!!  old('fiscal',$finca->recibo === \App\Models\Property::RECIBO_STRING_FISCAL_VALUE ? 'checked':'') !!} >
                        <label>No Fiscal</label>
                        <input  style="margin-right: 20px" class="cb"  type="radio" name="fiscal" value="{{ \App\Models\Property::RECIBO_STRING_NO_FISCAL_VALUE }}" {!!  old('fiscal',$finca->recibo === \App\Models\Property::RECIBO_STRING_NO_FISCAL_VALUE ? 'checked':'') !!} >
                    </div>
                </div>
                <div style="display: block; margin-left: 248px !important; margin-top: -38px;">
                    @if($finca->rented)
                        <input id="estatus_renta_on" style="" type="checkbox" name="estatus_renta" data-toggle="toggle" data-on="Disponible" data-off="Rentada" data-onstyle="success" data-offstyle="danger">
                    @else
                        <input id="estatus_renta_off" style="" type="checkbox" name="estatus_renta" checked data-toggle="toggle" data-on="Disponible" data-off="Rentada" data-onstyle="success" data-offstyle="danger">
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="mantenimiento">Mantenimiento</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <div class="input-group-text">$</div>
                    </div>
                    <input id="currency-field" type="text" name="maintenance" data-type="currency" class="form-control currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?$" value="{{$finca->maintenance }}" placeholder="Mantenimiento..." required>
                </div>
            </div>
            <div class="form-group">
                <label for="cuota_agua">Cuota de Agua</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <div class="input-group-text">$</div>
                    </div>
                    <input id="currency-field" type="text" name="water_fee" data-type="currency" class="form-control currency-field" pattern="^\d{1,3}(,\d{3})*(\.\d+)?$" value="{{$finca->water_fee }}" placeholder="Cuota de Agua..." required>
                </div>
            </div>

            <div class="form-group">
                <label for="energy_fee">Servicio de Luz</label>
                <input type="text" name="energy_fee" class="form-control verificar" style="text-transform:uppercase" value="{{ $finca->energy_fee }}" placeholder="XXXXXXXXXXXX" required>
            </div>
            <div class="form-group">
                <label for="cta_japac">Cuenta Japac</label>
                <input type="text" name="water_account_number" class="form-control verificar" style="text-transform:uppercase" value="{{ $finca->water_account_number }}" placeholder="XXXXXXXXX" required>
            </div>

            <div class="form-group">
                <label for="predial">Numero de Predial</label>
                <input type="text" name="predial" class="form-control verificar" style="text-transform:uppercase" value="{{ $finca->predial }}" placeholder="XXX-XXX-XX-XXX" required>
            </div>
            <div class="form-group">
                <label for="predial">Foto</label>
                <input type="file" name="photo" class="form-control" >
                @if ($property->hasMedia())
                    <img src="{{ $property->getFirstMediaUrl() }}" alt="..." class="img-thumbnail" style="width: 200px; height: 200px;">
                    <a class="btn-sm btn-danger" href="{{ route('finca.image.destroy', $property->id) }}">Eliminar Imagen</a>

                @endif
            </div>
            <div class="form-group">
                <button id="verificar" class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="../">Cancelar</a>
            </div>

            {!! Form::close() !!}
            @include('catalogos.finca.modal')
        </div>
    </div>


@endsection
@section('javascript')
    <script>
        $('#verificar').click(function () { // @todo Delete this block, too cumberstone
            let i = 0;
            let veri = $('.verificar');
            $.each(veri, function (index, ver) {
                if (ver.value == ''){
                    i++;
                }
            })
            if (i>=1){
                alert('Llene todos los campos');
                return false;
            }else{
                return true;
            }
        })

        jQuery(function ($) {
            $('.currency-field').mask("###,###,##0.00", {reverse: true});
            $('input[name="servicio_luz"]').mask('000 000 000 000');
            $('input[name="cta_japac"]').mask('000 000 000');
            $('input[name="predial"]').mask('000 000 000 000 000 000');
        });
    </script>
@endsection
