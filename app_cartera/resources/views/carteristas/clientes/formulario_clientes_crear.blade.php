@extends('layouts.app')

@section('titulo_pigina')
    Crear cartera
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
                        <div class="card-header">Registrar cliente </div>
                        <div class="card-body">
                            @include('Partials.formularios.alerta_validaciones')

                            {!! Form::open(['route' => 'carterista.clientes.clientes_crear', 'method' => 'POST']) !!}
                         
                                @include('carteristas.clientes.formulario')

                                <div class="form-group"> 
                                    {!! Form::submit('Guardar', ['class' => 'btn btn-success  col-md-10'] ) !!}
                                </div>
                                <div class="form-group"> 
                                    <a class="btn btn-primary  col-md-10" type="button" href="{{ route('carterista') }}">Volver</a>
                                </div>
                                
                                
                                
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


