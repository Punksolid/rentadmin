@extends ('layouts.layout-v2')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Tipo de Mantenimiento</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::model($mantenimiento, ['method' => 'PATCH', 'route' =>['tipo-mantenimiento.update', $mantenimiento->id_tipo_mantenimiento]]) !!}
            {{Form::token()}}
            <div class="form-group">
                <label for="tipo_propiedad">Tipo de Mantenimiento</label>
                <input type="text" name="tipo_mantenimiento" class="form-control" value="{{ $mantenimiento->tipo_mantenimiento }}" placeholder="Tipo de Mantenimiento..." required>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="../">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection
