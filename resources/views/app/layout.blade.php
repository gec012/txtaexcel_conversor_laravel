<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OSUNSa</title>

     <link rel="stylesheet" href="{{asset ('https://bootswatch.com/4/solar/bootstrap.min.css') }}" >
</head>
<style>
            .bg-item {
                background-color: #273746;
            }
            .bg-sub-item {
                color: #ecf0f1;
            }
            .bg-sub-item:hover {
                background-color: #7f85c0;
                color: black;
            }
            nav ul li{
                border-bottom: 1px solid orange;


            }
            .barra {

                height: relative;
            }
            
        </style>
        <link href="{{ asset('open-iconic/font/css/open-iconic-bootstrap.css') }}" rel="stylesheet"><link href="{{ asset('open-iconic/font/css/open-iconic-bootstrap.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
         <!-- Enlaces de los js -->
         <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/jquery.js') }}"></script>

        <script src="{{ asset('js/moment.min.js') }}"></script>

      <body>

   <div class="row">
        <div  class="col-md-3  barra bg-dark">

                   <nav class="navbar navbar-expand navbar-dark col-md-3  align-items-start fixed-top ">
                <div class="collapse navbar-collapse">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between" style="flex-direction:column;">
                        <li class="nav-item bg-sub-item" >
                            <a class="nav-link pl-0 text-nowrap active" href="{{ url('home') }}"><i class="fa fa-bullseye fa-fw"></i> <span class="font-weight-bold">Inicio</span></a>
                        </li>
                        <li class="nav-item bg-sub-item " >
                            <a class="nav-link pl-0 text-white"  href="{{ url('padron_sag') }}"><i class="fa fa-heart-o fa-fw"></i> <span class="d-none d-md-inline">Cargar el padron de afiliados</span></a>
                        </li>
                        <li class="nav-item bg-sub-item">
                            <a class="nav-link pl-0 text-white"  href="{{ url('cargaxls') }}"><i class="fa fa-heart-o fa-fw"></i> <span class="d-none d-md-inline">Cargar el padron de afiliados activos</span></a>
                        </li>

                        <li class="nav-item bg-sub-item">
                            <a class="nav-link pl-0 text-white"  href="{{ url('welcome') }}"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">Cargar Nuevo Archivos de Aportes</span></a>
                        </li>
                        <li class="nav-item bg-sub-item">
                            <a class=" nav-link pl-0 text-white" href="{{ url('reportes') }}"><i class="fa fa-heart fa-fw"></i> <span class="d-none d-md-inline">Ver informes</span></a>
                        </li>
                        <li class="nav-item dropdown bg-sub-item">
                        <a class="nav-link dropdown-toggle text-white" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ver Historial de Archivos subidos</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-white" href="{{ url('unsa') }}">Archivos UNSa</a>
                                    <a class="dropdown-item text-white" href="{{ url('sgap_todos') }}">Archivos afiliados SGAP</a>
                                    <a class="dropdown-item text-white" href="{{ url('sgap_activos') }}">Archivos afiliados activos SGAP</a>

                             </div>
                        </li>
                        <li class="nav-item dropdown bg-sub-item">
                        <a class="nav-link dropdown-toggle text-white" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ver Historial de Informes</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-white" href="{{ url('reportes_activos_sa') }}"> Informes de Activos sin aportes</a>
                                    <a class="dropdown-item text-white" href="{{ url('reportes_ca_inactivos') }}">Informes de afiliados inactivos que se recibieron aportes</a>
                                    <a class="dropdown-item text-white" href="{{ url('reportes_ca_sin_registro') }}">Informes de personas con aportes sin registrar</a>
                                    <a class="dropdown-item text-white" href="{{ url('reportes_sa_este_mes') }}">Informes de personas a los que no se le realizaron aportes el ultimo mes</a>

                             </div>
                        </li>


                    </ul>
                </div>
            </nav>
        </div>



            <div class="container col-md-9">
            
             <div class="row justify-content-right">
            @yield('content')
             </div>
            </div>
    </div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
</body>

</html>
