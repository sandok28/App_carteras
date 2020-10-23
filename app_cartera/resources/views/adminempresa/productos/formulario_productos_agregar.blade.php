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
                        <div class="card-header">Agregar producto a Bodega</div>
                        <div class="card-body">
                            @include('Partials.formularios.alerta_validaciones')
                            
                            {!! Form::model($producto, ['route' => ['empresa.productos.agregar', $producto], 'method' => 'PUT']) !!}
                                
                            <div class="form-group">
                            {!! Form::label('cantidad', 'Cantidad del producto ('.($producto->nombre).') que desea agregar a la bodega' , ['for' => 'exampleFormControlInput1']) !!}
                            {!! Form::number('cantidad1', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1']) !!}
                            
                        </div>
                                
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


