@extends ('layouts.admin')
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

            {!! Form::model($finca, ['method' => 'PATCH', 'route' =>['finca.update', $finca->id_cat_fincas]]) !!}
            {{Form::token()}}
            <div class="form-group">
                <label for="finca_arrendada">Inmueble</label>
                <input type="text" name="finca_arrendada" class="form-control verificar" onkeyup="this.value = this.value.toUpperCase();" value="{{ $finca->finca_arrendada }}" placeholder="Inmueble..." required>
            </div>

            <div class="form-group">
                <label for="id_arrendador">Arrendador</label>
                <input type="text" class="form-control verificar tipo-propiedad" id="arrendadorname" placeholder="Arrendador..." value="{{$arrendadores->id_cat_arrendador}}-. {{$arrendadores->nombre}} {{$arrendadores->apellido_paterno}}" disabled required>
                <button class="btn buscar-btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#modal-arrendador"><i class="fa fa-search"></i></button>
                <input type="hidden" id="id_arrendador" name="id_arrendador" value="{{$arrendadores->id_cat_arrendador}}" required>
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
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" class="form-control verificar" onkeyup="this.value = this.value.toUpperCase();" value="{{ $finca->descripcion }}" placeholder="Especificaciones..." required>
            </div>

            <div class="form-group">
                <label for="recibo">Recibo</label>
                <label style="margin-left: 200px !important;" for="estatus_renta">Estatus</label>
                <div style="display:block;">
                    @if($finca->recibo === "Fiscal")
                            <label>Fiscal</label>
                            <input style="margin-right: 20px" class="cb" checked onchange="cbChange(this)" type="radio" name="fiscal">
                            <label>No Fiscal</label>
                            <input type="radio" class="cb" onchange="cbChange(this)" name="nofiscal">
                    @else
                        <label>Fiscal</label>
                        <input style="margin-right: 20px" class="cb" onchange="cbChange(this)" type="radio" name="fiscal">
                        <label>No Fiscal</label>
                        <input type="radio" class="cb" checked onchange="cbChange(this)" name="nofiscal">
                    @endif
                </div>
                <div style="display: block; margin-left: 248px !important; margin-top: -38px;">
                    @if($finca->estatus_renta === "Disponible")
                        <input style="" type="checkbox" name="estatus_renta" checked data-toggle="toggle" data-on="Disponible" data-off="Rentada" data-onstyle="success" data-offstyle="danger">
                    @else
                        <input style="" type="checkbox" name="estatus_renta" data-toggle="toggle" data-on="Disponible" data-off="Rentada" data-onstyle="success" data-offstyle="danger">
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="mantenimiento">Mantenimiento</label>
                <input id="currency-field" type="text" name="mantenimiento verificar" data-type="currency" class="form-control" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="{{$finca->mantenimiento}}" placeholder="Mantenimiento..." required>
            </div>
            <div class="form-group">
                <label for="cuota_agua">Cuota de Agua</label>
                <input id="currency-field" type="text" name="cuota_agua verificar" data-type="currency" class="form-control" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="{{$finca->cuota_agua}}" placeholder="Cuota de Agua..." required>
            </div>

            <div class="form-group">
                <label for="servicio_luz">Servicio de Luz</label>
                <input type="text" name="servicio_luz" class="form-control verificar" onkeyup="this.value = this.value.toUpperCase();" value="{{ $finca->servicio_luz }}" placeholder="XXXXXXXXXXXX" required>
            </div>
            <div class="form-group">
                <label for="cta_japac">Cuenta Japac</label>
                <input type="text" name="cta_japac" class="form-control verificar" onkeyup="this.value = this.value.toUpperCase();" value="{{ $finca->cta_japac }}" placeholder="XXXXXXXXX" required>
            </div>

            <div class="form-group">
                <label for="predial">Numero de Predial</label>
                <input type="text" name="predial" class="form-control verificar" onkeyup="this.value = this.value.toUpperCase();" value="{{ $finca->predial }}" placeholder="XXX-XXX-XX-XXX" required>
            </div>

            <div class="form-group">
                <button id="verificar" class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="../">Cancelar</a>
            </div>

            {!! Form::close() !!}
            @include('catalogos.finca.modal')
        </div>
    </div>

    <script>
        $('#verificar').click(function () {
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
            $('input[name="servicio_luz"]').mask('000 000 000 000');
            $('input[name="cta_japac"]').mask('000 000 000');
            $('input[name="predial"]').mask('000 000 00 000');
        });
    </script>
@endsection
