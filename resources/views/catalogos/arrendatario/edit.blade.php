@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Arrendatario</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::model($arrendatario, ['method' => 'PATCH', 'route' =>['arrendatario.update', $arrendatario->id_cat_arrendatario]]) !!}
            {{Form::token()}}
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{$arrendatario->nombre}}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Nombre..." required>
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendatario->apellido_paterno }}" placeholder="Apellido Paterno..." required>
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendatario->apellido_materno }}" placeholder="Apellido Materno..." required>
            </div>

            <div class="form-group">
                <label for="telefono">Telefono &nbsp;&nbsp;<a data-target="#modal-add-telefono" data-toggle="modal"><button class="btn-sm btn-success">Añadir</button></a></label><br>
                <div id="listas">
                    @foreach($tel as $te)
                        @if(count($tel) > 1)
                            <input type="text" data-mask="(000) 000 0000" onkeypress="return justNumbers(event)" class="mascara" name="telefonoid{{$te->id_telefono}}" value="{{$te->telefono}}" placeholder="Telefono..." required>&nbsp;<input id="desc" type="text" value="{{$te->descripcion}}" name="descripcionid{{$te->id_telefono}}" placeholder="Descripcion..." required>&nbsp;<a data-target="#modal-eliminar-telefono{{$te->id_telefono}}" data-toggle="modal"><button type="button" style="margin-bottom: 4px" class="btn btn-danger btn-sm">-</button></a><br>
                        @else
                            <input type="text" data-mask="(000) 000 0000" onkeypress="return justNumbers(event)" class="mascara" name="telefonoid{{$te->id_telefono}}" value="{{$te->telefono}}" placeholder="Telefono..." required>&nbsp;<input id="desc" type="text" value="{{$te->descripcion}}" name="descripcionid{{$te->id_telefono}}" placeholder="Descripcion..." required>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label for="email">Correo Electronico &nbsp;&nbsp;<a data-target="#modal-add-email" data-toggle="modal"><button class="btn-sm btn-success">Añadir</button></a></label><br>
                <div id="lista">
                    @foreach($email as $em)
                        @if(count($email) > 1)
                            <input id="masc-tel" type="email" name="emailid{{$em->id_email}}" value="{{$em->email}}" placeholder="Correo Electronico..." required>&nbsp;<a data-target="#modal-eliminar-email{{$em->id_email}}" data-toggle="modal"><button type="button" style="margin-bottom: 4px" class="btn btn-danger btn-sm">-</button></a><br>
                        @else
                            <input id="masc-tel" type="email" name="emailid{{$em->id_email}}" value="{{$em->email}}" placeholder="Correo Electronico..." required><br>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <h4><strong>Domicilio</strong></h4>
            </div>
            <div class="form-group">
                <label for="calle">Calle</label>
                <input type="text" name="calle" value="{{ $arrendatario->calle }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Calle..." required>
            </div>
            <div class="form-group">
                <label for="numero_ext">Numero Exterior</label>
                <input type="text" name="numero_ext" onkeypress="return justNumbers(event)" value="{{ $arrendatario->numero_ext }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Numero Exterior..." required>
            </div>
            <div class="form-group">
                <label for="numero_int">Numero Interior</label>
                <input type="text" name="numero_int" onkeypress="return justNumbers(event)" value="{{ $arrendatario->numero_int }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Numero Interior...">
            </div>
            <div class="form-group">
                <label for="colonia">Colonia</label>
                <input type="text" name="colonia" value="{{ $arrendatario->colonia }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Colonia..." required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" name="estado" value="{{ $arrendatario->estado }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Estado..." required>
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad</label>
                <input type="text" name="ciudad" value="{{ $arrendatario->ciudad }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Ciudad..." required>
            </div>
            <div class="form-group">
                <label for="codigo_postal">Codigo Postal</label>
                <input type="number" name="codigo_postal" value="{{ $arrendatario->codigo_postal }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Codigo Postal..." required>
            </div>
            <div class="form-group">
                <label for="entre_calles">Entre Calles</label>
                <input type="text" name="entre_calles" value="{{ $arrendatario->entre_calles }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Entre Calles...">
            </div>

            <div class="form-group">
                <h4><strong>Direccion de Trabajo</strong></h4>
            </div>
            <div class="form-group">
                <label for="calle_trabajo">Calle</label>
                <input type="text" name="calle_trabajo" value="{{ $arrendatario->calle_trabajo }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Calle..." required>
            </div>
            <div class="form-group">
                <label for="numero_ext_trabajo">Numero Exterior</label>
                <input type="text" name="numero_ext_trabajo" onkeypress="return justNumbers(event)" value="{{ $arrendatario->numero_ext_trabajo }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Numero Exterior..." required>
            </div>
            <div class="form-group">
                <label for="numero_int_trabajo">Numero Interior</label>
                <input type="text" name="numero_int_trabajo" onkeypress="return justNumbers(event)" value="{{ $arrendatario->numero_int_trabajo }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Numero Interior...">
            </div>
            <div class="form-group">
                <label for="colonia_trabajo">Colonia</label>
                <input type="text" name="colonia_trabajo" value="{{ $arrendatario->colonia_trabajo }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Colonia..." required>
            </div>
            <div class="form-group">
                <label for="estado_trabajo">Estado</label>
                <input type="text" name="estado_trabajo" value="{{ $arrendatario->estado_trabajo }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Estado..." required>
            </div>
            <div class="form-group">
                <label for="ciudad_trabajo">Ciudad</label>
                <input type="text" name="ciudad_trabajo" value="{{ $arrendatario->ciudad_trabajo }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Ciudad..." required>
            </div>
            <div class="form-group">
                <label for="codigo_postal_trabajo">Codigo Postal</label>
                <input type="number" name="codigo_postal_trabajo" value="{{ $arrendatario->codigo_postal_trabajo }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Codigo Postal..." required>
            </div>
            <div class="form-group">
                <label for="entre_calles_trabajo">Entre Calles</label>
                <input type="text" name="entre_calles_trabajo" value="{{ $arrendatario->entre_calles_trabajo }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Entre Calles...">
            </div>

            <div class="form-group">
                <label for="puesto">Puesto</label>
                <input type="text" name="puesto" class="form-control" value="{{ $arrendatario->puesto }}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Puesto..." required>
            </div>

            <div class="form-group">
                <h4><strong>Fiador</strong></h4>
            </div>
            <div class="form-group">
                <label for="nombre_fiador">Nombre</label>
                <input type="text" name="nombre_fiador" class="form-control" value="{{$fiador->nombre}}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Nombre..." required>
            </div>
            <div class="form-group">
                <label for="apellido_paterno_fiador">Apellido Paterno</label>
                <input type="text" name="apellido_paterno_fiador" class="form-control" value="{{$fiador->apellido_paterno}}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Apellido Paterno..." required>
            </div>
            <div class="form-group">
                <label for="apellido_materno_fiador">Apellido Materno</label>
                <input type="text" name="apellido_materno_fiador" class="form-control" value="{{$fiador->apellido_materno}}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Apellido Materno..." required>
            </div>
            <div class="form-group">
                <label for="telefono_fiador">Telefono &nbsp;&nbsp;<a data-target="#modal-add-telefonofiador" data-toggle="modal"><button class="btn-sm btn-success">Añadir</button></a></label><br>
                <div id="list">
                    @foreach($telf as $tf)
                        @if(count($tel) > 1)
                            <input type="text" data-mask="(000) 000 0000" id="masc-tel" onkeypress="return justNumbers(event)" class="mascara" name="telefonoid{{$tf->id_telefono}}" value="{{$tf->telefono}}" placeholder="Telefono..." required>&nbsp;<input id="desc" type="text" value="{{$tf->descripcion}}" name="descripcionid{{$tf->id_telefono}}" placeholder="Descripcion..." required>&nbsp;<a data-target="#modal-eliminar-telefonofiador{{$tf->id_telefono}}" data-toggle="modal"><button type="button" style="margin-bottom: 4px" class="btn btn-danger btn-sm">-</button></a><br>
                        @else
                            <input type="text" data-mask="(000) 000 0000" id="masc-tel" onkeypress="return justNumbers(event)" class="mascara" name="telefonoid{{$tf->id_telefono}}" value="{{$tf->telefono}}" placeholder="Telefono..." required>&nbsp;<input id="desc" type="text" value="{{$tf->descripcion}}" name="descripcionid{{$tf->id_telefono}}" placeholder="Descripcion..." required>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <h4><strong>Domicilio Fiador</strong></h4>
            </div>
            <div class="form-group">
                <label for="calle_fiador">Calle</label>
                <input type="text" name="calle_fiador" class="form-control" value="{{$fiador->calle}}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Calle..." required>
            </div>
            <div class="form-group">
                <label for="numero_ext_fiador">Numero Exterior</label>
                <input type="text" name="numero_ext_fiador" class="form-control" onkeypress="return justNumbers(event)" value="{{$fiador->numero_ext}}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Numero Exterior..." required>
            </div>
            <div class="form-group">
                <label for="numero_int_fiador">Numero Interior</label>
                <input type="text" name="numero_int_fiador" class="form-control" onkeypress="return justNumbers(event)" value="{{$fiador->numero_int}}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Numero Interior...">
            </div>
            <div class="form-group">
                <label for="colonia_fiador">Colonia</label>
                <input type="text" name="colonia_fiador" class="form-control" value="{{$fiador->colonia}}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Colonia..." required>
            </div>
            <div class="form-group">
                <label for="estado_fiador">Estado</label>
                <input type="text" name="estado_fiador" class="form-control" value="{{$fiador->estado}}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Estado..." required>
            </div>
            <div class="form-group">
                <label for="ciudad_fiador">Ciudad</label>
                <input type="text" name="ciudad_fiador" class="form-control" value="{{$fiador->ciudad}}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Ciudad..." required>
            </div>
            <div class="form-group">
                <label for="codigo_postal_fiador">Codigo Postal</label>
                <input type="number" name="codigo_postal_fiador" class="form-control" value="{{$fiador->codigo_postal}}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Codigo Postal..." required>
            </div>
            <div class="form-group">
                <label for="entre_calles_fiador">Entre Calles</label>
                <input type="text" name="entre_calles_fiador" class="form-control" value="{{$fiador->entre_calles}}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Entre Calles...">
            </div>

            <div class="form-group">
                <h4><strong>Direccion de Trabajo Fiador</strong></h4>
            </div>
            <div class="form-group">
                <label for="calle_fiador_trabajo">Calle</label>
                <input type="text" name="calle_fiador_trabajo" value="{{$fiador->calle_trabajo}}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Calle..." required>
            </div>
            <div class="form-group">
                <label for="numero_ext_fiador_trabajo">Numero Exterior</label>
                <input type="text" name="numero_ext_fiador_trabajo" onkeypress="return justNumbers(event)" value="{{$fiador->numero_ext_trabajo}}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Numero Exterior..." required>
            </div>
            <div class="form-group">
                <label for="numero_int_fiador_trabajo">Numero Interior</label>
                <input type="text" name="numero_int_fiador_trabajo" onkeypress="return justNumbers(event)" value="{{$fiador->numero_int_trabajo}}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Numero Interior...">
            </div>
            <div class="form-group">
                <label for="colonia_fiador_trabajo">Colonia</label>
                <input type="text" name="colonia_fiador_trabajo" value="{{$fiador->colonia_trabajo}}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Colonia..." required>
            </div>
            <div class="form-group">
                <label for="estado_fiador_trabajo">Estado</label>
                <input type="text" name="estado_fiador_trabajo" value="{{$fiador->estado_trabajo}}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Estado..." required>
            </div>
            <div class="form-group">
                <label for="ciudad_fiador_trabajo">Ciudad</label>
                <input type="text" name="ciudad_fiador_trabajo" value="{{$fiador->ciudad_trabajo}}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Ciudad..." required>
            </div>
            <div class="form-group">
                <label for="codigo_postal_fiador_trabajo">Codigo Postal</label>
                <input type="number" name="codigo_postal_fiador_trabajo" value="{{$fiador->codigo_postal_trabajo}}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Codigo Postal..." required>
            </div>
            <div class="form-group">
                <label for="entre_calles_fiador_trabajo">Entre Calles</label>
                <input type="text" name="entre_calles_fiador_trabajo" value="{{$fiador->entre_calles_trabajo}}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Entre Calles...">
            </div>



            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="../">Cancelar</a>
            </div>

            {!! Form::close() !!}
            @include('catalogos.arrendatario.modal-añadir')
            @include('catalogos.arrendatario.modal-eliminar')

        </div>
    </div>

@endsection
