<label for="telefono">Telefono &nbsp;&nbsp;
    <a
            data-target="#modal-add-phone"
            data-toggle="modal"
            data-owner-type="{{ $type }}"
            data-id="{{ $id }}">
        <button class="btn-sm btn-success">Añadir</button>
    </a>
</label><br>
<div id="listas">
    {{--                    @var $tel is collection of phones of arrendatario(lessee) --}}
    @forelse($phones as $phone)
            <input type="text"
                   data-mask="(000) 000 0000"
                   onkeypress="return justNumbers(event)"
                   class="mascara"
                   name="phones[{{$phone->id_telefono}}][number]"
                   value="{{$phone->telefono}}"
                   placeholder="Telefono..."
                   required>&nbsp;
            <input id="desc" type="text"
                     value="{{$phone->descripcion}}"
                     name="phones[{{$phone->id_telefono}}][description]" placeholder="Descripcion..."
                     required>&nbsp;

            <button
                id="delete-phone"
                type="button"
                class="btn btn-danger"
                data-toggle="modal"
                data-target="#modal-delete-phone"
                data-phone="{{ $phone->id_telefono }}">
                Eliminar
            </button>

            <br>
    @empty
        No hay telefonos registrados
    @endforelse
</div>
@section('after-content')
    <div aria-hidden="true" class="modal fade modal-slide-in-right" id="modal-delete-phone" role="dialog" tabindex="-1">
        {{ Form::Open(['url'=>['catalogos/arrendatario/telefono' ],'method'=>'delete', 'id' => 'phone-form']) }}
        <div class="modal-dialog">
            <div class="modal-content">
                <input type="hidden" name="id" id="phone-id"/>
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Telefono</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>Confirme si desea Eliminar el Telefono</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </div>
        {{Form::Close()}}
    </div>


    <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-add-phone">
        {!! Form::Open(['id' => 'add-phone-form','method' => 'POST', 'url' =>['catalogos/arrendatario/telefonofiador']]) !!}
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
                    <input class="input-group mascara" data-mask="(000) 000 0000" id="masc-tel" type="text" name="telefono" placeholder="Telefono..." required>
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
    @parent
@stop
@section('javascript')

$('#modal-delete-phone').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var phoneId = button.data('phone')

    var url = "{{ url('phones') }}/" + phoneId;

    var modal = $(this);
    modal.find('#phone_id').val(url);
    $('#phone-form').attr('action', url);
});
$('#modal-add-phone').on('show.bs.modal', function (event) {
    var link = $(event.relatedTarget); // Button that triggered the modal
    var phoneableId = link.data('id');
    var owner_type= link.data('owner-type');
    var url = 'none';
    if (owner_type == {!! json_encode(\App\Models\CatFiador::class) !!} ){
        var url = '{{ url('catalogos/arrendatario/telefonofiador/') }}/'+ phoneableId;
    }
    if (owner_type == {!! json_encode(\App\Models\Lessee::class) !!} ){
        var url = '{{ url('catalogos/arrendatario/telefono/') }}/'+ phoneableId;
    }
    if (owner_type == {!! json_encode(\App\Models\Lessor::class) !!} ){
        var url = '{{ url('catalogos/arrendador/telefono/') }}/'+ phoneableId;
    }


    var modal = $(this);
    // modal.find('#phone_id').val(url);
    console.log(url);
    $('#add-phone-form').attr('action', url);
});

    @parent
@stop
