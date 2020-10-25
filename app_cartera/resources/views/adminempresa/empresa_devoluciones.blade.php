@extends('layouts.app')



@section('titulo_pigina')
    Lista productos
@endsection

@section('content_css')
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
@endsection

@section('content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-12">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Panel de visualizacion de devoluciones</div>
                                <div class="row center-md card-body">
                                    <div class="col-md-8"></div>
                                        
                    
                                    <button class="btn btn-white btn-sm line-height-normal p-3" id="reportrange">
                                        <i class="mr-2 text-primary" data-feather="calendar"></i>
                                        <span></span>
                                        <i class="ml-1" data-feather="chevron-down"></i>
                                    </button>

                                    <a class="btn btn-primary col-md-2" type="button" href="{{ url()->previous() }}">Volver</a>

                                    
                                
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
                <div class="card-header">Listado de devoluciones de la empresa</div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cartera</th>
                                    <th>Cantidad</th>
                                    <th>Fecha</th>                                   
                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cartera</th>
                                    <th>Cantidad</th>
                                    <th>Fecha</th> 
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($devoluciones as $devolucion)
                                <tr>
                                    <td>{{$devolucion->producto->nombre}}</td>
                                    <td>{{$devolucion->cartera->nombre}}</td>
                                    <td>{{$devolucion->producto_cantidad}}</td>
                                    <td>{{$devolucion->fecha}}</td>
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
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/demo/date-range-picker-demo.js') }}" defer></script>

@endsection