
@extends('layouts.app')



@section('titulo_pigina')
    Carterista
@endsection

@section('content_css')
       
@endsection

@section('content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-12">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="chevrons-right"></i></div>
                                {{$cartera->nombre}}
                            </h1>
                            <div class="page-header-subtitle">
                                {{$cartera->descripcion}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container mt-n10"><!-- Styled timeline component example -->
            <div class="timeline">
                @foreach($clientes_por_atender as $cliente)                    
                    <div class="timeline-item">                        
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-primary"><a href = "{{route('carterista.gestion_cliente_cartera',$cliente->id)}}">{{$cliente->posicion}} - {{$cliente->nombre}} </a><span class="badge badge-warning">Pendiente</span></h5>
                                    {{$cliente->direccion}}
                                    </br>
                                    Deuda: ${{$cliente->deuda}}
                                </div>
                            </div>
                        </div>
                    </div>                   
                @endforeach
                @foreach($clientes_atendidos as $cliente)
                    <div class="timeline-item">                        
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-primary"><a href = "{{route('carterista.gestion_cliente_cartera',$cliente->id)}}">{{$cliente->nombre}} </a> <span class="badge badge-success">Atendido</span></h5>
                                    {{$cliente->direccion}}
                                    </br>
                                    Deuda: ${{$cliente->deuda}}
                                </div>
                            </div>
                        </div>
                    </div>                    
                @endforeach
            </div>
        </div>
    </main>
@endsection

@section('content_js')

@endsection



