@extends('layouts.app')



@section('titulo_pigina')
    Lista transacciones de la empresa
@endsection

@section('content_css')
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
@endsection

@section('content')
    <main>
    @include('Partials.general.alertas')
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-12">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Panel de visualizacion de Cuentas</div>
                                <div class="row center-md card-body">
                                
                                    <div class="col-md-8"></div>
                                   
                                    <a class="btn btn-primary col-md-2" type="button" href="{{route('empresa.empresa_carteras')}}">Volver</a>
                                
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container mt-n10">
            <div class="card mb-4">
                <div class="card-header">Resumen del dia</div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    
                                    <th>Cargue</th>
                                    <th>Descargue</th> 
                                    <th>Bonos</th>
                                    <th>Almuerzos</th>
                                    <th>Gastos</th>
                                    <th>Abonos</th>
                                    <th>Dinero a recibir</th>                                    
                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Fecha</th>
                                    
                                    <th>Cargue</th>
                                    <th>Descargue</th> 
                                    <th>Bonos</th>
                                    <th>Almuerzos</th>
                                    <th>Gastos</th>
                                    <th>Abonos</th>
                                    <th>Dinero a recibir</th>  
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($cuentas as $cuenta)
                                <tr>
                                    <td>{{$cuenta->fecha}}</td>
                                    
                                    <td>{{$cuenta->cargue}}</td>
                                    <td>{{$cuenta->descargue}}</td>
                                    <td>{{$cuenta->bono}}</td>
                                    <td>{{$cuenta->almuerzo}}</td>
                                    <td>{{$cuenta->gasto}}</td>
                                    <td>{{$cuenta->abono}}</td>
                                    <td>{{$cuenta->total}}</td>
                                </tr>
                                
                            @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>        
        </div>
    </main>


@endsection

@section('content_js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
   
    <script src="{{ asset('js/demo/datatables-demo.js') }}" defer></script>
@endsection
