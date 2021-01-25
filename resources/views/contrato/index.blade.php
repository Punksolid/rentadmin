@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Catalogo de Contratos</h3>
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
            <a href="{{url('contrato/create')}}"><button class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered table-condensed table-hover">
                    <thead class="thead-light">
                    <th>Id</th>
                    <th>Arrendador</th>
                    <th>Arrendatario</th>
                    <th>Propiedad</th>
                    <th>Tel. Arrendatario</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Termino</th>
                    <th>Opciones</th>
                    </thead>

                    @foreach($contracts as $contract)
                    <tr class="item">
                        <td style="display: none" class="nombres">{{ $contract->arrendador_nombre.' '.$contract->arrendador_apellido }}</td>
                        <td>{{ $contract->id}}</td>
                        <td>{{ $contract->lessor->nombre }} {{ $contract->lessor->apellido_paterno}}</td>
                        <td>{{ $contract->lessee->nombre }} {{ $contract->lessee->apellido_paterno }}</td>
                        <td>{{ $contract->property->name}}</td>
                        <td>{{ optional($contract->lessee->defaultPhoneNumber())->telefono }}</td>
                        @php($fecha_inicio = \Carbon\Carbon::create(9999)->format('Y/m/d'))
                        @php($fecha_fin = \Carbon\Carbon::create()->format('Y/m/d'))

                        @foreach($fechas = \App\Models\FechaContrato::where('id_contrato', $contract->id)->get() as $fc)
                            @if($fecha_inicio >= $fc->fecha_inicio)
                                @php($fecha_inicio = $fc->fecha_inicio)
                            @endif
                            @if($fecha_fin <= $fc->fecha_fin)
                                @php($fecha_fin = $fc->fecha_fin)
                            @endif
                        @endforeach

                        <td>{{\Carbon\Carbon::create($fecha_inicio)->format('d/m/Y')}}</td>
                        <td>{{\Carbon\Carbon::create($fecha_fin)->format('d/m/Y')}}</td>

                        <td>
                            @if($contract->estatus == 1)
                                {!! Form::Open(array('action' => array('Backend\ContractsController@destroy', $contract->id), 'method' => 'delete')) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\ContractsController@edit', $contract->id) }}"><i class="far fa-edit"></i></a>
                                <button type="submit" class="btn btn-danger linea">Desactivar</button>
                                {{ Form::Close() }}
                            @else
                                {!! Form::Open(array('action' => array('Backend\ContractsController@activar', $contract->id), 'method' => 'PUT')) !!}
                                <a class="linea btn btn-info" href="{{ URL::action('Backend\ContractsController@edit', $contract->id) }}"><i class="far fa-edit"></i></a>
                                <button type="submit" class="btn btn-success linea">Activar</button>
                                {{ Form::Close() }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            {{$contracts->render()}}
        </div>
    </div>

@endsection
