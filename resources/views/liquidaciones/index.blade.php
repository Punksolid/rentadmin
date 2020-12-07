@extends ('layouts.admin')
@section ('contenido')
    <style>
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }

    </style>
    <div class="row">
        <div class="col-12">
            <h3>Liquidaciones</h3>
            <div>
                <div class="formulario-dos">
                    <label>Arrendador</label>
                    <input type="text" class="form-control tipo-propiedad" id="arrendadornombre" placeholder="Arrendador..." disabled required>
                    <button type="button" class="btn buscar-btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-arrendador-contrato"><i class="fa fa-search"></i></button>
                    <input type="hidden" id="id_arrendador_contrato" name="id_arrendador" value="" required>
                </div>
                <button style="margin-bottom: 5px" onclick="peticionLiquidacion()" class="btn btn-primary">Consultar</button>
            </div>
            <div>
                <div class="formulario-dos">
                    <label>Mes A Generar</label>
                    <select id="mes" name="mes" class="form-control">
                        <option value="" selected disabled>Seleccione mes para generar recibo</option>
                        <option mes="{{$mestres}}" value="{{$num_mes_tres}}">{{$mestres}}</option>
                        <option mes="{{$mesuno}}" value="{{$num_mes_uno}}">{{$mesuno}}</option>
                        <option mes="{{$mesdos}}" value="{{$num_mes_dos}}">{{$mesdos}}</option>
                    </select>
                </div>
                <div class="formulario-liq">
                    <label>Retención IVA %</label>
                    <input id="retiva" class="form-control" value="{{$retiva}}">
                </div>
                <div class="formulario-liq">
                    <label>Retención ISR %</label>
                    <input id="retisr" class="form-control" value="{{$retisr}}">
                </div>
            </div>
            <table id="tablaprueba" class="table table-sm table-hover">
                <thead>
                    <th>Id</th>
                    <th>Inmueble</th>
                    <th>Arrendatario</th>
                    <th style="width: 15%; text-align: center">Mes</th>
                    <th style="text-align: center;">Importe</th>
                    <th style="text-align: center">IVA</th>
                </thead>
                <tbody id="tbodyid">
                <tr  id="comision">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="display: inline-flex"><input id="porcen" value="{{$comision}}" style="width: 25%; height: 25px" class="form-control">% COMISION</td>
                    <td id="comisionvalor" style="text-align: center"></td>
                </tr>
                </tbody>
            </table>

            <!-- Tabla Gastos -->
            <div class="formulario-dos">
                <h5 style="text-align: center"><strong>Gastos</strong></h5>
                <div style="display: flex">
                    <table id="tablagastos" class="table table-sm table-striped table-hover">
                        <thead>
                        <th>Nombre</th>
                        <th>Importe</th>
                        </thead>
                        <tbody>
                        <tr id="gastostr">
                            <td style="text-align: center; border-bottom: black 2px solid">SALDO A SU CARGO</td>
                            <td id="totalgastos" style="border-bottom: black 2px solid"></td>
                        </tr>

                        </tbody>

                    </table>
                    <button id="botongasto" style="margin-left: 2px" class="btn btn-sm btn-success btn-circle"><i class="fa fa-plus"></i></button>
                    <button id="botontotal" style="margin-left: 2px; height: 30px" class="btn btn-sm btn-primary">TOTAL</button>
                </div>
            </div>

            <div class="formulario-dos">
                <table id="tabladeposito" class="table table-sm table-hover">
                    <thead>
                    <th style="text-align: center; width: 250px">Depositos</th>
                    <th style="text-align: center">Importe</th>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('liquidaciones.modal')
    <div>
        <input style="display:none;" id="urlfinca" value="{{url('liquidaciones/finca')}}">
        <input style="display:none;" id="token" value="{{csrf_token()}}">
    </div>
    <script>
        document.getElementById('porcen').onblur = function () {
            const formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 0
            })
            var cantidad = document.getElementById('importevalor').innerHTML;
            var primero = cantidad.replace('$', '');
            var segundo = primero.replace('.00', '');
            var importe = segundo.replace(',', '');
            var total = (importe*this.value)/100;
            document.getElementById('comisionvalor').innerHTML = formatter.format(total)+'.00';
            var totalcomi = document.getElementById('totalcomi').innerHTML;
            var comiuno = totalcomi.replace('$', '');
            var comidos = comiuno.replace('.00', '');
            var comitotal = comidos.replace(',', '');
            var totalcomision = (parseInt(importe)+parseInt(comitotal)+parseInt(total));
            document.getElementById('importefinal').innerHTML = formatter.format(totalcomision)+'.00';
            var ret = document.getElementById('importeRet').innerHTML;
            var prime = ret.replace('$', '');
            var segu = prime.replace('.00', '');
            var importeRet = segu.replace(',', '');
            var resultado = totalcomision-parseInt(importeRet);
            document.getElementById('retTotal').innerHTML = formatter.format(resultado)+'.00';
        }
    </script>
@endsection
