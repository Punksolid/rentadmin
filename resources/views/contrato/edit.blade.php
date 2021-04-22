@extends ('layouts.layout-v2')
@section('page_title','Editar Contrato')

@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Contrato</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::model($contrato, ['method' => 'PATCH', 'route' =>['contrato.update', $contrato->id]]) !!}
            {{Form::token()}}
            <div class="form-group">
                <label>Arrendador</label>
               <div class="input-group">
                <input
                        class="form-control"
                        disabled
                        id="arrendadornombre"
                        placeholder="Arrendador..."
                        required
                        type="text"
                        value="{{$contrato->lessor->id}}-. {{ $contrato->lessor->nombre }} {{$contrato->lessor->apellido_paterno}}">
                <input id="id_arrendador_contrato" name="id_arrendador"
                       required
                       type="hidden"
                       value="{{$contrato->lessor->id}}">
{{--            <div class="input-group-btn">--}}
{{--                <button--}}
{{--                    class="btn btn-info btn-flat" data-target="#modal-arrendador-contrato"--}}
{{--                        data-toggle="modal"--}}
{{--                        type="button"><i class="fa fa-search"></i></button>--}}
{{--            </div>--}}
        </div>
    </div>
            <div class="form-group">
                <label>Propiedad</label>
                <div class="input-group">
                    <input type="text" class="form-control tipo-propiedad" id="propiedadnombre"
                          placeholder="Propiedad..." value="{{$contrato->property->id}}-. {{$contrato->property->name}}"
                          disabled required>
                    <input type="hidden" id="id_propiedad_contrato" name="id_finca" value="{{$contrato->property->id}}"
                    required>
{{--                    <div class="input-group-btn">--}}
{{--                    <button type="button" class="btn btn-info btn-flat" data-toggle="modal"--}}
{{--                            data-target="#modal-propiedad-contrato"><i class="fa fa-search"></i></button>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="form-group">
                <label>Arrendatario</label>
                <div class="input-group">
                    <input type="text" class="form-control tipo-propiedad" id="arrendatarionombre"
                          placeholder="Arrendatario..."
                          value="{{ $contrato->lessee->id }}-. {{ $contrato->lessee->name }} {{ $contrato->lessee->apellido_paterno }}"
                          disabled required>
                    <input type="hidden" id="id_arrendatario_contrato" name="id_arrendatario"
                           value="{{$contrato->lessee->id}}" required>
{{--                    <div class="input-group-btn">--}}
{{--                        <button type="button"--}}
{{--                                class="btn btn-info btn-flat"--}}
{{--                                data-toggle="modal"--}}
{{--                                data-target="#modal-arrendatario-contrato"><i class="fa fa-search"></i></button>--}}
{{--                    </div>--}}
                </div>
            </div>


            <div id="app">
                <div class="form-group">
                    <label for="duracion_contrato">Duracion del Contrato(Años)</label>
                    <input class="form-control"
                           id="duracion_c"
                           min="{{$contrato->duracion_contrato}}" name="duracion_contrato"
                           onchange="editar()" onkeyup="editar()" placeholder="Duracion..."
                           required type="number" v-model.number="years"
                           v-on:keyup="updatedYears($event.target.value)"
                           value="{{$contrato->duracion_contrato}}">
                </div>

                <div class="form-group">
                    <label for="fecha_inicio">Fechas de Contrato</label>
                    <table>
                        <thead>
                        <tr>
                            <th>
                                <label style="background-color: #F01B21; color: white" class="form-control text-center">Inicio</label>
                            </th>
                            <th>
                                <label style="background-color: #F01B21; color: white" class="form-control text-center">Fin</label>
                            </th>
                            <th><label style="background-color: #F01B21; color: white" class="form-control text-center">Cantidad</label>
                            </th>
                            <th><label style="background-color: #F01B21; color: white" class="form-control text-center">Porcentaje</label>
                            </th>
                        </tr>
                        </thead>
                        <div>
                            <div>
                                <tr v-for="(item, index) in tableData" :key="item.id">
                                    <td><input
                                            :id="'periods['+index+'][fecha_inicio]'"
                                            :name="'periods['+index+'][fecha_inicio]'"
                                            class="form-control"
                                            type="date"
                                            :value="item.fecha_inicio"
                                            v-model.value="item.fecha_inicio"
                                        >
                                    </td>
                                    <td><input
                                            :name="'periods['+index+'][fecha_fin]'"
                                            class="form-control"
                                            type="date"
                                            v-model.value="item.fecha_fin"
                                            :value="item.fecha_fin">
                                    </td>
                                    <td><input
                                            class="form-control"
                                            data-type="currency"
                                            id="currency-field"
                                            v-bind:key="index"
                                            :name="'periods['+index+'][cantidad]'"
                                            :data-index.number="index"
                                            placeholder="Cantidad..."
                                            type="text"
                                            v-model.number="item.quantity"
                                            v-on:change="recalculateTableQuantitiesFromQuantity( index, $event.target)"
                                        >
                                    </td>
                                    <td><input
                                            :data-index.number="index"
                                            :name="'periods['+index+'][increase_percentage]'"
                                            class="increase_percentage form-control"
                                            id="increase_percentage"
                                            placeholder="Porcentaje de Aumento..."
                                            type="number"
                                            v-model.number="item.increase_percentage"
                                            v-on:change="recalculateTableQuantitiesFromPercentage( index, $event.target)"
                                        ></td>
                                </tr>
                            </div>

                        </div>

                    </table>
                </div>
            </div>

            <div class="form-group">
                <label for="moneda">Bonificacion</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <div class="input-group-text">$</div>
                    </div>
                    <input id="moneda" type="text" name="bonificacion" data-type="currency" class="form-control currency-field" placeholder="Bonificacion..." required value="{{ $contrato->bonificacion }}">
                </div>
            </div>
            <div class="form-group">
                <label for="monedadep">Deposito En Garantia</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <div class="input-group-text">$</div>
                    </div>
                    <input id="monedadep" type="text" name="deposito" data-type="currency" class="form-control currency-field" placeholder="Deposito..." required value="{{ $contrato->deposito }}">
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="../">Cancelar</a>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
{{--    @include("contrato.modal")--}}

@endsection

@section('javascript')
    <script>
        jQuery(function ($) {
            $('.currency-field').mask("###,###,##0.00", {reverse: true});
        })
    </script>
    <script type="text/javascript">

        jQuery(function ($) {
            $('.currency-field').mask("###,###,##0.00", {reverse: true});
            $('.increase_percentage').change(function () {
                alert('changed');
            })
        });
        $('.increase_percentage').change(function () {
            alert('changed');
        })
        // function updateQuantities()
        // {
        //         alert('a');
        // }

        function limpiar() {
            document.getElementById('id_propiedad_contrato').value = null;
            document.getElementById('propiedadnombre').value = null;
        }

        function filtrado() {
            var id_arrendador = document.getElementById('id_arrendador_contrato').value;
            var fincas = document.getElementsByClassName('fincafiltro');
            if (id_arrendador !== '') {
                $.each(fincas, function (i, cont) {
                    var id_finca = document.getElementById(cont.getAttribute('id'));
                    if (cont.getAttribute('href') === id_arrendador) {
                        id_finca.style.display = "block";
                    } else {
                        id_finca.style.display = "none";
                    }
                })
            }
        }

        //
        var app = new Vue({
            el: '#app',
            data: {
                years: {{ $years }},
                tableData: {!! $periods !!},
                transformedData:[]

            },
            methods: {
                calculatePercentFromQuantities(original_number, new_number) {
                    let difference = new_number - original_number;

                    return (difference/original_number) * 100;
                },
                addRow() {
                    var row = {
                        fecha_inicio: this.fecha_inicio,
                        fecha_fin: this.fecha_fin,
                        quantity: this.quantity,
                        increase_percentage: this.increase_percentage,
                    }
                    this.tableData.push(row)

                    this.fecha_inicio = ''
                    this.fecha_fin = ''
                    this.quantity = 0
                    this.increase_percentage = 0
                },
                recalculateTableQuantitiesFromQuantity: function (index, target) {
                    if (index == 0) {
                        return ;
                    }

                    let previousIndex = index - 1;

                    let previousRow = {
                        quantity: this.tableData[previousIndex].quantity,
                        increase_percentage: this.tableData[previousIndex].increase_percentage
                    }

                    let percent = this.calculatePercentFromQuantities(previousRow.quantity, target.value);

                    this.tableData[previousIndex].increase_percentage = percent;
                    // this.tableData.map(function (row, key) {
                    //     if (key === 0) {
                    //         previousRow.quantity = row.quantity;
                    //         previousRow.increase_percentage = row.increase_percentage;
                    //
                    //         return row;
                    //     }
                    //     row.quantity = previousRow.quantity + (previousRow.quantity * (previousRow.increase_percentage / 100));
                    //     previousRow.quantity = row.quantity;
                    //     previousRow.increase_percentage = row.increase_percentage;
                    //
                    //     return row;
                    // });
                },
                recalculateTableQuantitiesFromPercentage(index, target) {
                    let previousRow = {
                        quantity: 0,
                        increase_percentage: 0
                    };

                    this.tableData.map(function (row, key) {
                        if (key === 0) {
                            previousRow.quantity = row.quantity;
                            previousRow.increase_percentage = row.increase_percentage;

                            return row;
                        }
                        row.quantity = previousRow.quantity + (previousRow.quantity * (previousRow.increase_percentage / 100));
                        previousRow.quantity = row.quantity;
                        previousRow.increase_percentage = row.increase_percentage;

                        return row;
                    });
                },
                updatedYears(years) {
                    this.tableData = [];
                    for (let row = 0; row < this.years; row++) {
                        this.addRow();
                    }
                }

            },
            computed: {
            },
        })
    </script>
@endsection
