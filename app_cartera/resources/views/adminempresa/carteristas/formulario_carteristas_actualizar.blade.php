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
                        <div class="card-header">Actualizar carterista</div>
                        <div class="card-body">
                            @include('partials.formularios.alerta_validaciones')
                            
                            {!! Form::model($usuario, ['route' => ['empresa.empresa_carteristas.empresa.carteristas_actualizar', $usuario], 'method' => 'PUT']) !!}
                                
                                @include('adminempresa.carteristas.formulario')

                                <div class="form-group">
                                {!! Form::label('email', 'Email', ['for' => 'exampleFormControlInput1']) !!}
                                {!! Form::text('email', ( empty($usuario) ? '' : $usuario->correo_user()), ['class' => 'form-control','disabled' => 'true', 'id' => 'exampleFormControlInput1']) !!}
                                <a class="btn btn-primary " type="button" href="{{ route('empresa.carterista.formulario_correo_carterista_actualizar',$usuario->id)}}">Editar Email</a>
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


