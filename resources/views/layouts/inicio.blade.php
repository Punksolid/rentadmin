@extends ('layouts.admin')
@section ('contenido')

<img class="imagen-inicio fondo-inicio" width="100%" src="{{asset('img/inicio/inicio_fondo.jpg')}}">

<div class="row">
    <div class="container">
        <a href="{{url('catalogos/arrendador')}}"><img class="imagen-inicio imagen-arrendador" src="{{asset('img/inicio/inicio_arrendador.png')}}">
        <h2 class="arrendador iconos-res imagen-inicio url">Arrendador</h2></a>

        <a href="{{url('catalogos/arrendatario')}}"><img class="imagen-inicio imagen-arrendatario" src="{{asset('img/inicio/inicio_arrendatario.png')}}">
        <h2 class="arrendatario iconos-res imagen-inicio url">Arrendatario</h2></a>

        <a href="{{url('contrato')}}"><img class="imagen-inicio imagen-contrato" src="{{asset('img/inicio/inicio_contrato.png')}}">
        <h2 class="contrato iconos-res imagen-inicio url">Contrato</h2></a>

        <a href=""><img class="imagen-inicio imagen-inmuebles" src="{{asset('img/inicio/inicio_inmuebles.png')}}">
        <h2 class="inmuebles iconos-res imagen-inicio url">Liquidacion</h2></a>

        <a href="{{url('recibos-automaticos')}}"><img class="imagen-inicio imagen-liquidacion" src="{{asset('img/inicio/inicio_liquidacion.png')}}">
        <h2 class="liquidacion iconos-res imagen-inicio url">Recibo</h2></a>

        <a href="{{url('catalogos/finca')}}"><img class="imagen-inicio imagen-recibo" src="{{asset('img/inicio/inicio_recibo.png')}}">
        <h2 class="recibo iconos-res imagen-inicio url">Inmuebles</h2></a>
    </div>
</div>

@endsection
