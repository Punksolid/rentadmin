@extends ('layouts.admin')
@section ('contenido')
<div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Mantenimientos</h3>
            <div class="form-group">
                <div class="input-group">
                    <input id="buscador" onkeyup="buscadorindex()" type="text" class="form-control" name="searchText" placeholder="Buscar..." value="">
                    <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="text-right">
            <a href="{{url('mantenimiento/create')}}"><button class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered table-condensed table-hover">
                    <thead class="thead-light">
                    <th>Finca</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Ubicación</th>
                    <th>Encargado</th>
                    <th>Tel. Encargado</th>
                    <th>Fecha Registro</th>
                    <th>Recurrente</th>
                    <th>Estatus Proceso</th>
                    <th>Opciones</th>
                    </thead>

                    @foreach($mantenimientos as $a)
                    <tr class="item">
                        @php($finca = \App\Models\Property::findOrFail($a->id_finca))
                        @php($user = \App\Models\User::findOrFail($a->id_usuario))
                        @php($tipo = \App\Models\TipoMantenimiento::findOrFail($a->id_tipo_mantenimiento))
                        <td class="nombres">{{ $finca->finca_arrendada }}</td>
                        <td>{{ $tipo->tipo_mantenimiento }}</td>
                        <td>{{ $a->descripcion_mantenimiento }}</td>
                        <td>{{ $a->ubicacion }}</td>
                        <td>{{ $a->encargado }}</td>
                        <td>{{ $a->tel_encargado }}</td>
                        <td style="text-align: center">{{ $a->fecha_registro }}</td>
                        @if($a->recurrente == 0)
                            <td>No Recurrente</td>
                        @else
                            <td>Recurrente</td>
                        @endif
                        @if($a->estatus_proceso == 0)
                            <td>En Proceso</td>
                        @else
                            <td>Terminado</td>
                        @endif
                        <td>
                            @if($a->estatus == 1)
                                {!! Form::Open(array('action' => array('Backend\MantenimientoController@destroy', $a->id_mantenimiento), 'method' => 'delete')) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\MantenimientoController@edit', $a->id_mantenimiento) }}"><i class="far fa-edit"></i></a>
                                <button type="submit" class="btn btn-danger linea">Desactivar</button>
                                {{ Form::Close() }}
                            @else
                                {!! Form::Open(array('action' => array('Backend\MantenimientoController@activar', $a->id_mantenimiento), 'method' => 'PUT')) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\MantenimientoController@edit', $a->id_mantenimiento) }}"><i class="far fa-edit"></i></a>
                                <button type="submit" class="btn btn-success linea">Activar</button>
                                {{ Form::Close() }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            {{$mantenimientos->render()}}
        </div>
    </div>
@endsection
