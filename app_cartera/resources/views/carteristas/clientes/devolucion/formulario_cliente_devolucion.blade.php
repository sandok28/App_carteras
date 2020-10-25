@extends('layouts.app')



@section('titulo_pigina')
    Registras novedad
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
                        <div class="card-header">Registrar novedad</div>
                        <div class="card-body">
                            @include('Partials.formularios.alerta_validaciones')
                            {!! Form::model($novedad, ['route' => ['carterista.devolucion.devolucion_crear'], 'method' => 'POST']) !!}
                          
                                <div class="form-group">
                                    {!! Form::label('novedad', 'Descripcion', ['for' => 'exampleFormControlInput1']) !!}
                                    {!! Form::textarea('novedad', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1', 'rows' => '6']) !!}
                                </div>
                         

                                <div class="form-group"> 
                                {!! Form::submit('Registrar', ['class' => 'btn btn-success col-md-10'] ) !!}
                                </div>
                                <div class="form-group"> 
                                    <a class="btn btn-primary col-md-10" type="button" href="{{ route('carterista') }}">Cancelar</a>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection