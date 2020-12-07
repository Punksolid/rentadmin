<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$data['finca_arrendada']}}-{{$data['mes']}}</title>
</head>
<style>
    .titulo-pdf{
        text-align: center;
        margin-top: 0;
        margin-bottom: 40px;
    }
    html{
        font-weight: normal !important;
    }
    .display-inline{
        display: inline-block !important;
    }
    .margin-izq{
        margin-left: 40px;
    }
    .margin-titulos{
        margin-right: 50px;
        margin-bottom: 0 !important;
        margin-top: 0 !important;
    }
    .card-pdf {
        border: 1px solid #000000;
        background: #ffffff;
        width: 300px;
        height: 120px;
        display: inline-block !important;
        margin-top: 20px;
        border-radius: 5px;
    }
    .card-obs{
        border: 1px solid #000000;
        background: #ffffff;
        width: 100%;
        height: 120px;
        margin-top: 5px;
        border-radius: 5px;
    }
</style>
<body>
@if($data['recibo'] == "No Fiscal")

    <main>
        <div>
            <div class="titulo-pdf">
                <h3>RECIBO DE ARRENDAMIENTO</h3>
            </div>
        </div>
        <div>
            <div class="display-inline">
                <h5 class="margin-titulos">NOMBRE DEL ARRENDATARIO</h5>
                <h5 class="margin-titulos">DOMICILIO FINCA ARRENDADA</h5>
                <h5 class="margin-titulos">MES A CUBRIR</h5>
            </div>

            <div class="display-inline">
                <h5 class="margin-titulos margin-izq">{{ $data["arrendatario"] }}</h5>
                <h5 class="margin-titulos margin-izq">{{ $data['finca_arrendada'] }}</h5>
                <h5 class="margin-titulos margin-izq">{{ strtoupper($data['mes']) }}</h5>
            </div>
        </div>
        <div>
            <div  style="width: 220px; height: 120px; margin-top: 40px" class="display-inline">
                <h5 class="margin-titulos">IMPORTE DE LA RENTA</h5>
                <h5 class="margin-titulos">-BONIF.P.P</h5>
                <h5 class="margin-titulos">SUBTOTAL</h5>
                @if($data['mantenimiento'] != '$0.00')
                    <h5 class="margin-titulos">MANTENIMIENTO</h5>
                @else
                @endif
                @if($data['cuota_agua'] != '$0.00')
                    <h5 class="margin-titulos">CUOTA DE AGUA</h5>
                @else
                @endif
                @if(isset($data['complemento']) && $data['complemento'] != '$0.00')
                    <h5 class="margin-titulos">COMPLEMENTO DE DEPOSITO</h5>
                @else
                @endif
                @if(isset($data['deposito_nel']))
                    <h5 class="margin-titulos">DEPOSITO EN GARANTIA</h5>
                @else
                @endif
                <h5 class="margin-titulos">TOTAL</h5>
            </div>

            <div style="width: 150px; height: 95px; text-align: right; margin-top: -28px" class="display-inline">
                <h5 class="margin-titulos margin-izq">{{$data['importe']}}</h5>
                <h5 class="margin-titulos margin-izq">-{{$data['bonificacion']}}</h5>
                <h5 style="border-top: black 2px solid" class="margin-titulos margin-izq">{{$data['subtotal']}}</h5>
                @if($data['mantenimiento'] != '$0.00')
                    <h5 class="margin-titulos margin-izq">{{$data['mantenimiento']}}</h5>
                @else
                @endif
                @if($data['cuota_agua'] != '$0.00')
                    <h5 class="margin-titulos margin-izq">{{$data['cuota_agua']}}</h5>
                @else
                @endif
                @if(isset($data['complemento']) && $data['complemento'] != '$0.00')
                    <h5 class="margin-titulos">{{$data['complemento']}}</h5>
                @else
                @endif
                @if(isset($data['deposito_nel']))
                    <h5 class="margin-titulos">{{$data['deposito_nel']}}</h5>
                @else
                @endif
                <h5 style="border-top: black 5px double" class="margin-titulos margin-izq">{{$data["total"]}}</h5>
            </div>
            <div style="margin-top: -10px" class="card-pdf">
                <p style="margin-top: 1px; margin-left: 3px">Observaciones:</p>
                <p style="margin-left: 10px; margin-top: -10px !important; font-size: small">{{$data['observacion']}}</p>
            </div>
        </div>
        <div>
            <h4 class="margin-titulos">{{ $cantidad }}</h4>
            <h4 class="margin-titulos">CULIACAN SINALOA A 01 DE {{ strtoupper($data["mes"]) }}</h4>
            <div class="card-obs">
                <p style="margin-top: 1px; margin-left: 3px">Avisos:</p>
                @if(isset($data['aviso']))
                    <p style="margin-left: 10px; margin-top: -10px !important; font-size: small">{{$data['aviso']}}</p>
                @else
                @endif
            </div>
        </div>
    </main>
    <hr>


