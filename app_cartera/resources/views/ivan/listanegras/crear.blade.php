@extends('layouts.app')



@section('titulo_pigina')
    Crear lista negra
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
                            @if ($errors->any())
                                @foreach($errors->all() as $error)
                                 <p>{{$error}}</p>
                                @endforeach
                            @endif
                                <div class="card-header">Registrar listanegra</div>
                                <div class="card-body">
                                    <form method="POST" action="/listanegras" enctype="mutipart/form-data">
                                    @csrf
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Cliente_id</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="cliente_id" type="text">
                                        </div>
                                       

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Monto_ingreso</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="monto_ingreso" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Estado</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="estado" type="text">
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