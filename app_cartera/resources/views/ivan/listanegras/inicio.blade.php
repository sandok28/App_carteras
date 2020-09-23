@extends('layouts.app')



@section('titulo_pigina')
    Lista Negra
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
                                <div class="card-header">Panel de lista negra</div>
                                <div class="row center-md card-body">
                                
                                    <div class="col-md-8"></div>
                                    <a class="btn btn-success col-md-2" type="button" href="{{ url('/listanegras/formulario_listanegras_crear') }}">Registar lista negra</a>
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
                <div class="card-header">Lista negra</div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Cliente_id</th>
                                    <th>Monto_ingreso</th>
                                    <th>Estado</th>                                   
                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Cliente_id</th>
                                    <th>Monto_ingreso</th>
                                    <th>Estado</th>      
                                    
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($listanegras as $listanegras)
                                <tr>
                                    <td>{{$listanegras->cliente_id}}</td>
                                    <td>{{$listanegras->monto_ingreso}}</td>
                                    <td>{{$listanegras->estado}}</td>
                                   

                                    <td>
                                        @if ($listanegras->estado === "P")
                                            <div class="badge badge-success badge-pill">PENDIENTE</div>
                                        @elseif ($listanegras->estado === "C")
                                            <div class="badge badge-danger badge-pill">CONFIRMADO</div>
                                        @endif
                                       
                                
                                    </td>
                                    <td>


                                        <a class="btn btn-datatable btn-icon btn-transparent-dark mr-2" href="{{ url('/listanegras/'.$listanegras->id.'/formulario_listanegras_actualizar') }}"><i data-feather="edit"></i></a>
                                                                                                                
                                        @if ($listanegras->estado === "C")
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/listanegras/desactivar/'.$listanegras->id) }}"><i data-feather="user-x"></i></a>
                                        @elseif ($listanegras->estado === "P")
                                        <a class="btn btn-datatable btn-icon btn-transparent-dark" href="{{ url('/listanegras/activar/'.$listanegras->id) }}"><i data-feather="user-check"></i></a>
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