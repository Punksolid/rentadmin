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
                @foreach($arrendador as $ar)
                    <div class="item">
                        <button style="margin-bottom: 4px" data-dismiss="modal" id="arrendador_recibo{{$ar->id_cat_arrendador}}" onclick="arrendadorRecibo({{$ar->id_cat_arrendador}})" class="nombresarrendadorrecibo nombres btn btn-secondary form-control" value="{{$ar->id_cat_arrendador}}">{{$ar->id_cat_arrendador}}-. {{$ar->nombre}} {{$ar->apellido_paterno}}</button>
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
                @foreach($finca as $fin)
                    <div class="item">
                        @php($arr = \App\Models\CatArrendador::where('id_cat_arrendador', $fin->id_arrendador)->first())
                        <a id="{{$fin->id_cat_fincas}}" class="fincafiltroregistro" href="{{$fin->id_arrendador}}">
                            <button style="margin-bottom: 4px" data-dismiss="modal" id="propiedad_recibo{{$fin->id_cat_fincas}}" onclick="propiedadRecibo('{{$fin->id_cat_fincas}}', '{{$arr->id_cat_arrendador.'-. '.$arr->nombre.' '.$arr->apellido_paterno}}', '{{$arr->id_cat_arrendador}}'); completarArrendatario()" class="nombrespropiedadrecibo btn btn-secondary form-control" value="{{$fin->id_cat_fincas}}">{{$fin->id_cat_fincas}}-. {{$fin->finca_arrendada}}</button>
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
