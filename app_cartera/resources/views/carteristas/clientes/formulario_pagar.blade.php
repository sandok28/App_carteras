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
                    
                        <div class="card-header">Abono a deuda</div>
                        <div class="card-body">
                            @include('Partials.formularios.alerta_validaciones')

                            {!! Form::model($cliente, ['route' => ['carterista.cliente.recaudo',$cliente], 'method' => 'POST']) !!}
                                <div class="form-group">
                                    <label class="small mb-1" for="inputUsername">Cliente:  {{$cliente->nombre}}</label>  
                                    </br>  
                                    <label class="small mb-1" for="inputUsername">Cedula:  {{$cliente->cedula}}</label>                              
                                    </br>                            
                                    <label class="small mb-1" for="inputUsername">Direccion:  {{$cliente->direccion}}</label>                                
                                    </br>
                                    <label class="small mb-1" for="inputUsername">Telefono:  {{$cliente->telefonoo}}</label>                                
                                    </br>
                                    <label class="small mb-1" for="inputUsername">Deuda:  {{$cliente->deuda}}</label>                                
                                </div>
                            
                                <div class="form-group">
                                    {!! Form::label('Pago','Pago: ', ['for' => 'exampleFormControlInput1']) !!}    
                                    {!! Form::number('pago', null, ['min' => '0', 'max' => $cliente->deuda,'class' => 'form-control', 'id' => 'exampleFormControlInput1', 'placeholder'=>'Deuda actual: '.$cliente->deuda ]) !!}
                                </div>                               
                                    
                                <div class="form-group"> 
                                {!! Form::submit('Aceptar', ['class' => 'btn btn-success col-md-10'] ) !!}
                                </div>
                                <div class="form-group"> 
                                    <a class="btn btn-primary col-md-10" type="button" href="{{ route('carterista.gestion_cliente_cartera', $cliente->id) }}">Cancelar</a>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
 
@endsection


