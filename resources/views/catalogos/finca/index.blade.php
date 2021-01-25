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
                    <?php /** @var \App\Models\Property[] $properties */ ?>
                    @foreach($properties as $property)
                    <tr class="item">
                        <td style="display: none" class="nombres">{{ $property->arrendador.' '.$property->arrendadora }}</td>
                        <td>{{ $property->name }}</td>
                        <td>{{ $property->lessor->nombre }} {{$property->arrendadora}}</td>
                        <td>{{ $property->energy_fee }}</td>
                        <td>{{ $property->water_account_number }}</td>
                        <td>{{ $property->recibo }}</td>
                        <td>{{ $property->status}}</td>

                        <td>
                            <a href="{{  $property->getFirstMediaUrl() }}"><button class="btn btn-success linea" {{ $property->hasMedia() ?: 'disabled' }}>Foto</button></a>
                            @if($property->status == 1)
                                {!! Form::Open(['route' => ['finca.patch', $property->id], 'method' => 'PATCH']) !!}
                                    <input type="hidden" name="status" value="0"/>
                                    <button type="submit" class="btn btn-danger linea">Desactivar</button>
                                {{ Form::Close() }}
                            @else
                                {!! Form::Open(array('action' => array('Backend\PropertiesController@activar', $property->id), 'method' => 'PUT')) !!}
                                <button type="submit" class="btn btn-success linea">Activar</button>
                                {{ Form::Close() }}
                            @endif
                            <a class="linea btn btn-info" href="{{ URL::action('Backend\PropertiesController@edit', $property->id) }}"><i class="far fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            {{ $properties->links() }}
            <a href="{{ route('finca.index', [
                    'status' => $status ? 0: 1
                    ]) }}" >
                <button class="btn  {{ $status? 'btn-secondary':'btn-primary' }}">Inmuebles {{ $status? 'Inactivos': 'Activos'  }}</button>
            </a>
        </div>
    </div>

@endsection
