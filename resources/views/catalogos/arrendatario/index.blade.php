@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Catalogo de Arrendatarios</h3>
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
            <a href="{{url('catalogos/arrendatario/create')}}"><button class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</button></a>
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
                    <th>Puesto</th>
                    <th>Opciones</th>
                    </thead>

                    @foreach($arrendatarios as $lessee)
                    <tr class="item">
                        <td style="display: none" class="nombres">{{ $lessee->nombre.' '.$lessee->apellido_paterno.' '.$lessee->apellido_materno }}</td>
                        <td>{{ $lessee->nombre }}</td>
                        <td>{{ $lessee->apellido_paterno }}</td>
                        <td>{{ $lessee->apellido_materno }}</td>
                        <td>{{ optional($lessee->defaultPhoneNumber())->telefono }}</td>
                        <td>{{ optional($lessee->defaultEmail())->email }}</td>
                        <td>{{$lessee->puesto}}</td>
                        <td>
                            @if($lessee->estatus == 1)
                                {!! Form::Open(['route' => ['arrendatario.toggle', $lessee->id, 'status' => \App\Models\Lessee::STATUS_INACTIVE], 'method' => 'PATCH']) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\LesseesController@edit', $lessee->id) }}"><i class="far fa-edit"></i></a>
                                <button type="submit" class="btn btn-danger linea">Desactivar</button>
                                {{ Form::Close() }}
                            @else
                                {!! Form::Open(['route' => ['arrendatario.toggle', $lessee->id, 'status' => \App\Models\Lessee::STATUS_ACTIVE], 'method' => 'PATCH']) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\LesseesController@edit', $lessee->id) }}"><i class="far fa-edit"></i></a>
                                <button type="submit" class="btn btn-success linea">Activar</button>
                                {{ Form::Close() }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            {{ $arrendatarios->links() }}
            <a href="{{ route('arrendatario.index', [
                    'status' => $status ? 0: 1
                    ]) }}" >
                <button class="btn  {{ $status? 'btn-secondary':'btn-primary' }}">Arrendatarios {{ $status? 'Inactivos': 'Activos'  }}</button>
            </a>
        </div>
    </div>

@endsection
