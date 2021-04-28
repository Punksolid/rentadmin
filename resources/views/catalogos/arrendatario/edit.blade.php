@extends ('layouts.layout-v2')
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
            {!! Form::model($arrendatario, [
                'method' => 'PATCH',
                'files' => true,
                'route' => ['arrendatario.update', $arrendatario->id],
                 'class' => ''
                ]) !!}
            {{Form::token()}}
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{$arrendatario->nombre}}" style="text-transform:uppercase" placeholder="Nombre..." required>
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" class="form-control" style="text-transform:uppercase" value="{{ $arrendatario->apellido_paterno }}" placeholder="Apellido Paterno..." required>
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" class="form-control" style="text-transform:uppercase" value="{{ $arrendatario->apellido_materno }}" placeholder="Apellido Materno..." required>
            </div>

            <div class="form-group">
            @include('partials.phones', ['phones' => $lessee->phones, 'type' => \App\Models\Lessee::class, 'id' => $lessee->id])
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
                <label for="identity">Documento de Identidad</label>
                <div id="identity">
                    @if (! $lessee->hasMedia())
                        <div id="app">
                            <input type="file" name="identity" @change="onFileChange"/>
                            <div id="preview">
                                <img width="400" height="250" v-if="url" :src="url"/>
                            </div>
                        </div>
                    @endif

                    @if ($lessee->hasMedia())
                            <input type="file" name="identity">
                        <img src="{{ $lessee->getFirstMediaUrl() }}" alt="..." class="img-thumbnail" style="width: 200px; height: 200px;">
                        <a class="btn-sm btn-danger" href="{{ route('arrendatario.image.destroy', ['lessee' => $lessee->id]) }}">Eliminar Imagen</a>
                    @endif

                </div>
            </div>
            <div class="form-group">
                <h4><strong>Domicilio</strong></h4>
            </div>
            <div class="form-group">
                <label for="calle">Calle</label>
                <input type="text" name="calle" value="{{ $arrendatario->calle }}" style="text-transform:uppercase" class="form-control" placeholder="Calle..." required>
            </div>
            <div class="form-group">
                <label for="numero_ext">Numero Exterior</label>
                <input type="text" name="numero_ext" onkeypress="return justNumbers(event)" value="{{ $arrendatario->numero_ext }}" style="text-transform:uppercase" class="form-control" placeholder="Numero Exterior..." required>
            </div>
            <div class="form-group">
                <label for="numero_int">Numero Interior</label>
                <input type="text" name="numero_int" onkeypress="return justNumbers(event)" value="{{ $arrendatario->numero_int }}" style="text-transform:uppercase" class="form-control" placeholder="Numero Interior...">
            </div>
            <div class="form-group">
                <label for="colonia">Colonia</label>
                <input type="text" name="colonia" value="{{ $arrendatario->colonia }}" style="text-transform:uppercase" class="form-control" placeholder="Colonia..." required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" name="estado" value="{{ $arrendatario->estado }}" style="text-transform:uppercase" class="form-control" placeholder="Estado..." required>
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad</label>
                <input type="text" name="ciudad" value="{{ $arrendatario->ciudad }}" style="text-transform:uppercase" class="form-control" placeholder="Ciudad..." required>
            </div>
            <div class="form-group">
                <label for="codigo_postal">Codigo Postal</label>
                <input type="number" name="codigo_postal" value="{{ $arrendatario->codigo_postal }}" style="text-transform:uppercase" class="form-control" placeholder="Codigo Postal..." required>
            </div>
            <div class="form-group">
                <label for="entre_calles">Entre Calles</label>
                <input type="text" name="entre_calles" value="{{ $arrendatario->entre_calles }}" style="text-transform:uppercase" class="form-control" placeholder="Entre Calles...">
            </div>

            <div class="form-group">
                <h4><strong>Direccion de Trabajo</strong></h4>
            </div>
            <div class="form-group">
                <label for="calle_trabajo">Calle</label>
                <input type="text" name="calle_trabajo" value="{{ $arrendatario->calle_trabajo }}" style="text-transform:uppercase" class="form-control" placeholder="Calle..." required>
            </div>
            <div class="form-group">
                <label for="numero_ext_trabajo">Numero Exterior</label>
                <input type="text" name="numero_ext_trabajo" onkeypress="return justNumbers(event)" value="{{ $arrendatario->numero_ext_trabajo }}" style="text-transform:uppercase" class="form-control" placeholder="Numero Exterior..." required>
            </div>
            <div class="form-group">
                <label for="numero_int_trabajo">Numero Interior</label>
                <input type="text" name="numero_int_trabajo" onkeypress="return justNumbers(event)" value="{{ $arrendatario->numero_int_trabajo }}" style="text-transform:uppercase" class="form-control" placeholder="Numero Interior...">
            </div>
            <div class="form-group">
                <label for="colonia_trabajo">Colonia</label>
                <input type="text" name="colonia_trabajo" value="{{ $arrendatario->colonia_trabajo }}" style="text-transform:uppercase" class="form-control" placeholder="Colonia..." required>
            </div>
            <div class="form-group">
                <label for="estado_trabajo">Estado</label>
                <input type="text" name="estado_trabajo" value="{{ $arrendatario->estado_trabajo }}" style="text-transform:uppercase" class="form-control" placeholder="Estado..." required>
            </div>
            <div class="form-group">
                <label for="ciudad_trabajo">Ciudad</label>
                <input type="text" name="ciudad_trabajo" value="{{ $arrendatario->ciudad_trabajo }}" style="text-transform:uppercase" class="form-control" placeholder="Ciudad..." required>
            </div>
            <div class="form-group">
                <label for="codigo_postal_trabajo">Codigo Postal</label>
                <input type="number" name="codigo_postal_trabajo" value="{{ $arrendatario->codigo_postal_trabajo }}" style="text-transform:uppercase" class="form-control" placeholder="Codigo Postal..." required>
            </div>
            <div class="form-group">
                <label for="entre_calles_trabajo">Entre Calles</label>
                <input type="text" name="entre_calles_trabajo" value="{{ $arrendatario->entre_calles_trabajo }}" style="text-transform:uppercase" class="form-control" placeholder="Entre Calles...">
            </div>

            <div class="form-group">
                <label for="puesto">Puesto</label>
                <input type="text" name="puesto" class="form-control" value="{{ $arrendatario->puesto }}" style="text-transform:uppercase" placeholder="Puesto..." required>
            </div>

            <div class="form-group">
                <h4><strong>Fiador</strong><input type="checkbox" name="guarantor_block" checked onclick="document.getElementById('guarantor-block').hidden=!this.checked; checknull(this.checked)"></h4>
            </div>
            <div id="guarantor-block">
                <div class="form-group">
                    <label for="guarantor[nombre]">Nombre</label>
                    <input type="text" name="guarantor[nombre]" class="form-control" value="{{ optional($fiador)->nombre}}" style="text-transform:uppercase" placeholder="Nombre..." >
                </div>
                <div class="form-group">
                    <label for="guarantor[apellido_paterno]">Apellido Paterno</label>
                    <input type="text" name="guarantor[apellido_paterno]" class="form-control" value="{{ optional($fiador)->apellido_paterno}}" style="text-transform:uppercase" placeholder="Apellido Paterno..." >
                </div>
                <div class="form-group">
                    <label for="guarantor[apellido_materno]">Apellido Materno</label>
                    <input type="text" name="guarantor[apellido_materno]" class="form-control" value="{{ optional($fiador)->apellido_materno}}" style="text-transform:uppercase" placeholder="Apellido Materno..." >
                </div>
                <div class="form-group">
                    <label for="identity">Foto</label>
                    <div id="appFiador">
                        {{--                        <input type="file" name="identity" @change="onFileChange"/>--}}
                        <input type="file" name="guarantor[identity]" @change="onFileChangeFiador" class="form-control">

                        <div id="preview">
                            <img width="400" height="250" v-if="url" :src="url"/>
                        </div>
                    </div>
                    {{-- Usar ingles @todo refactorizar @Punksolid --}}
                    @if ($arrendatario->guarantor && $fiador->hasMedia())


                        <img src="{{ $fiador->getFirstMediaUrl() }}" alt="..." class="img-thumbnail" style="width: 200px; height: 200px;">
                        <a class="btn-sm btn-danger" href="{{ route('guarantor.image.destroy', ['guarantor' => $guarantor->id_cat_fiadores]) }}">Eliminar Imagen</a>

                    @endif
                </div>
                <div class="form-group">
                       @include('partials.phones', ['type' => \App\Models\CatFiador::class,'id' =>  optional($fiador)->id_cat_fiadores, 'phones' =>  optional($fiador)->phones ?? []])
                </div>

                <div class="form-group">
                    <h4><strong>Domicilio Fiador</strong></h4>
                </div>
                <div class="form-group">
                    <label for="guarantor[calle]">Calle</label>
                    <input type="text" name="guarantor[calle]" class="form-control" value="{{ optional($fiador)->calle}}" style="text-transform:uppercase" placeholder="Calle..." >
                </div>
                <div class="form-group">
                    <label for="guarantor[numero_ext]">Numero Exterior</label>
                    <input type="text" name="guarantor[numero_ext]" class="form-control" onkeypress="return justNumbers(event)" value="{{ optional($fiador)->numero_ext}}" style="text-transform:uppercase" placeholder="Numero Exterior..." >
                </div>
                <div class="form-group">
                    <label for="guarantor[numero_int]">Numero Interior</label>
                    <input type="text" name="guarantor[numero_int]" class="form-control" onkeypress="return justNumbers(event)" value="{{ optional($fiador)->numero_int}}" style="text-transform:uppercase" placeholder="Numero Interior...">
                </div>
                <div class="form-group">
                    <label for="guarantor[colonia]">Colonia</label>
                    <input type="text" name="guarantor[colonia]" class="form-control" value="{{ optional($fiador)->colonia}}" style="text-transform:uppercase" placeholder="Colonia..." >
                </div>
                <div class="form-group">
                    <label for="guarantor[estado]">Estado</label>
                    <input type="text" name="guarantor[estado]" class="form-control" value="{{ optional($fiador)->estado}}" style="text-transform:uppercase" placeholder="Estado..." >
                </div>
                <div class="form-group">
                    <label for="guarantor[ciudad]">Ciudad</label>
                    <input type="text" name="guarantor[ciudad]" class="form-control" value="{{ optional($fiador)->ciudad}}" style="text-transform:uppercase" placeholder="Ciudad..." >
                </div>
                <div class="form-group">
                    <label for="guarantor[codigo_postal]">Codigo Postal</label>
                    <input type="number" name="guarantor[codigo_postal]" class="form-control" value="{{ optional($fiador)->codigo_postal}}" style="text-transform:uppercase" placeholder="Codigo Postal..." >
                </div>
                <div class="form-group">
                    <label for="guarantor[entre_calles]">Entre Calles</label>
                    <input type="text" name="guarantor[entre_calles]" class="form-control" value="{{ optional($fiador)->entre_calles}}" style="text-transform:uppercase" placeholder="Entre Calles...">
                </div>

                <div class="form-group">
                    <h4><strong>Direccion de Trabajo Fiador</strong></h4>
                </div>
                <div class="form-group">
                    <label for="guarantor[calle_trabajo]">Calle</label>
                    <input type="text" name="guarantor[calle_trabajo]" value="{{ optional($fiador)->calle_trabajo}}" style="text-transform:uppercase" class="form-control" placeholder="Calle..." >
                </div>
                <div class="form-group">
                    <label for="guarantor[numero_ext_trabajo]">Numero Exterior</label>
                    <input type="text" name="guarantor[numero_ext_trabajo]" onkeypress="return justNumbers(event)" value="{{ optional($fiador)->numero_ext_trabajo}}" style="text-transform:uppercase" class="form-control" placeholder="Numero Exterior..." >
                </div>
                <div class="form-group">
                    <label for="guarantor[numero_int_trabajo]">Numero Interior</label>
                    <input type="text" name="guarantor[numero_int_trabajo]" onkeypress="return justNumbers(event)" value="{{ optional($fiador)->numero_int_trabajo}}" style="text-transform:uppercase" class="form-control" placeholder="Numero Interior...">
                </div>
                <div class="form-group">
                    <label for="guarantor[colonia_trabajo]">Colonia</label>
                    <input type="text" name="guarantor[colonia_trabajo]" value="{{ optional($fiador)->colonia_trabajo}}" style="text-transform:uppercase" class="form-control" placeholder="Colonia..." >
                </div>
                <div class="form-group">
                    <label for="guarantor[estado_trabajo]">Estado</label>
                    <input type="text" name="guarantor[estado_trabajo]" value="{{ optional($fiador)->estado_trabajo}}" style="text-transform:uppercase" class="form-control" placeholder="Estado..." >
                </div>
                <div class="form-group">
                    <label for="guarantor[ciudad_trabajo]">Ciudad</label>
                    <input type="text" name="guarantor[ciudad_trabajo]" value="{{ optional($fiador)->ciudad_trabajo}}" style="text-transform:uppercase" class="form-control" placeholder="Ciudad..." >
                </div>
                <div class="form-group">
                    <label for="guarantor[codigo_postal_trabajo]">Codigo Postal</label>
                    <input type="number" name="guarantor[codigo_postal_trabajo]" value="{{ optional($guarantor)->codigo_postal_trabajo}}" style="text-transform:uppercase" class="form-control" placeholder="Codigo Postal..." >
                </div>
                <div class="form-group">
                    <label for="guarantor[entre_calles_trabajo]">Entre Calles</label>
                    <input type="text" name="guarantor[entre_calles_trabajo]" value="{{ optional($fiador)->entre_calles_trabajo}}" style="text-transform:uppercase" class="form-control" placeholder="Entre Calles...">
                </div>
            </div>


            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="../">Cancelar</a>
            </div>

            {!! Form::close() !!}
            @include('catalogos.arrendatario.add-modal')
{{--            @include('catalogos.arrendatario.modal-eliminar')--}}



    </div>


@endsection
@section('javascript')
    const vm = new Vue({
        el: '#app',
    data() {
    return {
    url: null,
    }
    },
    methods: {
    onFileChange(e) {
    const file = e.target.files[0];
    this.url = URL.createObjectURL(file);
    }
    }
    })
    const vmFiador = new Vue({
    el: '#appFiador',
    data() {
    return {
    url: null,
    }
    },
    methods: {
    onFileChangeFiador(e) {
    const file = e.target.files[0];
    this.url = URL.createObjectURL(file);
    }
    }
    })
@endsection
