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
                    
                        <div class="card-header">Descargar productos a la cartera</div>
                        <div class="card-body">
                            @include('partials.formularios.alerta_validaciones')
                            
                            {!! Form::model($producto_nevera, ['route' => ['bodega.descargar_cartera',$nevera_id], 'method' => 'POST']) !!}
                                

                                @foreach($producto_nevera as $nevera)

                                    <div class="form-group">
                                    {!! Form::label('nombre',$nevera->producto->nombre.' --> Cantidad en nevera ('.$nevera->cantidad.')'.' --> Cantidad en bodega ('.$nevera->producto->cantidad.')', ['for' => 'exampleFormControlInput1']) !!}
                                    {!! Form::selectRange('cantidad',0,$nevera->producto->cantidad, null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1']) !!}
                                        
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