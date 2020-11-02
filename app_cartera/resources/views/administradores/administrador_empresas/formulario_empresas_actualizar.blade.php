@extends('layouts.app')



@section('titulo_pigina')
    Editar empresa
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
                        <div class="card-header">Editar empresa</div>
                        <div class="card-body">
                            @include('Partials.formularios.alerta_validaciones')
                            
                            {!! Form::model($empresa, ['route' => ['administrador.administrador_empresas.empresas_actualizar', $empresa], 'method' => 'PUT']) !!}

                                @include('administradores.administrador_empresas.formulario')

                                <div class="form-group">
                                    {!! Form::label('cedula', 'Cedula', ['for' => 'exampleFormControlInput1']) !!}
                                    {!! Form::number('cedula', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('direccion', 'Direccion', ['for' => 'exampleFormControlInput1']) !!}
                                    {!! Form::text('direccion', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('correo', 'Correo electronico', ['for' => 'exampleFormControlInput1']) !!}
                                    {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('contraseña', 'Password', ['for' => 'exampleFormControlInput1']) !!}
                                    {!! Form::text('contrasena', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1']) !!}
                                </div>


                                {!! Form::submit('Actualizar', ['class' => 'btn btn-success'] ) !!}
                                <a class="btn btn-primary " type="button" href="{{ route('administrador.administrador_empresas')}}">Volver</a>
                            
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
 
@endsection


