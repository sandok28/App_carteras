
@extends('layouts.app')



@section('titulo_pigina')
    Lista de administradores
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
                                <div class="card-header">Panel de administracion de administradores</div>
                                <div class="row center-md card-body">
                                    <div class="col-md-8"></div>
                                    <a class="btn btn-success col-md-2" type="button" href="{{ route('administrador.administrador_usuarios.formulario_usuarios_crear') }}">Registar usuario administrador</a>
                                    
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
                <div class="card-header">Listado de administradores</div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>descripcion</th>
                                    <th>telefono</th>
                                    <th>direccion</th>
                                    <th>Fecha creacion</th>
                                    <th>Fecha actualizacion</th>                                    
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>descripcion</th>
                                    <th>telefono</th>
                                    <th>direccion</th>
                                    <th>Fecha creacion</th>
                                    <th>Fecha actualizacion</th>                                    
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($usuarios_administradores as $usuario_administrador)
                                <tr>
                                    <td>{{$usuario_administrador->nombre}}</td>
                                    <td>{{$usuario_administrador->cedula}}</td>
                                    <td>{{$usuario_administrador->telefono}}</td>
                                    <td>{{$usuario_administrador->direccion}}</td>
                                    <td>{{$usuario_administrador->created_at}}</td>
                                    <td>{{$usuario_administrador->updated_at}}</td>

                                    <td>
                                        @if ($usuario_administrador->estado === "A")
                                            <div class="badge badge-success badge-pill">Activo</div>
                                        @elseif ($usuario_administrador->estado === "I")
                                            <div class="badge badge-danger badge-pill">Inactivo</div>
                                        @endif
                                       
                                
                                    </td>
                                    <td>


                                        <a class="btn btn-datatable btn-icon btn-transparent-dark mr-2" href="{{ route('administrador.administrador_usuarios.formulario_usuarios_actualizar',$usuario_administrador->id) }}"title="Editar"><i data-feather="edit"></i></a>
                                                                                                                        
                                        @if ($usuario_administrador->estado === "A")
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ route('administrador.administrador_usuarios.usuarios_desactivar',$usuario_administrador->id) }}"title="Desactivar"><i data-feather="user-x"></i></a>
                                        @elseif ($usuario_administrador->estado === "I")
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ route('administrador.administrador_usuarios.usuarios_activar', $usuario_administrador->id) }}"title="Activar"><i data-feather="user-check"></i></a>
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



