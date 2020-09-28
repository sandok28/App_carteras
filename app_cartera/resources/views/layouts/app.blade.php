<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Plantilla boostrap -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <title>@yield('titulo_pigina')</title>
            
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" crossorigin="anonymous"></script>

    @yield('content_css')

</head>
<body class="nav-fixed">
        @guest
            @yield('content')
        @else
        <nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
            <a class="navbar-brand" href="index.html">DistriCartera</a>
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i data-feather="menu"></i></button>
            <form class="form-inline mr-auto d-none d-md-block">
                <div class="input-group input-group-joined input-group-solid">
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" />
                    <div class="input-group-append">
                        <div class="input-group-text"><i data-feather="search"></i></div>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav align-items-center ml-auto">
                        
                
                <li class="nav-item dropdown no-caret mr-2 dropdown-user">
                    
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="{{asset('img/icono.png')}}" /></a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="{{asset('img/icono.png')}}" />
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"> {{ Auth::user()->name }}</div>
                                <div class="dropdown-user-details-email">{{ Auth::user()->email }}</div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#!">
                            <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                            Cuenta
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                            Cerrar sesion
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                            <div class="sidenav-menu-heading">Administracion</div>
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="true" aria-controls="collapseDashboards">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Modulos
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse show" id="collapseDashboards" data-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                    <a class="nav-link" href="{{route('administrador.administrador_empresas')}}">
                                        Empresas
                                    </a>
                                    <a class="nav-link" href="{{route('administrador.administrador_usuarios')}}">
                                        Usuarios Administradores
                                    </a>
                                    
                                </nav>
                            </div>
                           
                        </div>
                    </div>
                    <div class="sidenav-footer">
                        <div class="sidenav-footer-content">
                            <div class="sidenav-footer-subtitle">Usuario en sesion</div>
                            <div class="sidenav-footer-title">{{ Auth::user()->name }}</div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                    @yield('content')
            </div>
        </div>

        @endguest
            
       
         <!-- Scripts -->
        <!--<script src="{{ asset('js/app.js') }}" defer></script>  pude er util mas adelante si nada falla borrar-->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
       <script src="{{ asset('js/scripts.js') }}" defer></script>
        @yield('content_js')
</body>
</html>
