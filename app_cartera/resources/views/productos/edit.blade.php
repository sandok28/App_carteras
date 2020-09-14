@extends('layouts.app')



@section('titulo_pigina')
    Actualizar producto
@endsection



@section('content')

       <div id="layoutSidenav_content">
            <main>
                <!-- Main page content-->
                <div class="container mt-4">
                    <!-- Account page navigation-->
                    <hr class="mt-0 mb-4" />
                    <div class="row">
                        
                        <div class="col-xl-12">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">Actualizar producto</div>
                                <div class="card-body">
                                    <form method="POST" action="/productos/{{$producto->id}}" enctype="mutipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                            <label for="exampleFormControlInput1">Nombre</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="nombre" type="text" value="{{$producto->nombre}}">
                                        </div>
                                       

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Precio</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="precio" type="text" value="{{$producto->precio}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Cantidad</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="cantidad" type="text" value="{{$producto->cantidad}}">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Empresa_id</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="empresa_id" type="text" value="{{$producto->empresa_id}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Descripcion</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcion" >{{$producto->descripcion}}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success">
                                                Actualizar
                                        </button>
                                        <a class="btn btn-primary " type="button" href="{{ url()->previous() }}">Volver</a>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

@endsection


