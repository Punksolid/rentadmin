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

            {!! Form::open(array('url' => 'catalogos/finca', 'method' => 'POST', 'autocomplete' => 'off')) !!}
            {{Form::token()}}
            <div class="form-group">
                <label for="finca_arrendada">Inmueble</label>
                <input type="text" name="finca_arrendada" class="verificar form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="Inmueble..." required>
            </div>
            <div class="form-group">
                <label for="id_arrendador">Arrendador</label>
                <input type="text" class="form-control verificar tipo-propiedad" id="arrendadorname" placeholder="Arrendador..." disabled >
                <button type="button" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-arrendador"><i class="fa fa-search"></i></button>
                <input type="hidden" id="id_arrendador" name="id_arrendador" value="" >
            </div>

            <div class="form-group">
                <label for="id_tipo_propiedad">Tipo de Propiedad</label><br>
                    <select class="form-control verificar tipo-propiedad" name="id_tipo_propiedad" required>
                        <option name="id_tipo_propiedad" value="">Seleccione el Tipo de Propiedad</option>
                        @foreach($propiedad as $p)
                            @if($p->estatus == 0)
                                @else
                                    <option name="id_tipo_propiedad" value="{{$p->id_tipo_propiedad}}">{{$p->tipo_propiedad}}</option>
                            @endif
                        @endforeach
                </select>
                <a data-target="#modal-propiedad" data-toggle="modal"><button id="agg" class="btn btn-success">+</button></a>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" class="form-control verificar" onkeyup="this.value = this.value.toUpperCase();"  required placeholder="Especificaciones..." >
            </div>


            <div class="form-group">
                <label for="recibo">Recibo</label>
                <div style="display:block;">
                    <label>Fiscal</label>
                    <input style="margin-right: 20px" class="cb" onchange="cbChange(this)" type="radio" name="fiscal">
                    <label>No Fiscal</label>
                    <input type="radio" class="cb" onchange="cbChange(this)" name="nofiscal">
                </div>
            </div>

            <div class="form-group">
                <label for="mantenimiento">Mantenimiento</label>
                <input id="currency-field" type="text" name="mantenimiento" value="$0.00" data-type="currency" required class="form-control verificar" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Mantenimiento..." >
            </div>

            <div class="form-group">
                <label for="cuota_agua">Cuota de Agua</label>
                <input id="currency-field" type="text" name="cuota_agua" value="$0.00" data-type="currency" required class="form-control verificar" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Cuota de Agua..." >
            </div>

            <div class="form-group">
                <label for="servicio_luz">Servicio de Luz</label>
                <input type="text" name="servicio_luz" class="form-control verificar" placeholder="XXX XXX XXX XXX" required>
            </div>
            <div class="form-group">
                <label for="cta_japac">Cuenta Japac</label>
                <input type="text" name="cta_japac" class="form-control verificar" placeholder="XXX XXX XXX" required>
            </div>

            <div class="form-group">
                <label for="predial">Numero de Predial</label>
                <input type="text" name="predial" class="form-control verificar" placeholder="XXX XXX XX XXX" required>
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
