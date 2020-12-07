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
@if(isset($data['deposito']) && $data['deposito'] == 'true')
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
            <h5 class="margin-titulos margin-izq">{{$data['total']}}</h5>
        </div>
        <div style="margin-top: 60px" class="card-pdf">
            <p style="margin-top: 1px; margin-left: 3px">Observaciones:</p>
            <p style="margin-left: 10px; margin-top: -10px !important; font-size: small">Recibo por deposito en garantia</p>
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
@endif
@if(isset($data['complemento']) && $data['complemento'] == 'true')
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
                <h5 class="margin-titulos">COMPLEMENTO DE DEPOSITO</h5>
            </div>

            <div class="display-inline">
                <h5 class="margin-titulos margin-izq">{{$data['total']}}</h5>
            </div>
            <div style="margin-top: 60px" class="card-pdf">
                <p style="margin-top: 1px; margin-left: 3px">Observaciones:</p>
                <p style="margin-left: 10px; margin-top: -10px !important; font-size: small">Recibo por complemento de deposito</p>
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
@endif
</body>

</html>
