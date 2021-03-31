@extends ('layouts.layout-v2')
@section ('contenido')

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Tipos de Mantenimiento</h3>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="text-right">
            <a href="{{url('subcatalogos/tipo-mantenimiento/create')}}"><button class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered table-condensed table-hover">
                    <thead class="thead-light">
                    <th>Tipo de Mantenimiento</th>
                    <th>Opciones</th>
                    </thead>

                    @foreach($mantenimiento as $p)
                    <tr>
                        <td>{{ $p->tipo_mantenimiento }}</td>
                        <td>
                            @if($p->estatus == 1)
                                {!! Form::Open(array('action' => array('Backend\TipoMantenimientoController@destroy', $p->id_tipo_mantenimiento), 'method' => 'delete')) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\TipoMantenimientoController@edit', $p->id_tipo_mantenimiento) }}"><i class="far fa-edit"></i></a>
                                <button type="submit" class="btn btn-danger linea">Desactivar</button>
                                {{ Form::Close() }}
                            @else
                                {!! Form::Open(array('action' => array('Backend\TipoMantenimientoController@activar', $p->id_tipo_mantenimiento), 'method' => 'PUT')) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\TipoMantenimientoController@edit', $p->id_tipo_mantenimiento) }}"><i class="far fa-edit"></i></a>
                                <button type="submit" class="btn btn-success linea">Activar</button>
                                {{ Form::Close() }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            {{$mantenimiento->render()}}
        </div>
    </div>

@endsection
