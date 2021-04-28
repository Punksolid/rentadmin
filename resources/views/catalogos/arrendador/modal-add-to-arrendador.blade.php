<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-add-phone">
    {!! Form::model($arrendador, ['method' => 'POST', 'url' =>['catalogos/arrendador/telefono', $arrendador->id]]) !!}
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
                <input class="input-group mascara" data-mask="(000) 000 0000" type="text" id="masc-tel" name="telefono" onkeypress="return justNumbers(event)" placeholder="Telefono..." required>
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
    {!! Form::model($arrendador, ['method' => 'POST', 'url' =>['catalogos/arrendador/email', $arrendador->id]]) !!}
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
                <input class="input-group" type="email" name="email" placeholder="Email..." required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
    {{Form::Close()}}
</div>

<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-add-banco">
    {!! Form::model($arrendador, ['method' => 'POST', 'url' =>['catalogos/arrendador/banco', $arrendador->id]]) !!}
    {{Form::token()}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Añadir Banco</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input class="input-group form-control" type="text" style="text-transform:uppercase" name="banco" placeholder="Banco..." required>
                <input style="margin-top: 10px" class="input-group form-control" type="text" name="cuenta" placeholder="Cuenta..." required>
                <input style="margin-top: 10px" class="input-group form-control" type="text" name="clabe" maxlength="18" placeholder="Clabe..." required>
                <input style="margin-top: 10px" class="input-group form-control" type="text" name="nombre_titular" placeholder="Nombre del Titular..." required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
    {{Form::Close()}}
</div>
