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
                        <button style="margin-bottom: 4px" data-dismiss="modal" id="arrendador_contrato{{$lessor->id}}" onclick="BotonArrendador({{$lessor->id}})" class="nombres btn btn-secondary form-control" value="{{$lessor->id}}">{{$lessor->id}}-. {{$lessor->nombre}} {{$lessor->apellido_paterno}}</button>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
