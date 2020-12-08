@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Catalogo de Arrendadores</h3>
            <div class="form-group">
                <div class="input-group">
                    <input id="buscador" type="text" onkeyup="buscadorindex()" class="form-control" name="searchText" placeholder="Buscar..." value="">
                    <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="text-right">
            <a href="{{url('catalogos/arrendador/create')}}"><button class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-condensed table-hover">
                    <thead class="thead-light">
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>RFC</th>
                    <th>Opciones</th>
                    </thead>

                    @foreach($arrendador as $a)
                    <tr class="item">
                        <td style="display: none" class="nombres">{{ $a->nombre.' '.$a->apellido_paterno.' '.$a->apellido_materno }}</td>
                        <td>{{ $a->nombre }}</td>
                        <td>{{ $a->apellido_paterno }}</td>
                        <td>{{ $a->apellido_materno }}</td>
                        <td>{{ $a->telefono }}</td>
                        <td>{{ $a->email }}</td>
                        <td>{{ $a->rfc }}</td>
                        <td>
                            @if($a->estatus == 1)
                                    {!! Form::Open(array('action' => array('Backend\CatArrendadorController@destroy', $a->id_cat_arrendador), 'method' => 'delete')) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\CatArrendadorController@edit', $a->id_cat_arrendador) }}"><i class="far fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger linea">Desactivar</button>
                                    {{ Form::Close() }}
                            @else
                                    {!! Form::Open(array('action' => array('Backend\CatArrendadorController@activar', $a->id_cat_arrendador), 'method' => 'PUT')) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\CatArrendadorController@edit', $a->id_cat_arrendador) }}"><i class="far fa-edit"></i></a>
                                    <button type="submit" class="btn btn-success linea">Activar</button>
                                    {{ Form::Close() }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            {{$arrendador->render()}}
        </div>
    </div>

@endsection
