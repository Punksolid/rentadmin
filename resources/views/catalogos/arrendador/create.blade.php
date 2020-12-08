@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-12">
            <h3>Nuevo Arrendador</h3>
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {!! Form::open(array('url' => 'catalogos/arrendador', 'method' => 'POST', 'autocomplete' => 'off')) !!}
            {{Form::token()}}
            <div class="formulario-tres">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="Nombre..." required>
            </div>
            <div class="formulario-tres">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="Apellido Paterno..." required>
            </div>
            <div class="formulario-tres">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="Apellido Materno..." required>
            </div>
            <hr>

            <!-- Direccion Arrendador -->
            <div class="form-group">
                <h4><strong>Domicilio</strong></h4>
            </div>
            <div class="formulario-tres">
                <label for="calle">Calle</label>
                <input type="text" name="calle" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="Calle..." required>
            </div>
            <div class="formulario-tres">
                <label for="numero_ext">Numero Exterior</label>
                <input type="text" name="numero_ext" onkeypress="return justNumbers(event)" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="Numero Exterior..." required>
            </div>
            <div class="formulario-tres">
                <label for="numero_int">Numero Interior</label>
                <input type="text" name="numero_int" onkeypress="return justNumbers(event)" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Numero Interior...">
            </div>
            <div class="formulario-tres">
                <label for="colonia">Colonia</label>
                <input type="text" name="colonia" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Colonia..." required>
            </div>
            <div class="formulario-tres">
                <label for="estado">Estado</label>
                <input type="text" name="estado" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Estado..." required>
            </div>
            <div class="formulario-tres">
                <label for="ciudad">Ciudad</label>
                <input type="text" name="ciudad" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Ciudad..." required>
            </div>
            <div class="formulario-tres">
                <label for="codigo_postal">Codigo Postal</label>
                <input type="number" name="codigo_postal" class="form-control" placeholder="Codigo Postal..." required>
            </div>
            <div class="formulario-tres">
                <label for="entre_calles">Entre Calles</label>
                <input type="text" name="entre_calles" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="Entre Calles...">
            </div>
            <hr>
            <div class="formulario-dos">
                <label for="telefono">Telefono &nbsp;&nbsp;<button id="add_field" class="btn-sm btn-success">Añadir</button></label><br>
                <div id="listas">
                    <div class="formulario-dos" style="display: inline-flex">
                        <input id="masc-tel" type="text" data-mask="(000) 000 0000" name="telefono1" onkeypress="return justNumbers(event)" placeholder="Telefono..." class="form-control" required>&nbsp;<input id="desc" class="form-control" type="text" name="descripcion1" placeholder="Descripcion..." required>
                    </div>
                    <br>
                </div>
            </div>
            <div class="formulario-dos">
                <label for="email">Correo Electronico &nbsp;&nbsp;<button id="add_f" class="btn-sm btn-success">Añadir</button></label><br>
                <div id="lista">
                    <div class="formulario-tres" style="display: inline-flex">
                        <input type="email" name="email1" class="form-control" placeholder="Correo Electronico..." required>
                    </div>
                    <br>
                </div>
            </div>
            <hr>

            <!-- Direccion de Facturacion -->
            <div class="form-group">
                <h4><strong>Direccion de Facturación</strong>&nbsp; <input type="checkbox" checked onclick="document.getElementById('facturacion-check').hidden=!this.checked; checknull(this.checked)"></h4>
            </div>
            <div id="facturacion-check">
                <div class="formulario-tres">
                    <label for="calle_facturacion">Calle</label>
                    <input type="text" name="calle_facturacion" onkeyup="this.value = this.value.toUpperCase();" class="form-control factura-check" placeholder="Calle...">
                </div>
                <div class="formulario-tres">
                    <label for="numero_ext_facturacion">Numero Exterior</label>
                    <input type="text" name="numero_ext_facturacion" onkeypress="return justNumbers(event)" onkeyup="this.value = this.value.toUpperCase();" class="form-control factura-check" placeholder="Numero Exterior...">
                </div>
                <div class="formulario-tres">
                    <label for="numero_int_facturacion">Numero Interior</label>
                    <input type="text" name="numero_int_facturacion" onkeypress="return justNumbers(event)" onkeyup="this.value = this.value.toUpperCase();" class="form-control factura-check" placeholder="Numero Interior...">
                </div>
                <div class="formulario-tres">
                    <label for="colonia_facturacion">Colonia</label>
                    <input type="text" name="colonia_facturacion" onkeyup="this.value = this.value.toUpperCase();" class="form-control factura-check" placeholder="Colonia...">
                </div>
                <div class="formulario-tres">
                    <label for="estado_facturacion">Estado</label>
                    <input type="text" name="estado_facturacion" onkeyup="this.value = this.value.toUpperCase();" class="form-control factura-check" placeholder="Estado...">
                </div>
                <div class="formulario-tres">
                    <label for="ciudad_facturacion">Ciudad</label>
                    <input type="text" name="ciudad_facturacion" onkeyup="this.value = this.value.toUpperCase();" class="form-control factura-check" placeholder="Ciudad...">
                </div>
                <div class="formulario-tres">
                    <label for="codigo_postal_facturacion">Codigo Postal</label>
                    <input type="number" name="codigo_postal_facturacion" class="form-control factura-check" placeholder="Codigo Postal...">
                </div>
                <div class="formulario-tres">
                    <label for="entre_calles_facturacion">Entre Calles</label>
                    <input type="text" name="entre_calles_facturacion" onkeyup="this.value = this.value.toUpperCase();" class="form-control factura-check" placeholder="Entre Calles...">
                </div>
            </div>
            <div class="formulario-dos">
                <label for="rfc">RFC</label>
                <input type="text" name="rfc" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="RFC..." required><br>
            </div>
            <hr>

            <div class="form-group">
                <label for="banco">Datos Bancarios &nbsp;&nbsp; <input id="bancocheck" checked type="checkbox"> &nbsp;&nbsp;<button id="add_banco" class="btn-sm btn-success">Añadir</button></label><br>
                <div id="datosbanco">
                    <div id="banc" class="formulario-dos">
                        <div id="basebanco" class="form-group" style="display: inline-flex; align-items: baseline">
                            <input class="form-control" style="margin-bottom: 4px" type="text" name="banco1" onkeyup="this.value = this.value.toUpperCase();" placeholder="Banco..." required>&nbsp;
                            <input class="form-control" id="cc" type="text" onkeypress="return justNumbers(event)" name="cuenta1" placeholder="Cuenta..." required>&nbsp;
                            <input class="form-control" id="cc" type="text" maxlength="16" onkeypress="return justNumbers(event);" name="clabe1" placeholder="Clabe..." required>&nbsp;
                            <input class="form-control" id="cc" type="text" name="nombre_titular1" onkeyup="this.value = this.value.toUpperCase();" placeholder="Nombre del Titular..." required>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="formulario-dos">
                <label for="admon">Admon</label>
                <input type="text" name="admon" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Admon..." required>
            </div>
            <hr>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="./">Cancelar</a>
            </div>

            {!! Form::close() !!}

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
            var htmltag = $('#basebanco');
            document.getElementById('datosbanco').hidden=!this.checked;
            document.getElementById('add_banco').hidden=!this.checked;
            $('#banc').empty();
            $('#banc').append(htmltag);
        })
    </script>

@endsection
