@extends('layouts.app')



@section('titulo_pigina')
    Bodega
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
                    
                        <div class="card-header">Productos en la nevera de la cartera</div>
                        <div class="card-body">
                            @include('partials.formularios.alerta_validaciones')
                            
                            {!! Form::model($productos, ['route' => ['bodega.cargar_cartera',$cartera_id], 'method' => 'POST']) !!}
                                

                                @foreach($productos as $producto)

                                    <div class="form-group">
                                    {!! Form::label('nombre',$producto->nombre.' - (Cantidad en bodega '.$producto->cantidad.')', ['for' => 'exampleFormControlInput1']) !!}
                                    {!! Form::selectRange('cantidad',0,$producto->cantidad, null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1', 'name' => 'cantidad_producto_'.$producto->id]) !!}
                                        
                                    </div>
                                @endforeach
                        
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