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
                        <div class="card-header">Activar cliente de lista negra</div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-icon" role="alert">
                                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <div class="alert-icon-aside">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="alert-icon-content">
                                     <!-- mensaje de error-->
                                        @foreach($errors->all() as $error)
                                            
                                            <h6>{{$error}}</h6>
                                            
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($tipo == 'error')
                                <div class="alert alert-danger alert-icon" role="alert">
                                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <div class="alert-icon-aside">
                                        <i class="far fa-flag"></i>
                                    </div>
                                    <div class="alert-icon-content">
                                    {{$message}}
                                    </div>
                                </div>
                            @endif

                            @if($tipo == 'message')
                                <div class="alert alert-success alert-dismissible" role="alert" style="margin-bottom: 1em;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {{$message}}
                                </div>
                                <br>
                            @endif

                            <!-- mensaje de error-->
                            {!! Form::model($cliente, ['route' => ['carterista.clientes.activar_cliente', $cliente->id], 'method' => 'PUT']) !!}
                         
                                    <div class="form-group">
                                        {!! Form::label('nombre', 'Nombre', ['for' => 'exampleFormControlInput1']) !!}
                                        {!! Form::text('nombre', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1', 'readonly']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('direccion', 'Direccion', ['for' => 'exampleFormControlInput1']) !!}
                                        {!! Form::text('direccion', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1', 'readonly']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('telefono', 'Telefono', ['for' => 'exampleFormControlInput1']) !!}
                                        {!! Form::number('telefono', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1', 'rows' => '3', 'readonly']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('cedula', 'Cedula', ['for' => 'exampleFormControlInput1']) !!}
                                        {!! Form::number('cedula', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1', 'rows' => '3', 'readonly']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('comentarios', 'Motivo', ['for' => 'exampleFormControlInput1']) !!}
                                        {!! Form::textarea('comentarios', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1', 'rows' => '3', 'readonly']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('deuda', 'Deuda', ['for' => 'exampleFormControlInput1']) !!}
                                        {!! Form::number('deuda', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1', 'rows' => '3', 'readonly']) !!}
                                    </div>
                        
                                {!! Form::submit('Activar', ['class' => 'btn btn-success'] ) !!}
                                <a class="btn btn-primary " type="button" href="{{ route('carterista.clientes.formulario_clientes_crear')}}">Volver</a>
                                
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


