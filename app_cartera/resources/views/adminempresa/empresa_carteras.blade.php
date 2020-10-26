@extends('layouts.app')



@section('titulo_pigina')
    Lista de carteras
@endsection

@section('content_css')
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
                                <div class="card-header">Panel de administracion de carteras</div>
                                <div class="row center-md card-body">
                                
                                    
                                
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
                <div class="card-header">Listado de carteras</div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Carterista</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Carterista</th>                                   
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($empresa_carteras as $cartera)
                                <tr>
                                    <td>{{$cartera->nombre}}</td>
                                    <td>{{is_null($cartera->usuario) ? '' : $cartera->usuario->nombre}}</td>
                                    <td>


                                        <a class="btn btn-datatable btn-icon btn-transparent-dark mr-2" href="{{url('/empresa/carteras/'.$cartera->id.'/formulario_cartera_actualizar')}}"title="Editar"><i data-feather="edit"></i></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark mr-2" href="{{ url('/empresa/carteras/'.$cartera->id.'/clientes') }}" title="Clientes"><i data-feather ="users"></i></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark mr-2" href="{{ url('/empresa/bonos/'.$cartera->id)}}" title="Bonos"><i data-feather ="dollar-sign"></i></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark mr-2" href="{{ url('/empresa/novedades/'.$cartera->id)}}" title="Novedades"><i data-feather ="message-circle"></i></a>
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark mr-2" href="{{ url('/empresa/ventas/'.$cartera->id)}}"title="Transacciones"><i data-feather ="shopping-cart"></i></a>                                                                  
                                        
                                        
                                    </td>
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
