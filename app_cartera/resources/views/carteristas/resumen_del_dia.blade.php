
@extends('layouts.app')

@section('titulo_pigina')
    Carterista
@endsection

@section('content_css')
       
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
                    <div class="card card-header-actions">
                        <div class="card-header">
                            Resumen del dia
                            <a class="btn btn-primary btn-sm" href="{{route('carterista')}}">Volver</a>

                            
                        </div>
                        <div class="card-body">
                            <p>Credito cartera anterior: {{$creditoinicial}}</p>
                            <p>Ventas del dia: {{$venta}}</p>
                            <p>Abonos del dia: {{$abono}}</p>
                            <p>saldo cartera: {{$saldo}}</p>
                            <p>total dinero de la cartera: {{$total}}</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('content_js')

@endsection
