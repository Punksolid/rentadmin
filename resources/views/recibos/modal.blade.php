<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-arrendador-contrato">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleccione el Arrendador</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input id="buscador" type="text" class="form-control" onkeyup="buscador()" name="searchText" placeholder="Buscar Arrendador...">
                </div>
                <hr>
                @foreach($arrendador as $lessor)
                    <div class="item">
                        <button style="margin-bottom: 4px" data-dismiss="modal" id="arrendador_contrato{{$lessor->id}}" onclick="arrendadorContrato({{$lessor->id}}); vista({{$lessor->id}})" class="nombres btn btn-secondary form-control" value="{{$lessor->id}}">{{$lessor->id}}-. {{$lessor->nombre}} {{$lessor->apellido_paterno}}</button>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-arrendador-recibo">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleccione el Arrendador</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input id="buscadorarrendadorrecibo" type="text" class="form-control" onkeyup="buscadorArrendadorRecibo()" name="searchText" placeholder="Buscar Arrendador...">
                </div>
                <hr>
                @foreach($arrendador as $lessor)
                    <div class="item">
                        <button style="margin-bottom: 4px" data-dismiss="modal" id="arrendador_recibo{{$lessor->id}}" onclick="arrendadorRecibo({{$lessor->id}})" class="nombresarrendadorrecibo nombres btn btn-secondary form-control" value="{{$lessor->id}}">{{$lessor->id}}-. {{$lessor->nombre}} {{$lessor->apellido_paterno}}</button>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-arrendatario-registro">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleccione el Arrendatario</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input id="buscadorarrendatarioregistro" type="text" class="form-control" onkeyup="buscadorArrendatarioRecibo()" name="searchText" placeholder="Buscar Arrendatario...">
                </div>
                <hr>
                @foreach($arrendatario as $arr)
                    <div class="item">
                        <button style="margin-bottom: 4px" data-dismiss="modal" id="arrendatario_recibo{{$arr->id_cat_arrendatario}}" onclick="arrendatarioRecibo({{$arr->id_cat_arrendatario}});" class="nombresarrendatariorecibo btn btn-secondary form-control" value="{{$arr->id_cat_arrendatario}}">{{$arr->id_cat_arrendatario}}-. {{$arr->nombre}} {{$arr->apellido_paterno}}</button>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-propiedad-registro">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleccione el Inmueble</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input id="buscadorpropiedadrecibo" type="text" class="form-control" onkeyup="buscadorPropiedadRecibo()" name="searchText" placeholder="Buscar Inmueble...">
                </div>
                <hr>
                @foreach($finca as $property)
                    <div class="item">
                        @php($lessor = \App\Models\Lessor::where('id', $property->id_arrendador)->first())
{{--                        <a id="{{$property->id_cat_fincas}}" class="fincafiltroregistro" href="{{$property->id_arrendador}}">--}}
{{--                        <button style="margin-bottom: 4px" data-dismiss="modal" id="propiedad_recibo{{ $property->id }}" onclick="propiedadRecibo('{{$property->id_cat_fincas }}', '{{$lessor->id.'-. '.$lessor->nombre.' '.$lessor->apellido_paterno}}', '{{$lessor->id}}'); completarArrendatario()" class="nombrespropiedadrecibo btn btn-secondary form-control" value="{{$property->id_cat_fincas}}">{{$property->id_cat_fincas}}-. {{$property->finca_arrendada}}</button>--}}
{{--                        </a>--}}
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-propiedad-parcial">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleccione el Inmueble</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input id="buscadorpropiedadparcial" type="text" class="form-control" onkeyup="buscadorPropiedadParcial()" name="searchText" placeholder="Buscar Inmueble...">
                </div>
                <hr>
                @foreach($finca as $property)
                    <div class="item">
                        <a id="{{$property->id_cat_fincas}}" class="fincaparcial" href="{{$property->id_arrendador}}">
                            <button style="margin-bottom: 4px" data-dismiss="modal" id="propiedad_parcial{{$property->id_cat_fincas}}" onclick="propiedadParcial('{{$property->id_cat_fincas}}', '{{$property->lessor->id.'-. '.$property->lessor->nombre.' '.$property->lessor->apellido_paterno}}', '{{$property->lessor->id}}'); completarArrendatarioParcial()" class="nombrespropiedadparcial btn btn-secondary form-control" value="{{$property->id}}">{{$property->id}}-. {{$property->name}}</button>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-arrendador-parcial">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleccione el Arrendador</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input id="buscadorarrendadorparcial" type="text" class="form-control" onkeyup="buscadorArrendadorParcial()" name="searchText" placeholder="Buscar Arrendador...">
                </div>
                <hr>
                @foreach($arrendador as $lessor)
                    <div class="item">
                        <button style="margin-bottom: 4px" data-dismiss="modal" id="arrendador_parcial{{$lessor->id}}" onclick="arrendadorParcial({{$lessor->id}})" class="nombresarrendadorparcial nombres btn btn-secondary form-control" value="{{$lessor->id}}">{{$lessor->id}}-. {{$lessor->nombre}} {{$lessor->apellido_paterno}}</button>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
