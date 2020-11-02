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
                        <div class="card-header">Actualizar cliente </div>
                        <div class="card-body">
                            @include('Partials.formularios.alerta_validaciones')
                            {!! Form::model($cliente, ['route' => ['carterista.clientes.clientes_actualizar', $cliente], 'method' => 'PUT']) !!}
                         
                                @include('carteristas.clientes.formulario')

                                <div class="form-group">
                                    {{Form::checkbox('estado', 'I', false)}}
                                    {!! Form::label('estado', 'Dar de baja el cliente.', ['for' => 'exampleFormControlInput1']) !!}
                                </div>

                                {!! Form::submit('Guardar', ['class' => 'btn btn-success'] ) !!}
                                <a class="btn btn-primary " type="button" href="{{ url()->previous() }}">Volver</a>
                                
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


