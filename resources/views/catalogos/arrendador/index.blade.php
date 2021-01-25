@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Catalogo de Arrendadores</h3>
            <div class="form-group">
                <form action="{{ route('arrendador.index') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input id="buscador" type="text" class="form-control" name="full_name" placeholder="Buscar..." value="">
                        <span class="input-group-btn">
                             <button type="submit" class="btn btn-primary">Buscar</button>
                        </span>
                    </div>
                </form>
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

                    @foreach($lessors as $lessor)
                    <tr class="item">
                        <td style="display: none" class="nombres">{{ $lessor->nombre.' '.$lessor->apellido_paterno.' '.$lessor->apellido_materno }}</td>
                        <td>{{ $lessor->nombre }}</td>
                        <td>{{ $lessor->apellido_paterno }}</td>
                        <td>{{ $lessor->apellido_materno }}</td>
                        <td>{{ optional($lessor->defaultPhoneNumber)->telefono}}</td>
                        <td>{{ optional($lessor->defaultEmail())->email }}</td>
                        <td>{{ $lessor->rfc }}</td>
                        <td>
                            @if($lessor->estatus == 1)
                                    {!! Form::Open(['action' => ['Backend\LessorController@destroy', $lessor->id], 'method' => 'delete']) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\LessorController@edit', $lessor->id) }}"><i class="far fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger linea">Desactivar</button>
                                    {{ Form::Close() }}
                            @else
                                    {!! Form::Open(['action' => ['Backend\LessorController@activar', $lessor->id], 'method' => 'PUT']) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\LessorController@edit', $lessor->id) }}"><i class="far fa-edit"></i></a>
                                    <button type="submit" class="btn btn-success linea">Activar</button>
                                    {{ Form::Close() }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            {{ $lessors->links() }}

            <a href="{{ route('arrendador.index', [
                    'status' => $status ? 0: 1
                    ]) }}" >
                <button class="btn  {{ $status? 'btn-secondary':'btn-primary' }}">Arrendadores {{ $status? 'Inactivos': 'Activos'  }}</button>
            </a>
        </div>
    </div>

@endsection
