<div class="sidenav-menu">
    <div class="nav accordion" id="accordionSidenav">
        <div class="sidenav-menu-heading">Carterista</div>
        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="true" aria-controls="collapseDashboards">
            <div class="nav-link-icon"><i data-feather="activity"></i></div>
            Acciones
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse show" id="collapseDashboards" data-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                <a class="nav-link" href="{{route('carterista')}}">
                    Cartera
                </a>
                <a class="nav-link" href="{{route('carterista.clientes.formulario_clientes_crear')}}">
                    Registar cliente
                </a>
                <a class="nav-link" href="{{ route('carterista.bono.formulario_bono_crear') }}">
                    Registar bono
                </a>
                <a class="nav-link" href="{{ route('carterista.novedad.formulario_novedad_crear') }}">
                    Registrar Novedad
                </a>
                <a class="nav-link" href="{{ route('carterista.clientes.formulario_clientes_ordenar') }}">
                    Ordenar clientes
                </a>                
            </nav>

        </div>
        
    </div>
</div>
