
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
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">{{$cartera->nombre}}</div>
                                <div class="row center-md card-body">
                                    <div class="col-md-8"></div>
                                    <a class="btn btn-success col-md-2" type="button" href="{{ route('carterista.clientes.formulario_clientes_crear') }}">Registar cliente</a>
                                    <a class="btn btn-primary col-md-2" type="button" href="{{ url()->previous() }}">Volver</a>
                                
                                </div>
                                
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
                        <div class="timeline-item-marker">
                        <div class="timeline-item-marker-text">{{$cliente->posicion}}</div>
                            <div class="timeline-item-marker-indicator bg-warning-soft text-primary"><i data-feather="frown"></i></div>
                        </div>
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-primary">{{$cliente->nombre}}</h5>
                                    Direccion:{{$cliente->direccion}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($clientes_atendidos as $cliente)
                    <div class="timeline-item">
                        <div class="timeline-item-marker">
                        <div class="timeline-item-marker-text">{{$cliente->posicion}}</div>
                            <div class="timeline-item-marker-indicator bg-success-soft text-primary"><i data-feather="smile"></i></div>
                        </div>
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-primary">{{$cliente->nombre}}</h5>
                                    Direccion:{{$cliente->direccion}}
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



