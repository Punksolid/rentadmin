<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-finca">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleccione la Finca</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input id="buscador" type="text" class="form-control" onkeyup="buscador()" name="searchText" placeholder="Buscar Finca...">
                </div>
                <hr>
                @foreach($fincas as $f)
                    <div class="item">
                        <button style="margin-bottom: 4px" data-dismiss="modal" id="propiedades{{$f->id_cat_fincas}}" onclick="propiedad({{$f->id_cat_fincas}})" class="nombres btn btn-secondary form-control" value="{{$f->id_cat_fincas}}">{{$f->id_cat_fincas}}-. {{$f->finca_arrendada}}</button>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-tipo">
    {!! Form::open(array('url' => 'mantenimientos/tipomantenimiento', 'method' => 'POST', 'autocomplete' => 'off')) !!}
    {{Form::token()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
                <h4 class="modal-title">Añadir Tipo de Mantenimiento</h4>
				<button type="button" class="close" data-dismiss="modal"
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
			</div>
			<div class="modal-body">
				<input class="input-group" type="text" name="tipo_mantenimiento" placeholder="Tipo de Mantenimiento...">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
    {{Form::Close()}}
