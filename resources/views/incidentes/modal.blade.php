<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-arrendador">
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
                    <button style="margin-bottom: 4px" data-dismiss="modal" id="arrendadorse{{$ar->id_cat_arrendador}}" onclick="arrendador({{$ar->id_cat_arrendador}})" class="nombres btn btn-secondary form-control" value="{{$ar->id_cat_arrendador}}">{{$ar->id_cat_arrendador}}-. {{$ar->nombre}} {{$ar->apellido_paterno}}</button>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-propiedad">
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
                    <input id="buscadorpropiedad" type="text" class="form-control" onkeyup="buscadorPropiedad()" name="searchText" placeholder="Buscar Arrendatario...">
                </div>
                <hr>
                @foreach($propiedad as $f)
                        <div class="item">
                            @php($arr = \App\Models\
Lessor::where('id_cat_arrendador', $f->id_arrendador)->first())
                            <a id="{{$f->id_cat_fincas}}" class="fincafiltro" href="{{$f->id_arrendador}}">
                                <button style="margin-bottom: 4px" data-dismiss="modal" id="propiedad_modal{{$f->id_cat_fincas}}" onclick="propiedadIncidente('{{$f->id_cat_fincas}}', '{{$arr->id_cat_arrendador.'-. '.$arr->nombre.' '.$arr->apellido_paterno}}', '{{$arr->id_cat_arrendador}}')" class="nombrespropiedad btn btn-secondary form-control" value="{{$f->id_cat_fincas}}">{{$f->id_cat_fincas}}-. {{$f->finca_arrendada}}</button>
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

<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-tipo">
    {!! Form::open(array('url' => 'incidentes/tipoincidente', 'method' => 'POST', 'autocomplete' => 'off')) !!}
    {{Form::token()}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Añadir Tipo de Incidente</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input class="input-group" type="text" name="tipo_incidente" placeholder="Tipo de Incidente...">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
    {{Form::Close()}}

<script>
    function propiedadIncidente(id, arrendador, id_arr) {
        var nombre = document.getElementById("propiedad_modal"+id).innerHTML;

        document.getElementById("propiedadnombre").value = nombre;
        document.getElementById("id_propiedad_contrato").value = id;
        document.getElementById('arrendadorname').value = arrendador;
        document.getElementById('id_arrendador').value = id_arr;
    }
</script>
