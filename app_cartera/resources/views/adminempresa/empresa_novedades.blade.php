@extends('layouts.app')



@section('titulo_pigina')
    Lista de novedades de la empresa
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
                                <div class="card-header">Panel de visualizacion de novedades</div>
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
                <div class="card-header">Listado de novedades de la cartera</div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Novedad</th>
                                    <th>Fecha</th>                                   
                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Novedad</th>
                                    <th>Fecha</th> 
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($novedades as $novedad)
                                <tr>
                                    <td>{{$novedad->usuario_nombre}}</td>
                                    <td>{{$novedad->novedad}}</td>
                                    <td>{{$novedad->mi_fecha}}</td>
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
