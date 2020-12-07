@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Catalogo de Inmuebles</h3>
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
            <a href="{{url('catalogos/finca/create')}}"><button class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered table-condensed table-hover">
                    <thead class="thead-light">
                    <th>Finca Arrendada</th>
                    <th>Arrendador</th>
                    <th>Servicio de Luz</th>
                    <th>Cuenta Japac</th>
                    <th>Recibo</th>
                    <th>Estatus</th>
                    <th>Opciones</th>
                    </thead>

                    @foreach($finca as $a)
                    <tr class="item">
                        <td style="display: none" class="nombres">{{ $a->arrendador.' '.$a->arrendadora }}</td>
                        <td>{{ $a->finca_arrendada }}</td>
                        <td>{{ $a->arrendador }} {{$a->arrendadora}}</td>
                        <td>{{ $a->servicio_luz }}</td>
                        <td>{{ $a->cta_japac }}</td>
                        <td>{{ $a->recibo }}</td>
                        <td>{{$a->estatus_renta}}</td>

                        <td>
                            @if($a->estatus == 1)
                                {!! Form::Open(array('action' => array('Backend\CatFincaController@destroy', $a->id_cat_fincas), 'method' => 'delete')) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\CatFincaController@edit', $a->id_cat_fincas) }}"><i class="far fa-edit"></i></a>
                                <button type="submit" class="btn btn-danger linea">Desactivar</button>
                                {{ Form::Close() }}
                            @else
                                {!! Form::Open(array('action' => array('Backend\CatFincaController@activar', $a->id_cat_fincas), 'method' => 'PUT')) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\CatFincaController@edit', $a->id_cat_fincas) }}"><i class="far fa-edit"></i></a>
                                <button type="submit" class="btn btn-success linea">Activar</button>
                                {{ Form::Close() }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            {{$finca->render()}}
        </div>
    </div>

@endsection
