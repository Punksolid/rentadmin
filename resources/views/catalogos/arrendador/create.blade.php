@extends ('layouts.layout-v2')
@section ('contenido')
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

    {!! Form::open([
'url' => 'catalogos/arrendador',
'method' => 'POST',
'autocomplete' => 'off',
]) !!}
    {{Form::token()}}
    <div class="form-group">
        <label for="nombre">Nombre: </label>
        <input class="form-control" name="nombre" style="text-transform:uppercase"
               placeholder="Nombre..." required type="text">
    </div>
    <div class="form-group">
        <label for="apellido_paterno">Apellido Paterno: </label>
        <input type="text" name="apellido_paterno" class="form-control"
               style="text-transform:uppercase" placeholder="Apellido Paterno..." required>
    </div>
    <div class="form-group">
        <label for="apellido_materno">Apellido Materno: </label>
        <input type="text" name="apellido_materno" class="form-control"
               style="text-transform:uppercase" placeholder="Apellido Materno..." required>
    </div>
    <hr>

    <!-- Direccion Arrendador -->
    <div class="box-header with-border form-group"><h3 class="box-title">Domicilio</h3></div>
    <div class="form-group">
        <label for="calle">Calle: </label>
        <input  type="text" name="calle" class="form-control" style="text-transform:uppercase" placeholder="Calle..." required>
    </div>
    <div class="form-group">
        <label for="numero_ext">Numero Exterior: </label>
        <input  type="text" name="numero_ext" onkeypress="return justNumbers(event)" class="form-control" style="text-transform:uppercase" placeholder="Numero Exterior..." required>
    </div>
    <div class="form-group">
        <label for="numero_int">Numero Interior: </label>
        <input  type="text" name="numero_int" style="text-transform:uppercase" class="form-control" placeholder="Numero Interior...">
    </div>
    <div class="form-group">
        <label for="colonia">Colonia: </label>
        <input  type="text" name="colonia" style="text-transform:uppercase" class="form-control" placeholder="Colonia..." required>
    </div>
    <div class="form-group">
        <label for="estado">Estado: </label>
        <input  type="text" name="estado" style="text-transform:uppercase" class="form-control" placeholder="Estado..." required>
    </div>
    <div class="form-group">
        <label for="ciudad">Ciudad: </label>
        <input  type="text" name="ciudad" style="text-transform:uppercase" class="form-control" placeholder="Ciudad..." required>
    </div>
    <div class="form-group">
        <label for="codigo_postal">Codigo Postal: </label>
        <input  type="number" name="codigo_postal" class="form-control" placeholder="Codigo Postal..." required>
    </div>
    <div class="form-group">
        <label for="entre_calles">Entre Calles: </label>
        <input  type="text" name="entre_calles" class="form-control" style="text-transform:uppercase" placeholder="Entre Calles...">
    </div>
    <hr>
    <div class="form-group">
        <label for="telefono">Teléfono &nbsp;&nbsp;<button id="add_field" class="btn-sm btn-success">Añadir</button> </label><br>
        <div id="listas">
            <div class="formulario-dos" style="display: inline-flex">
                <input class="form-control" data-mask="(000) 000 0000" id="masc-tel" name="phone_number[0][telefono]"
                       onkeypress="return justNumbers(event)" placeholder="Telefono..." required type="text">&nbsp;
                <input class="form-control" id="desc" name="phone_number[0][descripcion]" placeholder="Descripcion..."
                       required type="text">
            </div>
            <br>
        </div>
    </div>
    <div class="form-group">
        <label for="email">Correo Electronico &nbsp;&nbsp;<button id="add_f" class="btn-sm btn-success">Añadir</button> </label><br>
        <div id="lista">
            <div  style="display: inline-flex">
                <input  type="email" name="email[]" class="form-control" placeholder="Correo Electronico..." required>
            </div>
            <br>
        </div>
    </div>
    <hr>

    <!-- Direccion de Facturacion -->
    <div class="box-header with-border form-group"><h3 class="box-title">Direccion de Facturación</h3>
        <input  type="checkbox" checked onclick="document.getElementById('facturacion-check').hidden=!this.checked; checknull(this.checked)">
    </div>
    <div id="facturacion-check">
        <div class="form-group">
            <label for="calle_facturacion">Calle: </label>
            <input  type="text" name="calle_facturacion" style="text-transform:uppercase" class="form-control" placeholder="Calle...">
        </div>
        <div class="form-group">
            <label for="numero_ext_facturacion">Numero Exterior: </label>
            <input  type="text" name="numero_ext_facturacion" onkeypress="return justNumbers(event)" style="text-transform:uppercase" class="form-control" placeholder="Numero Exterior...">
        </div>
        <div class="form-group">
            <label for="numero_int_facturacion">Numero Interior: </label>
            <input  type="text" name="numero_int_facturacion" onkeypress="return justNumbers(event)" style="text-transform:uppercase" class="form-control" placeholder="Numero Interior...">
        </div>
        <div class="form-group">
            <label for="colonia_facturacion">Colonia: </label>
            <input  type="text" name="colonia_facturacion" style="text-transform:uppercase" class="form-control" placeholder="Colonia...">
        </div>
        <div class="form-group">
            <label for="estado_facturacion">Estado: </label>
            <input  type="text" name="estado_facturacion" style="text-transform:uppercase" class="form-control" placeholder="Estado...">
        </div>
        <div class="form-group">
            <label for="ciudad_facturacion">Ciudad: </label>
            <input  type="text" name="ciudad_facturacion" style="text-transform:uppercase" class="form-control" placeholder="Ciudad...">
        </div>
        <div class="form-group">
            <label for="codigo_postal_facturacion">Codigo Postal: </label>
            <input  type="number" name="codigo_postal_facturacion" class="form-control" placeholder="Codigo Postal...">
        </div>
        <div class="form-group">
            <label for="entre_calles_facturacion">Entre Calles: </label>
            <input  type="text" name="entre_calles_facturacion" style="text-transform:uppercase" class="form-control" placeholder="Entre Calles...">
        </div>
        <div class="form-group">
            <label for="rfc">RFC: </label>
            <input  type="text" name="rfc" class="form-control" style="text-transform:uppercase" placeholder="RFC..."><br>
        </div>
    </div>
    <hr>
    <div class="box-header with-border form-group"><h3 class="box-title">Datos Bancarios</h3>
        <input  type="checkbox" checked onclick="document.getElementById('banc').hidden=!this.checked; checknull(this.checked)">
    </div>
            <div class="form-group">
                <div id="datosbanco">
                    <div id="banc" class="formulario-dos">
                        <button id="add_banco" class="btn-sm btn-success">Añadir</button>

                        <div id="basebanco" class="form-group" style="display: inline-flex; align-items: baseline">
                            <input class="form-control" style="margin-bottom: 4px" type="text" name="banco1" style="text-transform:uppercase" placeholder="Banco...">&nbsp;
                            <input class="form-control" id="cc" type="text" onkeypress="return justNumbers(event)" name="cuenta1" placeholder="Cuenta...">&nbsp;
                            <input class="form-control" id="cc" type="text" maxlength="18" onkeypress="return justNumbers(event);" name="clabe1" placeholder="Clabe...">&nbsp;
                            <input class="form-control" id="cc" type="text" name="nombre_titular1" style="text-transform:uppercase" placeholder="Nombre del Titular...">
                        </div>
                    </div>
                </div>
            </div>
            <hr>

    <div class="formulario-dos">
        <label for="admon">Admon: </label>
        <input  type="text" name="admon" style="text-transform:uppercase" class="form-control" placeholder="Admon..." required>
    </div>
    <hr>

    <div class="form-group">
        <button class="btn btn-primary" type="submit">Guardar</button>
        <a class="btn btn-danger" href="./">Cancelar</a>
    </div>

    {!! Form::close() !!}



@endsection
@section('javascript')
    <script type="application/javascript">
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
            $('#banc').remove();
        })
    </script>
@endsection
