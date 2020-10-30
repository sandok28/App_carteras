
@extends('layouts.app')

@section('titulo_pigina')
    Carterista
@endsection

@section('content_css')
       
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
                        <div class="card-header">Gestion cliente </div>
                        <div class="card-body">

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
                                <a class="btn btn-success col-md-10" type="button" href="{{ route('carterista.cliente.formulario_cliente_venta',$cliente->id) }}">Vender</a>                          
                            </div>
                            <div class="form-group">
                                <a class="btn btn-success col-md-10" type="button" href="{{ route('carterista.cliente.formulario_pagar',$cliente->id) }}">Recaudar</a>                          
                            </div>                   
                            <div class="form-group">
                                <a class="btn btn-info col-md-10" type="button" href="{{ route('carterista.clientes.formulario_clientes_actualizar',$cliente->id) }}">Actualizar informacion</a>                          
                            </div>   
                            <div class="form-group">
                                <a class="btn btn-warning col-md-10" type="button" href="{{ route('carterista.devolucion.formulario_devolucion_crear',$cliente->id) }}">Devolucion</a>                          
                            </div>   
                            <div class="form-group">
                                <a class="btn btn-danger col-md-10" type="button" href="{{ route('carterista.cliente.formulario_reportar_lista_negra',$cliente->id) }}">Reportar</a>                          
                            </div> 
                            <div class="form-group">
                                <a class="btn btn-secondary col-md-10" type="button" href="{{ route('carterista.historial_cliente',$cliente->id) }}">Historial de transacciones</a>                          
                            </div>
                            <div class="form-group">
                                <a class="btn btn-primary col-md-10" type="button" href="{{ route('carterista') }}">Volver</a>                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('content_js')

@endsection



