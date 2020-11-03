
@extends('layouts.app')



@section('titulo_pigina')
    Bodega
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
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">Carteras de la empresa</div>
                                <div class="row center-md card-body">
                                    <div class="col-md-8"></div>
                                    
                                    
                                
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
                @foreach($carteras_por_atender as $cartera)
                    <div class="timeline-item">
                        <div class="timeline-item-marker">
                        <div class="timeline-item-marker-text"></div>
                            <div class="timeline-item-marker-indicator bg-warning-soft text-primary"><i data-feather="x"></i></div>
                        </div>
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-primary">{{$cartera->nombre}}</h5>
                                    Direccion:{{$cartera->descripcion}}
                                </div>
                                <a class="btn btn-primary col-md-2" type="button" href="{{route('bodega.formulario_cargar_cartera',$cartera->id)}}">Cargar</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($carteras_atendidas as $cartera)
                    <div class="timeline-item">
                        <div class="timeline-item-marker">
                        <div class="timeline-item-marker-text"></div>
                            <div class="timeline-item-marker-indicator bg-success-soft text-primary"><i data-feather="check"></i></div>
                        </div>
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-primary">{{$cartera->nombre}}</h5>
                                    Direccion:{{$cartera->descripcion}}
                                </div>
                                <a class="btn btn-primary col-md-2" type="button" href="{{route('bodega.informacion_carga_cartera',$cartera->id)}}">Cargar</a>
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