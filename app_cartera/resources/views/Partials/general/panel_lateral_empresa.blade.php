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
                <a class="nav-link" href="{{route('empresa.empresa_carteras')}}">
                    Carteras
                </a>
                <a class="nav-link" href="{{route('empresa.bodeguistas')}}">
                    Bodeguistas
                </a>
                <a class="nav-link" href="{{route('empresa.empresa_carteristas')}}">
                    Carteristas
                </a>
                <a class="nav-link" href="{{route('empresa.empresa_productos')}}">
                    Productos
                </a>
                <a class="nav-link" href="{{route('empresa.listanegra')}}">
                    Lista negra clientes
                </a>
                <a class="nav-link" href="{{route('empresa.devoluciones')}}">
                    Devoluciones
                </a>
                                
            </nav>
        </div>        
    </div>
</div>
