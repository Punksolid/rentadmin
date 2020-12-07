<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-tipo-usuario">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleccione el Tipo de Usuario</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input id="buscadortipousuario" type="text" class="form-control" onkeyup="buscadorTipoUsuario()" name="searchText" placeholder="Buscar Tipo de Usuario...">
                </div>
                <hr>
                @foreach($tipousuario as $tu)
                    <div class="item">
                        <button style="margin-bottom: 4px" data-dismiss="modal" id="tipo_usuario" onclick="tipoUsuario()" class="nombrestipousuario btn btn-secondary form-control" value="{{$tu->id_tipo_usuario}}">{{$tu->id_tipo_usuario}}-. {{$tu->nombre}}</button>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
