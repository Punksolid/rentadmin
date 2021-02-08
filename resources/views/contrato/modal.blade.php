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
                        <button style="margin-bottom: 4px" data-dismiss="modal" id="arrendador_contrato{{$lessor->id}}" onclick="arrendadorContrato({{$lessor->id}})" class="nombres btn btn-secondary form-control" value="{{$lessor->id}}">{{$lessor->id}}-. {{$lessor->nombre}} {{$lessor->apellido_paterno}}</button>
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
                @foreach($arrendatario as $lessee)
                    <div class="item">
                        <button style="margin-bottom: 4px" data-dismiss="modal" id="arrendatario_contrato{{$lessee->id}}" onclick="arrendatarioContrato({{$lessee->id}})" class="nombresarrendatario btn btn-secondary form-control" value="{{$lessee->id}}">{{$lessee->id}}-. {{$lessee->nombre}} {{$lessee->apellido_paterno}}</button>
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
                @foreach($properties as $property)
                        <div class="item">
                            <a id="{{$property->id}}" class="fincafiltro" href="{{$property->lessor->id}}">
                                <button style="margin-bottom: 4px" data-dismiss="modal" id="propiedad_modal{{$property->id}}" onclick="propiedadContrato('{{$property->id}}', '{{$property->lessor->id.'-. '.$property->lessor->nombre.' '.$property->lessor->apellido_paterno}}', '{{$property->lessor->id}}')" class="nombrespropiedad btn btn-secondary form-control" value="{{$property->id}}">{{$property->id}}-. {{$property->name}}</button>
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
