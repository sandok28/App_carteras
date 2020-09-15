@extends('layouts.app')



@section('titulo_pigina')
    Crear usuario
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
                                <div class="card-header">Registrar usuario</div>
                                <div class="card-body">
                                    <form method="POST" action="/usuarios" enctype="mutipart/form-data">
                                    @csrf
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nombre</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="nombre" type="text">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Cedula</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="cedula" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nit</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="nit" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Telefono</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="telefono" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Direccion</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="direccion" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Tipo de usuario</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="tipo" type="text">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">User_id</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="user_id" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Empresa_id</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="empresa_id" type="text">
                                        </div>

                                        <button type="submit" class="btn btn-success">
                                                Guardar
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


