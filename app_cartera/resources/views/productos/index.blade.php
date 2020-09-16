@extends('layouts.app')



@section('titulo_pigina')
    Lista productos
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
                                <div class="card-header">Panel de administracion de productos</div>
                                <div class="row center-md card-body">
                                
                                    <div class="col-md-8"></div>
                                    <a class="btn btn-success col-md-2" type="button" href="{{ url('/productos/create') }}">Registar producto</a>
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
                <div class="card-header">Listado de productos</div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Empresa</th>
                                    <th>Fecha creacion</th>
                                    <th>Fecha actualizacion</th> 
                                    <th>Estado</th>                                   
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Empresa</th>
                                    <th>Fecha creacion</th>
                                    <th>Fecha actualizacion</th> 
                                    <th>Estado</th>                                   
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($productos as $producto)
                                <tr>
                                    <td>{{$producto->nombre}}</td>
                                    <td>{{$producto->precio}}</td>
                                    <td>{{$producto->descripcion}}</td>
                                    <td>{{$producto->cantidad}}</td>
                                    <td>{{$producto->empresa_id}}</td>
                                    <td>{{$producto->created_at}}</td>
                                    <td>{{$producto->updated_at}}</td>

                                    <td>
                                        @if ($producto->estado === "A")
                                            <div class="badge badge-success badge-pill">Activo</div>
                                        @elseif ($producto->estado === "I")
                                            <div class="badge badge-danger badge-pill">Inactivo</div>
                                        @endif
                                       
                                
                                    </td>
                                    <td>


                                        <a class="btn btn-datatable btn-icon btn-transparent-dark mr-2" href="{{ url('/productos/'.$producto->id.'/edit') }}"><i data-feather="edit"></i></a>
                                        
                                        @if ($producto->estado === "A")
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/productos/desactivar/'.$producto->id) }}"><i data-feather="user-x"></i></a>
                                        @elseif ($producto->estado === "I")
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/productos/activar/'.$producto->id) }}"><i data-feather="user-check"></i></a>
                                        @endif

                                        
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
