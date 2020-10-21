@extends('layouts.app')



@section('titulo_pigina')
    Carterista
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
                    
                        <div class="card-header">Venta de productos</div>
                        <div class="card-body">
                            @include('Partials.formularios.alerta_validaciones')

                            {!! Form::model($productos, ['route' => ['carterista.cliente.formulario_cliente_pagar',$cliente_id], 'method' => 'POST']) !!}
                            
                                @foreach($productos as $producto)

                                    <div class="form-group">
                                    {!! Form::label('nombre','Producto: '.$producto->producto->nombre, ['for' => 'exampleFormControlInput1']) !!}
                                    </br>
                                    {!! Form::label('precio','Precio: $'.$producto->producto->precio, ['for' => 'exampleFormControlInput1']) !!}    
                                    {!! Form::number('cantidad', null, ['min' => '0', 'max' => $producto->cantidad,'class' => 'form-control', 'id' => 'exampleFormControlInput1', 'name' => 'cantidad_producto_'.$producto->id, 'placeholder'=>'Disponibles: '.$producto->cantidad ]) !!}
                                    

                                    </div>
                                @endforeach
                        
                                <div class="form-group">
                                    {!! Form::submit('Aceptar', ['class' => 'btn btn-success col-md-10'] ) !!}
                                    </br>
                                    <a class="btn btn-primary col-md-10" type="button" href="{{ route('carterista.gestion_cliente_cartera', $cliente_id) }}">Volver</a>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
 
@endsection


