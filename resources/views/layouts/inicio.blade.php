@extends ('layouts.layout-v2')
@section('page_title','Panel de Inicio')
@section ('contenido')

<div class="row">



</div>
<div class="row">
    <div class="col-md-6 col-sm-9 col-xs-12">
        <div class="info-box">
            <a href="{{route('arrendador.index')}}">
                <span class="info-box-icon bg-aqua">
                    <img src="{{asset('img/inicio/inicio_arrendador.png') }}"/>
                </span>
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Arrendadores</span>
                <span class="info-box-number">{{ $lessors }}<small></small></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-6 col-sm-9 col-xs-12">
        <div class="info-box">
            <a href="{{url('catalogos/arrendatario')}}">
                <span class="info-box-icon bg-red"><img src="{{asset('img/inicio/inicio_arrendatario.png')}}"></span>
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Arrendatarios</span>
                <span class="info-box-number">{{ $lessees }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-6 col-sm-9 col-xs-12">
        <div class="info-box">
            <a href="{{url('contrato')}}">
                <span class="info-box-icon bg-green"><img src="{{asset('img/inicio/inicio_contrato.png')}}"></span>
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Contratos</span>
                <span class="info-box-number">{{ $contracts }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-6 col-sm-9 col-xs-12">
        <div class="info-box">
            <a href="{{ route('liquidaciones.index') }}">
                <span class="info-box-icon bg-yellow"><img src="{{asset('img/inicio/inicio_inmuebles.png')}}"></span>
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Liquidaciones</span>
                <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-6 col-sm-9 col-xs-12">
        <div class="info-box">
            <a href="{{ route('tickets.index') }}">
                <span class="info-box-icon bg-yellow"><img src="{{asset('img/inicio/inicio_liquidacion.png')}}"></span>
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Recibos</span>
                <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-md-6 col-sm-9 col-xs-12">
        <div class="info-box">
            <a href="{{ route('finca.index') }}">
                <span class="info-box-icon bg-yellow"><img src="{{asset('img/inicio/inicio_recibo.png')}}"></span>
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Inmuebles</span>
                <span class="info-box-number">{{ $properties }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
@endsection
