
@extends('layouts.app')



@section('titulo_pigina')
    Carterista
@endsection

@section('content_css')
       
@endsection

@section('content')
    <main>
    @include('Partials.general.alertas')
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-12">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="chevrons-right"></i></div>
                                {{is_null($cartera) ? 'Sin cartera' : $cartera->nombre}}
                            </h1>
                            <div class="page-header-subtitle">
                                {{is_null($cartera) ? 'No cuenta con carteras asignadas para hoy.' : $cartera->descripcion}}
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container mt-n10"><!-- Styled timeline component example -->
            <div class="timeline">
                @if(!is_null($clientes_por_atender))
                    @foreach($clientes_por_atender as $cliente)                    
                        <div class="timeline-item">                        
                            <div class="timeline-item-content pt-0">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        
                                        @if(Str::of($cliente->created_at)->substr(0,10) == $current_date)
                                            <h5 class="text-primary"><a href = "{{route('carterista.gestion_cliente_cartera',$cliente->id)}}">{{$cliente->posicion}} - {{$cliente->nombre}} </a><span class="badge badge-dark">Nuevo - Pendiente</span></h5>                                            
                                        @else 
                                            <h5 class="text-primary"><a href = "{{route('carterista.gestion_cliente_cartera',$cliente->id)}}">{{$cliente->posicion}} - {{$cliente->nombre}} </a><span class="badge badge-warning">Pendiente</span></h5>
                                            
                                        @endif
                                        
                                        {{$cliente->direccion}}
                                        </br>
                                        Deuda: ${{$cliente->deuda}}
                                    </div>
                                </div>
                            </div>
                        </div>                   
                    @endforeach
                @endif
                @if(!is_null($clientes_atendidos))
                    @foreach($clientes_atendidos as $cliente)
                        <div class="timeline-item">                        
                            <div class="timeline-item-content pt-0">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="text-primary"><a href = "{{route('carterista.gestion_cliente_cartera',$cliente->id)}}">{{$cliente->posicion}} - {{$cliente->nombre}} </a> <span class="badge badge-success">Atendido</span></h5>
                                        {{$cliente->direccion}}
                                        </br>
                                        Deuda: ${{$cliente->deuda}}
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    @endforeach
                @endif
            </div>
        </div>
    </main>
@endsection

@section('content_js')

@endsection



