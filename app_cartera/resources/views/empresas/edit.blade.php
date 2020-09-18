@extends('layouts.app')



@section('titulo_pigina')
    Actualizar empresa
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
                                <div class="card-header">Actualizar empresa</div>
                                <div class="card-body">
                                    <form method="POST" action="/empresas/{{$empresa->id}}" enctype="mutipart/form-data">
                                    @method('PUT')
                                    @csrf
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nombre</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="nombre" type="text" value="{{$empresa->nombre}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Telefono</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="telefono" type="text" value="{{$empresa->telefono}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Descripcion</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcion" >{{$empresa->descripcion}}</textarea>
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


