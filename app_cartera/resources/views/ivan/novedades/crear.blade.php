@extends('layouts.app')



@section('titulo_pigina')
    Crear novedad
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
                                <div class="card-header">Registrar novedad</div>
                                <div class="card-body">
                                    <form method="POST" action="/novedades" enctype="mutipart/form-data">
                                    @csrf
                                       
                                       

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Cartera_id</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="cartera_id" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Novedad</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="novedad"></textarea>
                                        </div>
                                        
                                       
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Usuario_nombre</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="usuario_nombre"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Mi_fecha</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="mi_fecha" type="text">
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