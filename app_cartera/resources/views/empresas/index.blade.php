@extends('layouts.app')



@section('titulo_pigina')
    Lista empresas
@endsection

@section('content_css')
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
@endsection




@section('content')

    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Tables
                            </h1>
                            <div class="page-header-subtitle">An extended version of the DataTables library, customized for SB Admin Pro</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container mt-n10">
            <div class="card mb-4">
                <div class="card-header">Extended DataTables</div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($empresas as $empresa)
                                <tr>
                                    <td>{{$empresa->nombre}}</td>
                                    <td>{{$empresa->descripcion}}</td>
                                    <td>{{$empresa->created_at}}</td>
                                    <td>{{$empresa->updated_at}}</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                    <td><div class="badge badge-primary badge-pill">Full-time</div></td>
                                    <td>
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="more-vertical"></i></button>
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
                                    </td>
                                </tr>
                                
                            @endforeach
                                
                                <tr>
                                    <td>Donna Snider</td>
                                    <td>Customer Support</td>
                                    <td>New York</td>
                                    <td>27</td>
                                    <td>2011/01/25</td>
                                    <td>$112,000</td>
                                    <td><div class="badge badge-secondary badge-pill">Part-time</div></td>
                                    <td>
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="more-vertical"></i></button>
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
                                    </td>
                                </tr>
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
    <!--<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>-->
    <script src="https://cdn.datatables.net/buttons/1.6.3/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>

        <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js" crossorigin="anonymous"></script>
    
        
    <script src="{{ asset('js/demo/datatables-demo.js') }}" defer></script>
@endsection


<!--
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin Pro</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Tables
                            </h1>
                            <div class="page-header-subtitle">An extended version of the DataTables library, customized for SB Admin Pro</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-- >
        <div class="container mt-n10">
            <div class="card mb-4">
                <div class="card-header">Extended DataTables</div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($empresas as $empresa)
                                <tr>
                                    <td>{{$empresa->nombre}}</td>
                                    <td>{{$empresa->descripcion}}</td>
                                    <td>{{$empresa->created_at}}</td>
                                    <td>{{$empresa->updated_at}}</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                    <td><div class="badge badge-primary badge-pill">Full-time</div></td>
                                    <td>
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="more-vertical"></i></button>
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
                                    </td>
                                </tr>
                                
                            @endforeach
                                
                                <tr>
                                    <td>Donna Snider</td>
                                    <td>Customer Support</td>
                                    <td>New York</td>
                                    <td>27</td>
                                    <td>2011/01/25</td>
                                    <td>$112,000</td>
                                    <td><div class="badge badge-secondary badge-pill">Part-time</div></td>
                                    <td>
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="more-vertical"></i></button>
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>        
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        
        <script src="https://cdn.datatables.net/buttons/1.6.3/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>

        <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js" crossorigin="anonymous"></script>
    
        
        
        <script src="{{ asset('js/demo/datatables-demo.js') }}" defer></script>
    </body>
</html>
-->