@extends ('layouts.layout-v2')
@section('page_title', 'Reportes')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Recibos</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Botones -->
            <div id="botones" class="form-group" style="width: 600px;">
                <button href=".togg1" class="btn btn-secondary" id="abrir-iniciar" type="button" data-toggle="collapse" data-target="#reciboautomatico" aria-expanded="false">Recibo Automatico</button>
                <button href=".togg2" class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#reciboparcial" aria-expanded="false">Recibo Parcial</button>
            </div>
            <!-- Termina Botones -->

            <!-- Recibos Automaticos -->
            <div id="reciboautomatico" class="togg1 collapse">
                <div class="form-group">
                    <label>Arrendador</label>
                    <input type="text" class="form-control tipo-propiedad" id="arrendadornombre" placeholder="Arrendador..." disabled required>
                    <button type="button" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-arrendador-contrato"><i class="fa fa-search"></i></button>
                    <input type="hidden" id="id_arrendador_contrato" name="id_arrendador" value="" required>
                </div>
                <table id="tablaprueba" class="table table-sm table-striped table-bordered table-condensed table-hover">
                    <thead class="thead-light">
                    <th>Imprimir</th>
                    <th>Inmueble</th>
                    <th>Arrendatario</th>
                    <th>Observaciones</th>
                    </thead>

                    <tbody>
                    </tbody>

                </table>

                <div class="form-group">
                    <label>Mes A Generar</label>
                    <select id="mes" name="mes" class="form-control">
                        <option selected disabled>Seleccione mes para generar recibo</option>
                        <option name="mes" value="{{$mesuno}}">{{$mesuno}}</option>
                        <option name="mes" value="{{$mesdos}}">{{$mesdos}}</option>
                    </select>
                </div>

                <!-- Botones -->
                <div class="form-group">
                    <button type="submit" onclick="recibo(); revisarcheck()" class="btn btn-secondary">Imprimir</button>
                </div>
            </div>
            <!-- Termina Recibos Automaticos -->

            <!-- Recibos Parciales -->
            <div id="reciboparcial" class="togg2 collapse">
                <div class="form-group">
                    <div class="form-group" style="width: 200%">
                        <input type="text" class="form-control recibo-input" id="arrendador_parcial" placeholder="Arrendador..." disabled required>
                        <button type="button" onclick="limpiarpar()" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-arrendador-parcial"><i class="fa fa-search"></i></button>
                        <input type="hidden" id="id_arrendador_parcial" name="" value="" required>
                    </div>
                    <div style="width: 200%" class="form-group">
                        <input type="text" class="form-control recibo-input" id="propiedad_parcial" placeholder="Inmueble..." disabled required>
                        <button type="button" class="btn buscar-btn btn-sm btn-primary" onclick="filtradoParcial(); limpiarparcialArre()" data-toggle="modal" data-target="#modal-propiedad-parcial"><i class="fa fa-search"></i></button>
                        <input type="hidden" id="id_propiedad_parcial" name="id_finca" value="" required>
                    </div>
                    <div style="width: 200%" class="form-group">
                        <input type="text" class="form-control recibo-input" id="arrendatario_parcial" placeholder="Arrendatario..." disabled required>
                        <input type="hidden" id="id_arrendatario_parcial" name="id_arrendatario" value="" required>
                    </div>

                    <div class="form-group">
                        <table class="table table-sm table-striped table-bordered table-condensed table-hover">
                            <thead class="thead-light">
                            <th>Importe</th>
                            <th>Dias</th>
                            <th>Bonificacion</th>
                            <th>Total</th>
                            </thead>
                            <tbody>
                            <td><input id="importeparcial" disabled class="form-control"></td>
                            <td><input id="numdiasparcial" type="number" min="1" max="31" onchange="calculoParcial(this.value)" onkeyup="calculoParcial(this.value)" class="form-control"></td>
                            <td><input id="bonificacionparcial" class="form-control"></td>
                            <td><input id="totalparcial" type="text" class="form-control"></td>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group">
                        <label>Mes A Generar</label>
                        <select id="mesparcial" name="mes" class="form-control">
                            <option>Seleccione mes para generar recibo</option>
                            <option name="mesparcial" value="{{$mesuno}}">{{$mesuno}}</option>
                            <option name="mesparcial" value="{{$mesdos}}">{{$mesdos}}</option>
                        </select>
                    </div>
                </div>
                <!-- Botones -->
                <div class="form-group">
                    <button onclick="imprimirParcial()" class="btn btn-secondary">Imprimir</button>
                </div>
            </div>
            <!-- Termina Recibos Parciales -->

            @include('recibos.modal')

        </div>
    </div>

    <div style="display: none">
        <input id="bonifparcial" style="display: none">
        <input id="urlbase" style="display: none" value="{{url('/')}}">
        <input id="urlrecibo" style="display: none" value="{{url('recibos-automaticos/recibo')}}">
        <input id="urlpdf" style="display: none" value="{{url("recibos-automaticos/pdf")}}">
        <input id="urlregistro" style="display: none" value="{{url("recibos-automaticos/registro")}}">
        <input id="urlarrendador" style="display: none" value="{{url("recibos-automaticos")}}">
        <input id="urlfiltro" style="display: none" value="{{url("recibos-automaticos/revision")}}">
        <input id="token" style="display: none" value="{{csrf_token()}}">
        <input id="urlparcial" style="display: none" value="{{url('recibos-automaticos/parcial')}}">
    </div>

    <script>
        document.onload= $('#abrir-iniciar').click();
    </script>
@endsection
