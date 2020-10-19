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
                        <div class="card-header">Transaccion </div>
                        <div class="card-body">
                            

                            {!! Form::open(['route' => 'carterista.clientes.clientes_crear', 'method' => 'POST']) !!}

                                {!! Form::label('nombre','El total de la compra fue:', ['for' => 'exampleFormControlInput1']) !!}
                                {!! Form::label('total',$total, ['for' => 'exampleFormControlInput1']) !!}
                                {!! Form::label('nombre','Deuda anterior', ['for' => 'exampleFormControlInput1']) !!}
                                {!! Form::label('deuda',$deuda_cliente, ['for' => 'exampleFormControlInput1']) !!}

                                
                                <a class="btn btn-primary " type="button" href="{{ url()->previous() }}">Volver</a>
                                
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


