@extends('layouts.app')



@section('titulo_pigina')
    Actualizar empresa
@endsection



@section('content')

    <main>
        <!-- Main page content-->
        <div class="container mt-4">
            <!-- Account page navigation-->
            <hr class="mt-0 mb-4" />
            <div class="row">
                
                <div class="col-xl-12">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Actualizar cartera</div>
                        <div class="card-body">
                            @include('partials.formularios.alerta_validaciones')
                            
                            {!! Form::model($cartera, ['route' => ['administrador.administrador_carteras.carteras_actualizar', $cartera], 'method' => 'PUT']) !!}
                                
                                @include('administradores.administrador_carteras.formulario')
                                
                                {!! Form::submit('Actualizar', ['class' => 'btn btn-success'] ) !!}
                                <a class="btn btn-primary " type="button" href="{{ url()->previous() }}">Volver</a>
                            
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
 
@endsection


