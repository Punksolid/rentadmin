@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Catalogo de Incidentes</h3>
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
            <a href="{{url('incidentes/create')}}"><button class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered table-condensed table-hover">
                    <thead class="thead-light">
                    <th>Inmueble</th>
                    <th>Quien Reporto</th>
                    <th>Fecha de Reporte</th>
                    <th>Area</th>
                    <th>Incidente</th>
                    <th>Asignado</th>
                    <th>Fecha de Asignacion</th>
                    <th>Estatus</th>
                    <th>Opciones</th>
                    </thead>

                    @foreach($incidentes as $a)
                    <tr class="item">
                        @php($finca = \App\Models\CatFinca::findOrFail($a->id_finca))
                        <td class="nombres">{{ $finca->finca_arrendada }}</td>
                        <td>{{ $a->reporto }}</td>
                        <td>{{ $a->fecha_reporte }}</td>
                        <td>{{ $a->area }}</td>
                        <td>{{ $a->incidente }}</td>
                        <td>{{ $a->asignado }}</td>
                        <td style="text-align: center">{{ $a->fecha_asignacion }}</td>
                        @if($a->estatus_proceso == 0)
                            <td>En Proceso</td>
                        @else
                            <td>Terminado</td>
                        @endif

                        <td>
                            @if($a->estatus == 1)
                                {!! Form::Open(array('action' => array('Backend\CatIncidentesController@destroy', $a->id_cat_incidentes), 'method' => 'delete')) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\CatIncidentesController@edit', $a->id_cat_incidentes) }}"><i class="far fa-edit"></i></a>
                                <button type="submit" class="btn btn-danger linea">Desactivar</button>
                                {{ Form::Close() }}
                            @else
                                {!! Form::Open(array('action' => array('Backend\CatIncidentesController@activar', $a->id_cat_incidentes), 'method' => 'PUT')) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\CatIncidentesController@edit', $a->id_cat_incidentes) }}"><i class="far fa-edit"></i></a>
                                <button type="submit" class="btn btn-success linea">Activar</button>
                                {{ Form::Close() }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            {{$incidentes->render()}}
        </div>
    </div>

@endsection
