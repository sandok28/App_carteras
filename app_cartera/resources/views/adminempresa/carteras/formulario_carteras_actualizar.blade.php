@extends('layouts.app')



@section('titulo_pigina')
    Editar cartera
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
                        <div class="card-header">Editar cartera</div>
                        <div class="card-body">
                            @include('Partials.formularios.alerta_validaciones')
                            
                            {!! Form::model($cartera, ['route' => ['empresa.empresa_cartera.empresa_cartera_actualizar', $cartera], 'method' => 'PUT']) !!}
                                
                                @include('adminempresa.carteras.formulario')
                                
                                {!! Form::submit('Actualizar', ['class' => 'btn btn-success'] ) !!}
                                <a class="btn btn-primary " type="button" href="{{ route('empresa.empresa_carteras')}}">Volver</a>
                            
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
 
@endsection


