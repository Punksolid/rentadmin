@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Tipo de Propiedad</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::model($propiedad, ['method' => 'PATCH', 'route' =>['tipo-propiedad.update', $propiedad->id_tipo_propiedad]]) !!}
            {{Form::token()}}
            <div class="form-group">
                <label for="tipo_propiedad">Tipo de Propiedad</label>
                <input type="text" name="tipo_propiedad" class="form-control" value="{{ $propiedad->tipo_propiedad }}" placeholder="Tipo de Propiedad..." required>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="../">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection
