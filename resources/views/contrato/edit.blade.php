@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Contrato</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::model($contrato, ['method' => 'PATCH', 'route' =>['contrato.update', $contrato->id]]) !!}
            {{Form::token()}}
            <div class="form-group">
                <label>Arrendador</label>
                <input type="text" class="form-control tipo-propiedad" id="arrendadornombre" placeholder="Arrendador..." value="{{$contrato->id_arrendador}}-. {{$contrato->arrendador_nombre}} {{$contrato->arrendador_apellido}}" disabled required>
                <button type="button" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-arrendador-contrato"><i class="fa fa-search"></i></button>
                <input type="hidden" id="id_arrendador_contrato" name="id_arrendador" value="{{$contrato->id_arrendador}}" required>
            </div>
            <div class="form-group">
                <label>Propiedad</label>
                <input type="text" class="form-control tipo-propiedad" id="propiedadnombre" placeholder="Propiedad..." value="{{$contrato->id_finca}}-. {{$contrato->finca_arrendada}}" disabled required>
                <button type="button" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-propiedad-contrato"><i class="fa fa-search"></i></button>
                <input type="hidden" id="id_propiedad_contrato" name="id_finca" value="{{$contrato->id_finca}}" required>
            </div>
            <div class="form-group">
                <label>Arrendatario</label>
                <input type="text" class="form-control tipo-propiedad" id="arrendatarionombre" placeholder="Arrendatario..." value="{{$contrato->id_arrendatario}}-. {{$contrato->arrendatario_nombre}} {{$contrato->arrendatario_apellido}}" disabled required>
                <button type="button" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-arrendatario-contrato"><i class="fa fa-search"></i></button>
                <input type="hidden" id="id_arrendatario_contrato" name="id_arrendatario" value="{{$contrato->id_arrendatario}}" required>
            </div>


            <div class="form-group">
                <label for="duracion_contrato">Duracion del Contrato(Años)</label>
                <input id="duracion_c" min="{{$contrato->duracion_contrato}}" onkeyup="editar()" onchange="editar()" type="number" name="duracion_contrato" value="{{$contrato->duracion_contrato}}" class="form-control" placeholder="Duracion..." required>
            </div>

            <div class="form-group">
                <label for="fecha_inicio">Fechas de Contrato</label>
                <div class="hola" style="display: flex; height: 37px">
                    <label style="background-color: #F01B21; color: white" class="form-control text-center">Inicio</label>
                    <label style="background-color: #F01B21; color: white" class="form-control text-center">Terminacion</label>
                    <label style="background-color: #F01B21; color: white" class="form-control text-center">Cantidad</label>
                </div>
                @foreach($fechas as $f)
                <div id="fechas_es" style="display: flex">
                    <input class="form-control fec_i" style="margin-bottom: 5px" type="date" value="{{$f->fecha_inicio}}" name="fec_ini{{$f->id_fechas_contrato}}">
                    <input class="form-control" style="margin-bottom: 5px" type="date" value="{{$f->fecha_fin}}" name="fec_fin{{$f->id_fechas_contrato}}">
                    <input class="form-control" style="margin-bottom: 5px" type="text" value="{{$f->cantidad}}" name="canti{{$f->id_fechas_contrato}}" placeholder="Cantidad...">
                </div>
                @endforeach
                <div id="fechas_con">
                </div>
            </div>

            <div class="form-group">
                <label for="bonificacion">Bonificacion</label>
                <input id="moneda" onclick="this.value = null" type="text" name="bonificacion" data-type="currency" class="form-control" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="{{$contrato->bonificacion}}" placeholder="Bonificacion..." required>
            </div>
            <div class="form-group">
                <label for="deposito">Deposito En Garantia</label>
                <input id="monedadep" onclick="this.value = null" type="text" name="deposito" data-type="currency" class="form-control" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="{{$contrato->deposito}}" placeholder="Deposito..." required>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="../">Cancelar</a>
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
        document.getElementById("monedadep").onblur =function (){
            this.value = '$'+parseFloat(this.value.replace(/,/g, ""))
                .toFixed(2)
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        }
    </script>

@endsection
