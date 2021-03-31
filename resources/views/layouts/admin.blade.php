<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Broker</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" type="text/plain" href="https://adminlte.io/themes/AdminLTE/dist/css/skins/skin-red.min.css">

    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <script src="https://kit.fontawesome.com/73137342dd.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script type="text/plain" src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
</head>

<body class="skin-red sidebar-mini" style="height: auto; min-height: 100%;">
<div class="wrapper" style="height: auto; min-height: 100%;">

    <header class="main-header">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">BI</span>
            <!-- logo for regular state and mobile devices -->
            <img id="logo" src="{{ asset('img/menu/logo.png') }}" width="120px" alt="Logo">
        </a>


        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Navegación</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a id="navusr" href="#" class="dropdown-toggle drop" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span class="hidden-xs">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <p style="color: black">
                                    ...
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">

                                <div class="pull-right">
                                    <a href="{{ action('AuthController@logOut') }}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <span class="logo-menu"><img src="{{asset('img/menu/logo.png')}}" width="120px" alt="Logo"></span>
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header"></li>

                <li class="treeview">
                    <a href="">
                        <img src="{{asset('img/menu/catgen.png')}}" width="25px">
                        <span style="background-color: #E5E5E5"> Catalogos</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('catalogos/arrendador')}}"><img src="{{asset('img/menu/arrendador.png')}}" width="20px">&nbsp;&nbsp; Arrendadores</a></li>
                        <li><a href="{{ url('catalogos/arrendatario')}}"><img src="{{asset('img/menu/arrendatario.png')}}" width="20px">&nbsp;&nbsp; Arrendatarios</a></li>
                        <li><a href="{{ url('catalogos/finca')}}"><img src="{{asset('img/menu/finca.png')}}" width="20px">&nbsp;&nbsp; Inmuebles</a></li>
                        <li><a href="{{ url('subcatalogos/tipo-incidente')}}" ><img src="{{asset('img/menu/tipoincidente.png')}}" width="20px">&nbsp; Tipo de Incidente</a></li>
                        <li><a href="{{ url('subcatalogos/tipo-mantenimiento')}}" ><img src="{{asset('img/menu/tipomantenimiento.png')}}" width="20px">&nbsp; Tipo de Mantenimiento</a></li>
                        <li><a href="{{ url('subcatalogos/tipo-propiedad')}}" ><img src="{{asset('img/menu/tipopropiedad.png')}}" width="20px">&nbsp; Tipo de Propiedad</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('contrato')}}"><img src="{{asset('img/menu/contrato.png')}}" width="25px"> <span style="background-color: #E5E5E5">Contrato o Convenio</span></a>
                </li>

                <li>
                    <a href="{{ url('recibos-automaticos')}}"><img src="{{asset('img/menu/recibo.png')}}" width="25px"> <span style="background-color: #E5E5E5">Recibos automaticos</span></a>
                </li>

                <li>
                    <a href="{{ url('control-pago')}}"><img src="{{asset('img/menu/ControlDePago.png')}}" width="25px"> <span style="background-color: #E5E5E5">Control de Pagos</span></a>
                </li>

                <li>
                    <a href="{{ url('mantenimiento')}}"><img src="{{asset('img/menu/mantenimiento.png')}}" width="25px"> <span style="background-color: #E5E5E5">Mantenimiento</span></a>
                </li>

                <li>
                    <a href="{{ url('incidentes')}}"><img src="{{asset('img/menu/incidentes.png')}}" width="25px"> <span style="background-color: #E5E5E5">Incidentes</span></a>
                </li>

                <li>
                    <a href="{{ url('reportes')}}"><img src="{{asset('img/menu/reporte.png')}}" width="25px"> <span style="background-color: #E5E5E5">Reportes</span></a>
                </li>

                <li>
                    <a href="{{ url('liquidaciones')}}"><img src="{{asset('img/menu/liquidacion.png')}}" width="25px"> <span style="background-color: #E5E5E5">Liquidacion</span></a>
                </li>

                <li class="treeview">
                    <a href="">
                        <img src="{{asset('img/menu/acceso.png')}}" width="25px"> <span style="background-color: #E5E5E5">Seguridad</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('seguridad/usuarios')}}"><img src="{{asset('img/menu/user.png')}}" width="20px"> Usuarios</a></li>
                        <li><a href=""><img src="{{asset('img/menu/permiso.png')}}" width="20px"> Permisos de Usuarios</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('configuracion')}}"><img src="{{asset('img/menu/config.png')}}" width="25px"> <span style="background-color: #E5E5E5">Configuracion</span></a>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!--Contenido-->1
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 876px;">
        <section class="content-header">
            <h1>
                @yield('page_title')
                <small></small>
            </h1>
{{--            <ol class="breadcrumb">--}}
{{--                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
{{--                <li class="active">Dashboard</li>--}}
{{--            </ol>--}}
        </section>
        <!-- Main content -->
        <section class="content container-fluid">


                                    <!--Contenido-->
                                    @yield('contenido')
                                    <!--Fin Contenido-->

            <!-- /.box -->
        </section>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<!-- /.content -->
</div>
@yield('after-content')

<!-- /.content-wrapper -->
<!--Fin-Contenido-->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2020</strong> All rights reserved.
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script type="text/javascript">
    @yield('javascript')
</script>
{{--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>--}}
<script src="{{asset('js/jquery.js')}}"></script>

<script src="{{asset('js/app.min.js')}}"></script>

<script src="{{asset('js/telefono.js')}}"></script>
<script src="{{asset('js/email.js')}}"></script>
<script src="{{asset('js/telfiador.js')}}"></script>
<script src="{{asset('js/banco.js')}}"></script>
<script src="{{asset('js/fechas-contrato.js')}}"></script>
<script src="{{asset('js/propiedad.js')}}"></script>
<script src="{{asset('js/contrato.js')}}"></script>
<script src="{{asset('js/usuario.js')}}"></script>
<script src="{{asset('js/recibos-automaticos.js')}}"></script>

</body>

</html>
