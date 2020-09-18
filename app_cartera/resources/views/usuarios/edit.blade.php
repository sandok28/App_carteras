@extends('layouts.app')



@section('titulo_pigina')
    Actualizar usuario
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
                                <div class="card-header">Actualizar usuario</div>
                                <div class="card-body">
                                    <form method="POST" action="/usuarios/{{$usuario->id}}" enctype="mutipart/form-data">
                                    
                                    @csrf
                                    @method('PUT')
                                        
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nombre</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="nombre" type="text" value="{{$usuario->nombre}}">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Cedula</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="cedula" type="text" value="{{$usuario->cedula}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nit</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="nit" type="text"value="{{$usuario->nit}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Telefono</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="telefono" type="text"value="{{$usuario->telefono}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Direccion</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="direccion" type="text"value="{{$usuario->direccion}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Tipo de usuario</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="tipo" type="text"value="{{$usuario->tipo}}">
                                        </div>
                                        

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Correo</label>
                                            @if(is_null($usuario->user))
                                                <input class="form-control" id="exampleFormControlInput1" name="email" type="text" value="">
                                                
                                            @else
                                                <input class="form-control" id="exampleFormControlInput1" name="email" type="text" value="{{$usuario->user->email}}">
                                            @endif
                                            
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


