
@extends('layouts.app')



@section('titulo_pigina')
    Lista clientes
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
                                <div class="card-header">Panel de administracion de clientes de la cartera</div>
                                <div class="row center-md card-body">
                                    <div class="col-md-8"></div>
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
                <div class="card-header">Listado de clientes</div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>direccion</th>
                                    <th>telefono</th>
                                    <th>cedula</th>
                                    <th>deuda</th>
                                    <th>intentos sin ventas</th>
                                    <th>Fecha creacion</th>
                                    <th>Fecha actualizacion</th>                                    
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>direccion</th>
                                    <th>telefono</th>
                                    <th>cedula</th>
                                    <th>deuda</th>
                                    <th>intentos sin ventas</th>
                                    <th>Fecha creacion</th>
                                    <th>Fecha actualizacion</th>                                    
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{$cliente->nombre}}</td>
                                    <td>{{$cliente->direccion}}</td>
                                    <td>{{$cliente->telefono}}</td>
                                    <td>{{$cliente->cedula}}</td>
                                    <td>{{$cliente->deuda}}</td>
                                    <td>{{$cliente->intentos_sin_ventas}}</td>
                                    <td>{{$cliente->created_at}}</td>
                                    <td>{{$cliente->updated_at}}</td>

                                
                                    <td>


                                        <a class="btn btn-datatable btn-icon btn-transparent-dark mr-2" href="{{url('/empresa/carteras/clientes/'.$cliente->id.'/formulario_cliente_actualizar')}}"><i data-feather="edit"></i></a>
                                      
                                        
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

