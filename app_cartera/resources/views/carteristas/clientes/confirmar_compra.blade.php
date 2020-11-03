@extends('layouts.app')

@section('titulo_pigina')
    Carterista
@endsection

@section('content')
    <main>
    @include('Partials.general.alertas')
        <!-- Main page content-->
        <div class="container mt-4">
            <!-- Account page navigation-->
            <hr class="mt-0 mb-4" />
            <div class="row">
                
                <div class="col-xl-12">
                    <!-- Account details card-->
                    <div class="card mb-4"> 
                        <div class="card-header">Resumen de la venta </div>
                        <div class="card-body">
                            

                            @foreach($resumen_venta->detalles_venta as $detalle_venta)
                                <div class="form-group">
                                    {!! Form::label('nombre','Producto: '.$detalle_venta->producto_nombre, ['for' => 'exampleFormControlInput1']) !!}
                                    </br>
                                    {!! Form::label('nombre','Cantidad: '.$detalle_venta->cantidad_vendida, ['for' => 'exampleFormControlInput1']) !!}
                                    </br>
                                    {!! Form::label('nombre','Subtotal: '.$detalle_venta->subtotal_vendido, ['for' => 'exampleFormControlInput1']) !!}
                                    </br>
                                    </br>
                                </div>
                            @endforeach
                            <div class="form-group">    
                                {!! Form::label('Total','Total de la venta: $'.$resumen_venta->total_venta, ['for' => 'exampleFormControlInput1']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('nombre','Deuda del cliente: $'.$resumen_venta->deuda_cliente, ['for' => 'exampleFormControlInput1']) !!}
                            </div>

                            <div class="form-group">                                 
                                <a class="btn btn-primary col-md-10" type="button" href="{{ route('carterista.cliente.formulario_pagar', $resumen_venta->cliente_id) }}">Recaudar</a>
                            </div>
                            <div class="form-group"> 
                                <a class="btn btn-danger col-md-10" type="button" href="{{ route('carterista.gestion_cliente_cartera', $resumen_venta->cliente_id) }}">Finalizar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


