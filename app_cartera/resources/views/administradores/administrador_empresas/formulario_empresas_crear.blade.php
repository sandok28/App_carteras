@extends('layouts.app')



@section('titulo_pigina')
    Crear empresa
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
                        
                        <div class="card-header">Registrar empresa</div>
                        <div class="card-body">
                            @include('Partials.formularios.alerta_validaciones')
                         
                            {!! Form::open(['route' => 'administrador.administrador_empresas.empresas_crear', 'method' => 'POST']) !!}
                            
                                @include('administradores.administrador_empresas.formulario')
                                {!! Form::submit('Guardar', ['class' => 'btn btn-success'] ) !!}
                                <a class="btn btn-primary " type="button" href="{{ url()->previous() }}">Volver</a>
                                
                            {!! Form::close() !!}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main> 
@endsection