@else

    <main>
        <div>
            <div class="titulo-pdf">
                <h3>RECIBO DE ARRENDAMIENTO</h3>
            </div>
        </div>
        <div>
            <div class="display-inline">
                <h5 class="margin-titulos">NOMBRE DEL ARRENDATARIO</h5>
                <h5 class="margin-titulos">DOMICILIO FINCA ARRENDADA</h5>
                <h5 class="margin-titulos">MES A CUBRIR</h5>
            </div>

            <div class="display-inline">
                <h5 class="margin-titulos margin-izq">{{ $data["arrendatario"] }}</h5>
                <h5 class="margin-titulos margin-izq">{{ $data['finca_arrendada'] }}</h5>
                <h5 class="margin-titulos margin-izq">{{ strtoupper($data['mes']) }}</h5>
            </div>
        </div>
        <div>
            <div style="width: 200px; height: 120px; margin-top: 40px" class="display-inline">
                <h5 class="margin-titulos">IMPORTE DE LA RENTA</h5>
                <h5 class="margin-titulos">-BONIF.P.P</h5>
                <h5 class="margin-titulos">SUBTOTAL</h5>
                @if($data['mantenimiento'] != '$0.00')
                    <h5 class="margin-titulos">MANTENIMIENTO</h5>
                @else
                @endif
                @if($data['cuota_agua'] != '$0.00')
                    <h5 class="margin-titulos">CUOTA DE AGUA</h5>
                @else
                @endif
                <h5 class="margin-titulos">TOTAL</h5>
            </div>

            <div  style="width: 150px; height: 120px; text-align: right" class="display-inline">
                <h5 class="margin-titulos margin-izq">{{$data['importe']}}</h5>
                <h5 class="margin-titulos margin-izq">-{{$data['bonificacion']}}</h5>
                <h5 style="border-top: black 2px solid" class="margin-titulos margin-izq">{{$data['subtotal']}}</h5>
                @if($data['mantenimiento'] != '$0.00')
                    <h5 class="margin-titulos margin-izq">{{$data['mantenimiento']}}</h5>
                @else
                @endif
                @if($data['cuota_agua'] != '$0.00')
                    <h5 class="margin-titulos margin-izq">{{$data['cuota_agua']}}</h5>
                @else
                @endif
                <h5 style="border-top: black 5px double" class="margin-titulos margin-izq">{{$data["total"]}}</h5>
            </div>
            <div style="margin-top: -10px" class="card-pdf">
                <p style="margin-top: 1px; margin-left: 3px">Observaciones:</p>
                <p style="margin-left: 10px; margin-top: -10px !important; font-size: small">{{$data['observacion']}}</p>
            </div>
        </div>
        <div>
            <h4 class="margin-titulos">{{ $cantidad }}</h4>
            <h4 class="margin-titulos">CULIACAN SINALOA A 01 DE {{ strtoupper($data["mes"]) }}</h4>
            <div class="card-obs">
                <p style="margin-top: 1px; margin-left: 3px">Avisos:</p>
                @if(isset($data['aviso']))
                    <p style="margin-left: 10px; margin-top: -10px !important; font-size: small">{{$data['aviso']}}</p>
                @else
                @endif
            </div>
        </div>
    </main>
    <hr>


    @if(isset($data['complemento']))
        <main>
            <div>
                <div class="titulo-pdf">
                    <h3>RECIBO DE ARRENDAMIENTO</h3>
                </div>
            </div>
            <div>
                <div class="display-inline">
                    <h5 class="margin-titulos">NOMBRE DEL ARRENDATARIO</h5>
                    <h5 class="margin-titulos">DOMICILIO FINCA ARRENDADA</h5>
                    <h5 class="margin-titulos">MES A CUBRIR</h5>
                </div>

                <div class="display-inline">
                    <h5 class="margin-titulos margin-izq">{{ $data["arrendatario"] }}</h5>
                    <h5 class="margin-titulos margin-izq">{{ $data['finca_arrendada'] }}</h5>
                    <h5 class="margin-titulos margin-izq">{{ strtoupper($data['mes']) }}</h5>
                </div>
            </div>
            <div>
                <div style="margin-top: -80px" class="display-inline">
                    <h5 class="margin-titulos">COMPLEMENTO DE DEPOSITO</h5>
                </div>

                <div class="display-inline">
                    <h5 class="margin-titulos margin-izq">{{$data['complemento']}}</h5>
                </div>
                <div style="margin-top: 50px" class="card-pdf">
                    <p style="margin-top: 1px; margin-left: 3px">Observaciones:</p>
                    <p style="margin-left: 10px; margin-top: -10px !important; font-size: small">Recibo por complemento de deposito</p>
                </div>
            </div>
            <div>
                <h4 class="margin-titulos">{{ $data['cantidad_dif'] }}</h4>
                <h4 class="margin-titulos">CULIACAN SINALOA A 01 DE {{ strtoupper($data["mes"]) }}</h4>
                <div class="card-obs">
                    <p style="margin-top: 1px; margin-left: 3px">Avisos:</p>
                    @if(isset($data['aviso']))
                        <p style="margin-left: 10px; margin-top: -10px !important; font-size: small">{{$data['aviso']}}</p>
                    @else
                    @endif
                </div>
            </div>
        </main>
    @else
    @endif

    @if(isset($data['deposito_check']))
        <main>
            <div>
                <div class="titulo-pdf">
                    <h3>RECIBO DE ARRENDAMIENTO</h3>
                </div>
            </div>
            <div>
                <div class="display-inline">
                    <h5 class="margin-titulos">NOMBRE DEL ARRENDATARIO</h5>
                    <h5 class="margin-titulos">DOMICILIO FINCA ARRENDADA</h5>
                    <h5 class="margin-titulos">MES A CUBRIR</h5>
                </div>

                <div class="display-inline">
                    <h5 class="margin-titulos margin-izq">{{ $data["arrendatario"] }}</h5>
                    <h5 class="margin-titulos margin-izq">{{ $data['finca_arrendada'] }}</h5>
                    <h5 class="margin-titulos margin-izq">{{ strtoupper($data['mes']) }}</h5>
                </div>
            </div>
            <div style="margin-top: 30px">
                <div style="margin-top: -80px" class="display-inline">
                    <h5 class="margin-titulos">DEPOSITO EN GARANTIA</h5>
                </div>

                <div class="display-inline">
                    <h5 class="margin-titulos margin-izq">{{$data['deposito']}}</h5>
                </div>
                <div style="margin-top: 60px" class="card-pdf">
                    <p style="margin-top: 1px; margin-left: 3px">Observaciones:</p>
                    <p style="margin-left: 10px; margin-top: -10px !important; font-size: small">Recibo por deposito en garantia</p>
                </div>
            </div>
            <div>
                <h4 class="margin-titulos">{{ $data['deposito_letra'] }}</h4>
                <h4 class="margin-titulos">CULIACAN SINALOA A 01 DE {{ strtoupper($data["mes"]) }}</h4>
                <div class="card-obs">
                    <p style="margin-top: 1px; margin-left: 3px">Avisos:</p>
                    @if(isset($data['aviso']))
                        <p style="margin-left: 10px; margin-top: -10px !important; font-size: small">{{$data['aviso']}}</p>
                    @else
                    @endif
                </div>
            </div>
        </main>
        <hr>
    @else
    @endif

@endif

</body>
</html>
