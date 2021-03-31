@extends ('layouts.layout-v2')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Arrendatario</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open(array('url' => 'catalogos/arrendatario', 'method' => 'POST', 'autocomplete' => 'off', 'files' => true)) !!}
            {{Form::token()}}
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" onkeyup="this.value = this.value.toUpperCase();"
                       placeholder="Nombre..." required>
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" class="form-control"
                       onkeyup="this.value = this.value.toUpperCase();" placeholder="Apellido Paterno..." required>
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" class="form-control"
                       onkeyup="this.value = this.value.toUpperCase();" placeholder="Apellido Materno..." required>
            </div>
            <div class="form-group">
                <label for="telefono">Telefono &nbsp;&nbsp;<button id="add_field" class="btn-sm btn-success">Añadir
                    </button>
                </label><br>
                <div id="listas">
                    <input type="text" id="masc-tel" data-mask="(000) 000 0000" name="phone_number[0][telefono]"
                           class="mascara" onkeypress="return justNumbers(event)" placeholder="Telefono...">&nbsp;<input
                        id="desc" type="text" name="phone_number[0][descripcion]" placeholder="Descripcion...">
                </div>
            </div>
            <div class="form-group">
                <label for="email">Correo Electronico &nbsp;&nbsp;<button id="add_f" class="btn-sm btn-success">Añadir
                    </button>
                </label><br>
                <div id="lista">
                    <input type="email" name="email[]" placeholder="Correo Electronico..." required>
                </div>
            </div>
            <div class="form-group">
                <label for="identity">Documento de Identidad</label>
                <div id="app">
                    <input type="file" name="identity" @change="onFileChange"/>
                    <div id="preview">
                        <img width="400" height="250" v-if="url" :src="url"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h4><strong>Domicilio</strong></h4>
            </div>
            <div class="form-group">
                <label for="calle">Calle</label>
                <input type="text" name="calle" class="form-control" onkeyup="this.value = this.value.toUpperCase();"
                       placeholder="Calle..." required>
            </div>
            <div class="form-group">
                <label for="numero_ext">Numero Exterior</label>
                <input type="text" name="numero_ext" onkeypress="return justNumbers(event)"
                       onkeyup="this.value = this.value.toUpperCase();" class="form-control"
                       placeholder="Numero Exterior..." required>
            </div>
            <div class="form-group">
                <label for="numero_int">Numero Interior</label>
                <input type="text" name="numero_int" onkeyup="this.value = this.value.toUpperCase();"
                       class="form-control" placeholder="Numero Interior...">
            </div>
            <div class="form-group">
                <label for="colonia">Colonia</label>
                <input type="text" name="colonia" onkeyup="this.value = this.value.toUpperCase();" class="form-control"
                       placeholder="Colonia..." required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" name="estado" onkeyup="this.value = this.value.toUpperCase();" class="form-control"
                       placeholder="Estado..." required>
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad</label>
                <input type="text" name="ciudad" class="form-control" onkeyup="this.value = this.value.toUpperCase();"
                       placeholder="Ciudad..." required>
            </div>
            <div class="form-group">
                <label for="codigo_postal">Codigo Postal</label>
                <input type="number" name="codigo_postal" class="form-control" placeholder="Codigo Postal..." required>
            </div>
            <div class="form-group">
                <label for="entre_calles">Entre Calles</label>
                <input type="text" name="entre_calles" class="form-control"
                       onkeyup="this.value = this.value.toUpperCase();" placeholder="Entre Calles...">
            </div>

            <div class="form-group">
                <h4><strong>Direccion de Trabajo</strong></h4>
            </div>
            <div class="form-group">
                <label for="calle_trabajo">Calle</label>
                <input type="text" name="calle_trabajo" class="form-control"
                       onkeyup="this.value = this.value.toUpperCase();" placeholder="Calle..." required>
            </div>
            <div class="form-group">
                <label for="numero_ext_trabajo">Numero Exterior</label>
                <input type="text" name="numero_ext_trabajo" onkeypress="return justNumbers(event)" class="form-control"
                       onkeyup="this.value = this.value.toUpperCase();" placeholder="Numero Exterior..." required>
            </div>
            <div class="form-group">
                <label for="numero_int_trabajo">Numero Interior</label>
                <input type="text" name="numero_int_trabajo" class="form-control"
                       onkeyup="this.value = this.value.toUpperCase();" placeholder="Numero Interior...">
            </div>
            <div class="form-group">
                <label for="colonia_trabajo">Colonia</label>
                <input type="text" name="colonia_trabajo" class="form-control"
                       onkeyup="this.value = this.value.toUpperCase();" placeholder="Colonia..." required>
            </div>
            <div class="form-group">
                <label for="estado_trabajo">Estado</label>
                <input type="text" name="estado_trabajo" class="form-control"
                       onkeyup="this.value = this.value.toUpperCase();" placeholder="Estado..." required>
            </div>
            <div class="form-group">
                <label for="ciudad_trabajo">Ciudad</label>
                <input type="text" name="ciudad_trabajo" class="form-control"
                       onkeyup="this.value = this.value.toUpperCase();" placeholder="Ciudad..." required>
            </div>
            <div class="form-group">
                <label for="codigo_postal_trabajo">Codigo Postal</label>
                <input type="number" name="codigo_postal_trabajo" class="form-control"
                       onkeyup="this.value = this.value.toUpperCase();" placeholder="Codigo Postal..." required>
            </div>
            <div class="form-group">
                <label for="entre_calles_trabajo">Entre Calles</label>
                <input type="text" name="entre_calles_trabajo" class="form-control"
                       onkeyup="this.value = this.value.toUpperCase();" placeholder="Entre Calles...">
            </div>
            <div class="form-group">
                <label for="puesto">Puesto</label>
                <input type="text" name="puesto" class="form-control" onkeyup="this.value = this.value.toUpperCase();"
                       placeholder="Puesto..." required>
            </div>

            <!--   Espacio   -->


            <!-- Fiador -->
            <div class="form-group">
                <h4><strong>Fiador</strong>
                    <input
                        name="guarantor_block"
                        type="checkbox"
                        checked
                        onclick="document.getElementById('guarantor-block').hidden=!this.checked; checknull(this.checked)"
                    >
                </h4>
            </div>
            <div id="guarantor-block">
                <div class="form-group">
                    <label for="guarantor[nombre]">Nombre</label>
                    <input type="text" name="guarantor[nombre]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Nombre...">
                </div>
                <div class="form-group">
                    <label for="guarantor[apellido_paterno]">Apellido Paterno</label>
                    <input type="text" name="guarantor[apellido_paterno]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Apellido Paterno...">
                </div>
                <div class="form-group">
                    <label for="guarantor[apellido_materno]">Apellido Materno</label>
                    <input type="text" name="guarantor[apellido_materno]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Apellido Materno...">
                </div>
                <div class="form-group">
                    <label for="identity">Identificación</label>
                    <div id="appFiador">
{{--                        <input type="file" name="identity" @change="onFileChange"/>--}}
                        <input type="file" name="guarantor[identity]" @change="onFileChangeFiador" class="form-control">

                        <div id="preview">
                            <img width="400" height="250" v-if="url" :src="url"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="guarantor[telefono]">Telefono &nbsp;&nbsp;<button id="field_add"
                                                                                  class="btn-sm btn-success">Añadir
                        </button>
                    </label><br>
                    <div id="list">
                        <input type="text" id="masc-tel" data-mask="(000) 000 0000" class="mascara"
                               name="guarantor[telefono1]" onkeypress="return justNumbers(event)"
                               placeholder="Telefono...">&nbsp;<input id="desc" type="text"
                                                                      name="guarantor[descripcion1]"
                                                                      placeholder="Descripcion...">
                    </div>
                </div>

                <div class="form-group">
                    <h4><strong>Domicilio Fiador</strong></h4>
                </div>
                <div class="form-group">
                    <label for="guarantor[calle]">Calle</label>
                    <input type="text" name="guarantor[calle]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Calle...">
                </div>
                <div class="form-group">
                    <label for="guarantor[numero_ext]">Numero Exterior</label>
                    <input type="text" name="guarantor[numero_ext]" onkeypress="return justNumbers(event)"
                           class="form-control" onkeyup="this.value = this.value.toUpperCase();"
                           placeholder="Numero Exterior...">
                </div>
                <div class="form-group">
                    <label for="guarantor[numero_int]">Numero Interior</label>
                    <input type="text" name="guarantor[numero_int]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Numero Interior...">
                </div>
                <div class="form-group">
                    <label for="guarantor[colonia]">Colonia</label>
                    <input type="text" name="guarantor[colonia]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Colonia...">
                </div>
                <div class="form-group">
                    <label for="guarantor[estado]">Estado</label>
                    <input type="text" name="guarantor[estado]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Estado...">
                </div>
                <div class="form-group">
                    <label for="guarantor[ciudad]">Ciudad</label>
                    <input type="text" name="guarantor[ciudad]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Ciudad...">
                </div>
                <div class="form-group">
                    <label for="guarantor[codigo_postal]">Codigo Postal</label>
                    <input type="number" name="guarantor[codigo_postal]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Codigo Postal...">
                </div>
                <div class="form-group">
                    <label for="guarantor[entre_calles]">Entre Calles</label>
                    <input type="text" name="guarantor[entre_calles]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Entre Calles...">
                </div>

                <div class="form-group">
                    <h4><strong>Direccion de Trabajo Fiador</strong></h4>
                </div>
                <div class="form-group">
                    <label for="guarantor[calle_trabajo]">Calle</label>
                    <input type="text" name="guarantor[calle_trabajo]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Calle...">
                </div>
                <div class="form-group">
                    <label for="guarantor[numero_ext_trabajo]">Numero Exterior</label>
                    <input type="text" name="guarantor[numero_ext_trabajo]" onkeypress="return justNumbers(event)"
                           class="form-control" onkeyup="this.value = this.value.toUpperCase();"
                           placeholder="Numero Exterior...">
                </div>
                <div class="form-group">
                    <label for="guarantor[numero_int_trabajo]">Numero Interior</label>
                    <input type="text" name="guarantor[numero_int_trabajo]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Numero Interior...">
                </div>
                <div class="form-group">
                    <label for="guarantor[colonia_trabajo]">Colonia</label>
                    <input type="text" name="guarantor[colonia_trabajo]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Colonia...">
                </div>
                <div class="form-group">
                    <label for="guarantor[estado_trabajo]">Estado</label>
                    <input type="text" name="guarantor[estado_trabajo]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Estado...">
                </div>
                <div class="form-group">
                    <label for="guarantor[ciudad_trabajo]">Ciudad</label>
                    <input type="text" name="guarantor[ciudad_trabajo]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Ciudad...">
                </div>
                <div class="form-group">
                    <label for="guarantor[codigo_postal_trabajo]">Codigo Postal</label>
                    <input type="number" name="guarantor[codigo_postal_trabajo]" class="form-control"
                           placeholder="Codigo Postal...">
                </div>
                <div class="form-group">
                    <label for="guarantor[entre_calles_trabajo]">Entre Calles</label>
                    <input type="text" name="guarantor[entre_calles_trabajo]" class="form-control"
                           onkeyup="this.value = this.value.toUpperCase();" placeholder="Entre Calles...">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" id="submit">Guardar</button>
                <a class="btn btn-danger" href="./">Cancelar</a>
            </div>

            {!! Form::close() !!}


        </div>
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
