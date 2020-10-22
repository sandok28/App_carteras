
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
                                   
                                    <div class="form-group col-md-10">
                                        <a class="btn btn-success col-md-12" type="button" href="{{ route('carterista.clientes.formulario_clientes_crear') }}">Registar cliente</a>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <a class="btn btn-success col-md-12" type="button" href="{{ route('carterista.bono.formulario_bono_crear') }}">Registar bono</a>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <a class="btn btn-success col-md-12" type="button" href="{{ route('carterista.clientes.formulario_clientes_crear') }}">Registar bono</a>
                                    </div>                                
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
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-primary"><a href = "{{route('carterista.gestion_cliente_cartera',$cliente->id)}}">{{$cliente->nombre}} </a><span class="badge badge-warning">Pendiente</span></h5>
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
                                    <h5 class="text-primary"><a href = "#">{{$cliente->nombre}} </a> <span class="badge badge-success">Atendido</span></h5>
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



