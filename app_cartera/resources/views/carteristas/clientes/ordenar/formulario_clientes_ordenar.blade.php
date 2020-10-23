
@extends('layouts.app')



@section('titulo_pigina')
    Ordenar clientes
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
                                Ordene los clientes en las posiciones deseadas y al final hacer click en "Guardar cambios"
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container mt-n10"><!-- Styled timeline component example -->
            <div class="timeline">
                @include('Partials.formularios.alerta_validaciones')

                {!! Form::model($clientes, ['route' => ['carterista.clientes.clientes_ordenar'], 'method' => 'POST']) !!}
                @foreach($clientes as $cliente)                    
                    <div class="timeline-item">                        
                        <div class="timeline-item-content pt-0">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-primary">{{$cliente->nombre}}<span class="badge badge-cyan">En edicion</span></h5>
                                    <div class="row">
                                        <div class="col-md-2">
                                            Posicion:    {!! Form::number('posicion', $cliente->posicion, ['style' => 'width : 20%;border: none; border-color: transparent;', 'id' => 'id_cliente_posicion_'.$cliente->id, 'name' => 'cliente_posicion_'.$cliente->id, 'disabled']) !!}   
                                        </div>
                                        <div class="col-md-2">
                                         
                                        </div>
                                        <div class="col-md-8">
                                        </div>
                                    </div>
                                    </br>
                                    {{$cliente->direccion}}
                                    
                                </div>
                            </div>
                        </div>
                    </div>                   
                @endforeach
                {!! Form::close() !!}
                
            </div>
        </div>
    </main>
@endsection

@section('content_js')

@endsection



