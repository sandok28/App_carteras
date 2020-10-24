@extends('layouts.app')



@section('titulo_pigina')
    Bodega
@endsection

                                                            

@section('content')

    <main>
        <!-- Main page content-->
        <div class="container mt-4">
            <!-- Account page navigation-->
            <hr class="mt-0 mb-4" />
            <div class="row">
                
                <div class="col-xl-12">
                    <!-- Account details card-->
                    <div class="card mb-4">
                    
                        <div class="card-header">Productos en la nevera de la cartera</div>
                        
                        
                        <div class="card-body">
                            @include('Partials.formularios.alerta_validaciones')
                                                           
                                <table class="datatable">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead >
                                        <tr>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($neveras as $nevera)
                                        <tr>
                                        <td>{{$nevera->producto->nombre}}</td>
                                        <td>{{$nevera->cantidad}}</td>
                                        <td>
                                        <a class="btn btn-success " type="button" href="{{route('bodega.formulario_recargar_cartera',$nevera->id)}}">Recargar</a>
                                        <a class="btn btn-warning " type="button" href="{{route('bodega.formulario_descargar_cartera',$nevera->id)}}">Descargar</a>
                                        </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    
                                </table>
                                <div class="card-header">Cargue inicial de la cartera: ${{$cargue_inicial}}</div>
                                <a class="btn btn-danger btn-lg btn-block" type="button" href="{{route('bodega.cierre_cartera',$cartera_id)}}">Cierre del dia</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
 
@endsection

