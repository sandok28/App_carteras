@extends('layouts.app')



@section('titulo_pigina')
    Actualizar cliente
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
                        <div class="card-header">Actualizar cliente</div>
                        <div class="card-body">
                            @include('Partials.formularios.alerta_validaciones')
                            
                            {!! Form::model($cliente, ['route' => ['cliente_listainactivos.actualizar', $cliente], 'method' => 'PUT']) !!}
                                
                                @include('adminempresa.lista_inactivos.formulario')
                                
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


