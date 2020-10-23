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
                            
                                <div class="card-header">Registrar devolucion</div>
                                <div class="card-body">
                                    <form method="POST" action="/devoluciones" enctype="mutipart/form-data">
                                    @csrf
                                    <?php
                                     $i = 0
                                    ?>
                                         @foreach($productos as $producto) 

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">{{$producto->nombre}}</label>
                                                <input class="form-control" id="exampleFormControlInput1" name="producto_{{$i}}_cantidad" type="text">
                                                <input class="form-control" id="exampleFormControlInput1" name="producto_id_{{$i}}" value="{{$producto->id}}" type="hidden">
                                            </div>
                                            <?php
                                            $i = $i+1
                                            ?>
                                        @endforeach

                                        <input class="form-control" id="exampleFormControlInput1" name="cantidad" value="{{$cantidad_productos}}" type="hidden">
                                        

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


