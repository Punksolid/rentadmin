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
                @foreach($arrendador as $ar)
                    <div class="item">
                        <button style="margin-bottom: 4px" data-dismiss="modal" id="arrendador_contrato{{$ar->id_cat_arrendador}}" onclick="arrendadorContrato({{$ar->id_cat_arrendador}})" class="nombres btn btn-secondary form-control" value="{{$ar->id_cat_arrendador}}">{{$ar->id_cat_arrendador}}-. {{$ar->nombre}} {{$ar->apellido_paterno}}</button>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-arrendatario-contrato">
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
                    <input id="buscadorarrendatario" type="text" class="form-control" onkeyup="buscadorArrendatario()" name="searchText" placeholder="Buscar Arrendatario...">
                </div>
                <hr>
                @foreach($arrendatario as $arr)
                    <div class="item">
                        <button style="margin-bottom: 4px" data-dismiss="modal" id="arrendatario_contrato{{$arr->id_cat_arrendatario}}" onclick="arrendatarioContrato({{$arr->id_cat_arrendatario}})" class="nombresarrendatario btn btn-secondary form-control" value="{{$arr->id_cat_arrendatario}}">{{$arr->id_cat_arrendatario}}-. {{$arr->nombre}} {{$arr->apellido_paterno}}</button>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-propiedad-contrato">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleccione La Propiedad</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input id="buscadorpropiedad" type="text" class="form-control" onkeyup="buscadorPropiedad()" name="searchText" placeholder="Buscar Propiedad...">
                </div>
                <hr>
                @foreach($finca as $f)
                    @if($f->estatus_renta == 'Rentada' || $f->estatus == 0)
                    @else
                        <div class="item">
                            @php($arr = \App\Models\CatArrendador::where('id_cat_arrendador', $f->id_arrendador)->first())
                            <a id="{{$f->id_cat_fincas}}" class="fincafiltro" href="{{$f->id_arrendador}}">
                                <button style="margin-bottom: 4px" data-dismiss="modal" id="propiedad_modal{{$f->id_cat_fincas}}" onclick="propiedadContrato('{{$f->id_cat_fincas}}', '{{$arr->id_cat_arrendador.'-. '.$arr->nombre.' '.$arr->apellido_paterno}}', '{{$arr->id_cat_arrendador}}')" class="nombrespropiedad btn btn-secondary form-control" value="{{$f->id_cat_fincas}}">{{$f->id_cat_fincas}}-. {{$f->finca_arrendada}}</button>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
