@extends('layouts.app')



@section('titulo_pigina')
    Registras novedad
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
                        <div class="card-header">Registrar devolucion</div>
                        <div class="card-body">
                            @include('Partials.formularios.alerta_validaciones')
                            {!! Form::model($cliente, ['route' => ['carterista.devolucion.devolucion_crear',$cliente], 'method' => 'POST']) !!}
                          
                                <div class="form-group">
                                    {!! Form::label('producto', 'Producto devuelto', ['for' => 'exampleFormControlInput1']) !!}
                                    {{ Form::select('producto_devuelto_id', $productos, null, ['class'=>'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('cantidad', 'Cantidad', ['for' => 'exampleFormControlInput1']) !!}
                                    {!! Form::number('producto_devuelto_cantidad', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('producto', 'Producto a entregar', ['for' => 'exampleFormControlInput1']) !!}
                                    {{ Form::select('producto_entregado_id', $productos, null, ['class'=>'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('cantidad', 'Cantidad', ['for' => 'exampleFormControlInput1']) !!}
                                    {!! Form::number('producto_entregado_cantidad', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1']) !!}
                                </div>
                                
                                <div class="form-group"> 
                                    {!! Form::submit('Guardar', ['class' => 'btn btn-success  col-md-10'] ) !!}
                                </div>
                                <div class="form-group"> 
                                    <a class="btn btn-primary col-md-10" type="button" href="{{ route('carterista.gestion_cliente_cartera',$cliente->id) }}">Cancelar</a>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection