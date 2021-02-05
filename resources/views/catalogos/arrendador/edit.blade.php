@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-12">
            <h3>Editar Arrendador</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::model($arrendador, ['method' => 'PATCH', 'route' =>['arrendador.update', $arrendador->id]]) !!}
            {{Form::token()}}
            <div class="formulario-tres">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{$arrendador->nombre}}" placeholder="Nombre..." required>
            </div>
            <div class="formulario-tres">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->apellido_paterno }}" placeholder="Apellido Paterno..." required>
            </div>
            <div class="formulario-tres">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->apellido_materno }}" placeholder="Apellido Materno..." required>
            </div>
            <hr>

            <!-- Direccion Arrendador -->
            <div class="form-group">
                <h4><strong>Domicilio</strong></h4>
            </div>
            <div class="formulario-tres">
                <label for="calle">Calle</label>
                <input type="text" name="calle" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->calle }}" placeholder="Calle..." required>
            </div>
            <div class="formulario-tres">
                <label for="numero_ext">Numero Exterior</label>
                <input type="text" name="numero_ext" onkeypress="return justNumbers(event)" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->numero_ext }}" placeholder="Numero Exterior..." required>
            </div>
            <div class="formulario-tres">
                <label for="numero_int">Numero Interior</label>
                <input type="text" name="numero_int" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->numero_int }}" placeholder="Numero Interior...">
            </div>
            <div class="formulario-tres">
                <label for="colonia">Colonia</label>
                <input type="text" name="colonia" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->colonia }}" placeholder="Colonia..." required>
            </div>
            <div class="formulario-tres">
                <label for="estado">Estado</label>
                <input type="text" name="estado" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->estado }}" placeholder="Estado..." required>
            </div>
            <div class="formulario-tres">
                <label for="ciudad">Ciudad</label>
                <input type="text" name="ciudad" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->ciudad }}" placeholder="Ciudad..." required>
            </div>
            <div class="formulario-tres">
                <label for="codigo_postal">Codigo Postal</label>
                <input type="number" name="codigo_postal" class="form-control" value="{{ $arrendador->codigo_postal }}" placeholder="Codigo Postal..." required>
            </div>
            <div class="formulario-tres">
                <label for="entre_calles">Entre Calles</label>
                <input type="text" name="entre_calles" class="form-control" value="{{ $arrendador->entre_calles }}" placeholder="Entre Calles...">
            </div>
            <hr>

            <div class="formulario-dos">
                @include('partials.phones', ['type' => \App\Models\Lessor::class, 'id' =>  $arrendador->id, 'phones' => $phones])
            </div>
            <div class="formulario-dos">
                <label for="email">Correo Electronico &nbsp;&nbsp;<a data-target="#modal-add-email" data-toggle="modal"><button class="btn-sm btn-success">Añadir</button></a></label><br>
                    @foreach($emails as $email)
                    <div id="lista" style="display: inline-flex">
                        @if(count($emails) > 1)
                            <input type="email" name="emailid{{$email->id_email}}" value="{{$email->email}}" class="form-control" placeholder="Correo Electronico..." required>&nbsp;<a data-target="#modal-eliminar-email{{$email->id_email}}" data-toggle="modal"><button type="button" style="margin-bottom: 4px" class="btn btn-danger btn-sm">-</button></a><br>
                        @else
                            <input type="email" name="emailid{{$email->id_email}}" value="{{$email->email}}" class="form-control" placeholder="Correo Electronico..." required><br>
                        @endif
                    </div>
                        <br>
                    @endforeach
            </div>
            <hr>

            <!-- Direccion de Facturacion -->
            <div class="form-group">
                <h4><strong>Direccion de Facturación</strong> &nbsp; <input id="show_invoice" name="show_invoice" type="checkbox" checked onclick="document.getElementById('facturacion-check').hidden=!this.checked; checknull(this.checked)"></h4>
            </div>
            <div id="facturacion-check">
                <div class="formulario-tres">
                    <label for="calle_facturacion">Calle</label>
                    <input type="text" name="calle_facturacion" class="form-control factura-check" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->calle_facturacion }}" placeholder="Calle...">
                </div>
                <div class="formulario-tres">
                    <label for="numero_ext_facturacion">Numero Exterior</label>
                    <input type="text" name="numero_ext_facturacion" onkeypress="return justNumbers(event)" class="form-control factura-check" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->numero_ext_facturacion }}" placeholder="Numero Exterior...">
                </div>
                <div class="formulario-tres">
                    <label for="numero_int_facturacion">Numero Interior</label>
                    <input type="text" name="numero_int_facturacion" onkeypress="return justNumbers(event)" class="form-control factura-check" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->numero_int_facturacion }}" placeholder="Numero Interior...">
                </div>
                <div class="formulario-tres">
                    <label for="colonia_facturacion">Colonia</label>
                    <input type="text" name="colonia_facturacion" class="form-control factura-check" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->colonia_facturacion }}" placeholder="Colonia...">
                </div>
                <div class="formulario-tres">
                    <label for="estado_facturacion">Estado</label>
                    <input type="text" name="estado_facturacion" class="form-control factura-check" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->estado_facturacion }}" placeholder="Estado...">
                </div>
                <div class="formulario-tres">
                    <label for="ciudad_facturacion">Ciudad</label>
                    <input type="text" name="ciudad_facturacion" class="form-control factura-check" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->ciudad_facturacion }}" placeholder="Ciudad...">
                </div>
                <div class="formulario-tres">
                    <label for="codigo_postal_facturacion">Codigo Postal</label>
                    <input type="number" name="codigo_postal_facturacion" class="form-control factura-check" value="{{ $arrendador->codigo_postal_facturacion }}" placeholder="Codigo Postal...">
                </div>
                <div class="formulario-tres">
                    <label for="entre_calles_facturacion">Entre Calles</label>
                    <input type="text" name="entre_calles_facturacion" class="form-control factura-check" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->entre_calles_facturacion }}" placeholder="Entre Calles...">
                </div>
                <div class="formulario-tres">
                    <label for="rfc">RFC</label>
                    <input type="text" name="rfc" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->rfc }}" placeholder="RFC..." >
                </div>
            </div>
            <hr>

            <div class="form-group">
                <label for="banco">Datos Bancarios &nbsp;&nbsp; <input id="bancocheck" checked type="checkbox"> &nbsp;&nbsp;
                    <a id="ad_banco" data-target="#modal-add-banco" data-toggle="modal"><button class="btn-sm btn-success">Añadir</button></a>
                </label>
                <br>
                <div id="datosbanco">
                    @foreach($banco as $bank_account)
                    <div id="banc" class="form-group" style="display: inline-flex; align-items: baseline">
                        @if(count($banco) > 1)
                            <input class="form-control bancoin" style="margin-bottom: 4px" type="text" onkeyup="this.value = this.value.toUpperCase();" name="bancoid{{$bank_account->id_banco}}" value="{{$bank_account->banco}}" placeholder="Banco...">
                            <input class="form-control bancoin" id="cc" type="text" name="cuentaid{{$bank_account->id_banco}}" value="{{ $bank_account->cuenta }}" placeholder="Cuenta...">
                            <input class="form-control  bancoin" id="cc" type="text" onkeypress="return justNumbers(event)" name="clabeid{{$bank_account->id_banco}}" value="{{$bank_account->clabe}}" placeholder="Clabe...">
                            <input class="form-control  bancoin" id="cc" type="text" name="nombre_titularid{{$bank_account->id_banco}}" onkeyup="this.value = this.value.toUpperCase();" value="{{$bank_account->nombre_titular}}" placeholder="Nombre del Titular...">&nbsp;<a data-target="#modal-eliminar-banco{{$bank_account->id_banco}}" data-toggle="modal"><button type="button" style="margin-bottom: 4px" class="btn btn-danger btn-sm">-</button></a>
                        @else
                            <input class="form-control  bancoin" style="margin-bottom: 4px" type="text" onkeyup="this.value = this.value.toUpperCase();" name="bancoid{{$bank_account->id_banco}}" value="{{$bank_account->banco}}" placeholder="Banco...">
                            <input class="form-control  bancoin" id="cc" type="text" name="cuentaid{{$bank_account->id_banco}}" value="{{$bank_account->cuenta}}" placeholder="Cuenta...">
                            <input class="form-control  bancoin" id="cc" type="text" onkeypress="return justNumbers(event)" name="clabeid{{$bank_account->id_banco}}" value="{{$bank_account->clabe}}" placeholder="Clabe...">
                            <input class="form-control  bancoin" id="cc" type="text" name="nombre_titularid{{$bank_account->id_banco}}" onkeyup="this.value = this.value.toUpperCase();" value="{{$bank_account->nombre_titular}}" placeholder="Nombre del Titular...">
                        @endif
                    </div>
                        <br>
                    @endforeach
                </div>
            </div>
            <hr>

            <div class="formulario-dos">
                <label for="admon">Admon</label>
                <input type="text" name="admon" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="{{ $arrendador->admon }}" placeholder="Admon..." required>
            </div>
            <hr>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="../">Cancelar</a>
            </div>

            {!! Form::close() !!}
            @include('catalogos.arrendador.modal-add-to-arrendador')
            @include('catalogos.arrendador.modal-eliminar')

        </div>
    </div>

    <script>
        function checknull(check) {
            if (check){
                var factura = document.getElementsByClassName('factura-check');
                $.each(factura, function (index, c) {
                    c.value = null;
                })
            }
        }
        $('#bancocheck').click(function () {
            var bancoin = document.getElementsByClassName('bancoin');
            document.getElementById('datosbanco').hidden=!this.checked;
            document.getElementById('ad_banco').hidden=!this.checked;
            $.each(bancoin, function (index, ban) {
                ban.value = null;
            })
        })
    </script>
@endsection
