@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Usuario</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger" style="padding-bottom: 0px">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::model($usuario, ['method' => 'PATCH', 'route' =>['usuarios.update', $usuario->id_usuarios]]) !!}
            {{Form::token()}}

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{$usuario->nombre}}" placeholder="Nombre..." required>
            </div>
            <div class="form-group">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" class="form-control" value="{{$usuario->apellido_paterno}}" placeholder="Apellido Paterno..." required>
            </div>
            <div class="form-group">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" class="form-control" value="{{$usuario->apellido_materno}}" placeholder="Apellido Materno..." required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electronico</label>
                <input type="email" name="email" class="form-control" value="{{$usuario->email}}" placeholder="Correo Electronico..." required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Ingrese la contraseña para actualizar..." required>
            </div>

            <div class="form-group">
                <label>Tipo de Usuario</label>
                <input type="text" class="form-control tipo-propiedad" id="tipousuario" value="{{$tipo->id_tipo_usuario}}-. {{$tipo->nombre}}" placeholder="Tipo de Usuario..." disabled required>
                <button type="button" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tipo-usuario"><i class="fa fa-search"></i></button>
                <input type="hidden" id="id_tipo_usuario" name="id_tipo_usuario" value="{{$usuario->id_tipo_usuario}}" required>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="../">Cancelar</a>
            </div>

            {!! Form::close() !!}
            @include('seguridad.usuarios.modal')

        </div>
    </div>

@endsection
