@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Usuarios</h3>
            @include ('seguridad.usuarios.search')
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="text-right">
            <a href="{{url('seguridad/usuarios/create')}}"><button class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered table-condensed table-hover">
                    <thead class="thead-light">
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Email</th>
                    <th>Tipo de Usuario</th>
                    <th>Opciones</th>
                    </thead>

                    @foreach($usuario as $us)
                        @php($tipo = \App\Models\TipoUsuario::where('id_tipo_usuario', $us->id_tipo_usuario)->first())
                        <tr>
                            <td>{{$us->nombre}}</td>
                            <td>{{$us->apellido_paterno}}</td>
                            <td>{{$us->apellido_materno}}</td>
                            <td>{{$us->email}}</td>
                            <td>{{$tipo->nombre}}</td>
                            <td>
                                @if($us->nombre == 'Administrador')
                                    <p>No hay opciones</p>
                                @else
                                    @if($us->estatus == 1)
                                        {!! Form::Open(array('action' => array('Backend\UsuarioController@destroy', $us->id_usuarios), 'method' => 'delete')) !!}
                                        <a class="linea btn btn-info" href="{{ URL::action('Backend\UsuarioController@edit', $us->id_usuarios) }}"><i class="far fa-edit"></i></a>
                                        <button type="submit" class="btn btn-danger linea">Desactivar</button>
                                        {{ Form::Close() }}
                                    @else
                                        {!! Form::Open(array('action' => array('Backend\UsuarioController@activar', $us->id_usuarios), 'method' => 'PUT')) !!}
                                        <a class="linea btn btn-info" href="{{ URL::action('Backend\UsuarioController@edit', $us->id_usuarios) }}"><i class="far fa-edit"></i></a>
                                        <button type="submit" class="btn btn-success linea">Activar</button>
                                        {{ Form::Close() }}
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                </table>
            </div>
            {{$usuario->render()}}
        </div>
    </div>

@endsection
