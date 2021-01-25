<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-add-telefono">
    {!! Form::model($arrendatario, ['method' => 'POST', 'url' =>['catalogos/arrendatario/telefono', $arrendatario->id]]) !!}
    {{Form::token()}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Añadir Telefono</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input class="input-group mascara" data-mask="(000) 000 0000" id="masc-tel" onkeypress="return justNumbers(event)" type="text" name="telefono" placeholder="Telefono..." required>
                <input style="margin-top: 10px" class="input-group" type="text" name="descripcion" placeholder="Descripcion..." required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
    {{Form::Close()}}
</div>



<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-add-email">
    {!! Form::model($arrendatario, ['method' => 'POST', 'url' =>['catalogos/arrendatario/email', $arrendatario->id]]) !!}
    {{Form::token()}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Añadir Email</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input class="input-group" type="text" name="email" placeholder="Email..." required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
    {{Form::Close()}}
</div>
