@extends('layouts.app')



@section('titulo_pigina')
    Actualizar boono
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
                                <div class="card-header">Actualizar bono</div>
                                <div class="card-body">
                                    <form method="POST" action="/bonos/{{$bono->id}}" enctype="mutipart/form-data">
                                    
                                    @csrf
                                    @method('PUT')
                                       

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Cartera_id</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="cartera_id" type="text" value="{{$bono->cartera_id}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Descripcion</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcion" >{{$bono->descripcion}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Mi_fecha</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="mi_fecha" type="text" value="{{$bono->mi_fecha}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Valor</label>
                                            <input class="form-control" id="exampleFormControlInput1" name="valor" type="text" value="{{$bono->valor}}">
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
