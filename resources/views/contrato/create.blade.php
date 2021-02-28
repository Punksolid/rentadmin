@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Contrato</h3>
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {!! Form::open(['url' => 'contrato', 'method' => 'POST', 'autocomplete' => 'on']) !!}
            {{Form::token()}}
            <div class="form-group">
                <label>Arrendador</label>
                <input type="text" class="form-control tipo-propiedad" id="arrendadornombre" placeholder="Arrendador..." disabled required>
                <button id="lessor_modal" type="button" onclick="limpiar()" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-arrendador-contrato"><i class="fa fa-search"></i></button>
                <input type="hidden" id="id_arrendador_contrato" name="id_arrendador" value="" required>
            </div>

            <div class="form-group">
                <label>Inmueble</label>
                <input type="text" class="form-control tipo-propiedad" id="propiedadnombre" placeholder="Inmueble..." disabled required>
                <button type="button" id="property_modal" class="btn buscar-btn btn-sm btn-primary" onclick="filtrado()" data-toggle="modal" data-target="#modal-propiedad-contrato"><i class="fa fa-search"></i></button>
                <input type="hidden" id="id_propiedad_contrato" name="id_finca" value="" required>
            </div>
            <div class="form-group">
                <label>Arrendatario</label>
                <input type="text" class="form-control tipo-propiedad" id="arrendatarionombre" placeholder="Arrendatario..." disabled required>
                <button type="button" id="lessee_modal" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-arrendatario-contrato"><i class="fa fa-search"></i></button>
                <input type="hidden" id="id_arrendatario_contrato" name="id_arrendatario" value="" required>
            </div>

            <div class="form-group">
                <label for="duracion_contrato">Duracion del Contrato(Años)</label>
                <input id="duracion_c" min="1" onkeyup="mostrar()" onchange="mostrar()" type="number" name="duracion_contrato" class="form-control" placeholder="Duracion..." required>
            </div>
            <div class="form-group">
                <label for="fecha_inicio">Fechas de Contrato</label>
                <div class="hola" style="display: flex; height: 37px">
                    <label style="background-color: #F01B21; color: white" class="form-control text-center">Inicio</label>
                    <label style="background-color: #F01B21; color: white" class="form-control text-center">Terminacion</label>
                    <label style="background-color: #F01B21; color: white" class="form-control text-center">Cantidad</label>
{{--                    <label style="background-color: #F01B21; color: white" class="form-control text-center">Porcentaje de Aumento</label>--}}
                </div>
                <div id="fechas_con">
                </div>
            </div>

            <div class="form-group">
                <label for="moneda">Bonificacion</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input id="moneda" onclick="this.value = null" type="text" name="bonificacion" data-type="currency" class="form-control currency-field" placeholder="Bonificacion..." required>
                </div>
            </div>
            <div class="form-group">
                <label for="monedadep">Deposito En Garantia</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input id="monedadep" onclick="this.value = null" type="text" name="deposito" data-type="currency" class="form-control currency-field" placeholder="Deposito..." required>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="./">Cancelar</a>
            </div>

            {!! Form::close() !!}
            @include("contrato.modal")

        </div>
    </div>

    <script type="text/javascript">

        jQuery(function ($) {
            $('.currency-field').mask("###,###,##0.00", {reverse: true});
        });
        function limpiar() {
            document.getElementById('id_propiedad_contrato').value = null;
            document.getElementById('propiedadnombre').value = null;
        }

        function filtrado() {
            var id_arrendador = document.getElementById('id_arrendador_contrato').value;
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
    </script>



@endsection
