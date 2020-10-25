
@extends('layouts.app')



@section('titulo_pigina')
    Ordenar clientes
@endsection

@section('content_css')

@endsection

@section('content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-12">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="chevrons-right"></i></div>
                                {{$cartera->nombre}}
                            </h1>
                            <div class="page-header-subtitle">
                                Ordene los clientes en las posiciones deseadas y al final hacer click en "Guardar cambios"
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container mt-n10"><!-- Styled timeline component example -->
            <div  class="timeline">
                @include('Partials.formularios.alerta_validaciones')
                
                {!! Form::model($clientes, ['route' => ['carterista.clientes.clientes_ordenar'], 'method' => 'POST']) !!}
                    
                    @foreach($clientes as $cliente)  
                                   
                        <div class="timeline-item" id="div_pos_{{$cliente->posicion}}">                        
                            <div class="timeline-item-content pt-0">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="text-primary">{{$cliente->nombre}}<span class="badge badge-cyan">En edicion</span></h5>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Posicion:    {!! Form::number('posicion', $cliente->posicion, ['style' => 'width : 20%;border: none; border-color: transparent;', 'id' => 'id_cliente_posicion_'.$cliente->posicion, 'name' => 'cliente_posicion_'.$cliente->id, 'readonly']) !!}   
                                            </div>
                                            <div class="col-md-2">
                                                {{$cliente->direccion}}
                                            </div>
                                        </div>
                                        </br>                                        
                                        <a class="btn btn-teal col-md-10" type="button" id="div_botn_pos_subir_{{$cliente->posicion}}" onclick="subirPosicion({{$cliente->posicion}},{{$cliente->id}});">Subir</a>
                                        <a class="btn btn-danger col-md-10" type="button" id="div_botn_pos_bajar_{{$cliente->posicion}}" onclick="bajarPosicion({{$cliente->posicion}},{{$cliente->id}});">Bajar</a>
                                                                               
                                    </div>
                                </div>
                            </div>
                        </div>   
                                       
                    @endforeach
                    
                    <div class="form-group">
                        {!! Form::submit('Aceptar', ['class' => 'btn btn-success col-md-10'] ) !!}
                        </br>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-primary col-md-10" type="button" href="{{ route('carterista') }}">Volver</a>
                    </div>
                {!! Form::close() !!}
                
                
            </div>
        </div>
    </main>
@endsection

@section('content_js')


  <script>
    function subirPosicion(posicion,cliente_id){
      
        if(posicion=="1"){
            return false;
        }

        console.log("Subir posicion: "+posicion);
        var div_selecionado = 'div_pos_'+posicion;
        var div_superior = 'div_pos_'+(posicion-1);
        
        var div_botn_pos_subir_selecionado = 'div_botn_pos_subir_'+posicion;
        var div_botn_pos_subir_superior = 'div_botn_pos_subir_'+(posicion-1);

        var div_botn_pos_bajar_selecionado = 'div_botn_pos_bajar_'+posicion;
        var div_botn_pos_bajar_superior = 'div_botn_pos_bajar_'+(posicion-1);

        var input_cliente_posicion_selecionado = 'id_cliente_posicion_'+posicion
        var input_cliente_posicion_superior = 'id_cliente_posicion_'+(posicion-1)

        $('#'+div_selecionado).insertBefore('#'+div_superior);	

        document.getElementById(div_selecionado).setAttribute("id", "tempo");
        
        document.getElementById(div_superior).setAttribute("id", div_selecionado);
        document.getElementById("tempo").setAttribute("id", div_superior);

        document.getElementById(div_botn_pos_subir_selecionado).setAttribute("onclick", "subirPosicion("+(posicion-1)+");");
        document.getElementById(div_botn_pos_subir_superior).setAttribute("onclick", "subirPosicion("+posicion+");");
       

        document.getElementById(div_botn_pos_subir_selecionado).setAttribute("id", "tempo");        
        document.getElementById(div_botn_pos_subir_superior).setAttribute("id", div_botn_pos_subir_selecionado);
        document.getElementById("tempo").setAttribute("id", div_botn_pos_subir_superior);


        document.getElementById(div_botn_pos_bajar_selecionado).setAttribute("onclick", "bajarPosicion("+(posicion-1)+");");
        document.getElementById(div_botn_pos_bajar_superior).setAttribute("onclick", "bajarPosicion("+posicion+");");
       

        document.getElementById(div_botn_pos_bajar_selecionado).setAttribute("id", "tempo");        
        document.getElementById(div_botn_pos_bajar_superior).setAttribute("id", div_botn_pos_bajar_selecionado);
        document.getElementById("tempo").setAttribute("id", div_botn_pos_bajar_superior);


       
        document.getElementById(input_cliente_posicion_selecionado).value = (posicion-1)
        document.getElementById(input_cliente_posicion_superior).value = posicion


        document.getElementById(input_cliente_posicion_selecionado).setAttribute("id", "tempo");
        
        document.getElementById(input_cliente_posicion_superior).setAttribute("id", input_cliente_posicion_selecionado);
        document.getElementById("tempo").setAttribute("id", input_cliente_posicion_superior);

    }

    function bajarPosicion(posicion){

        
        console.log("Bajar posicion: "+posicion);
        var div_selecionado = 'div_pos_'+posicion;
        var div_inferior = 'div_pos_'+(posicion+1);
        
        var div_botn_pos_subir_selecionado = 'div_botn_pos_subir_'+posicion;
        var div_botn_pos_subir_superior = 'div_botn_pos_subir_'+(posicion+1);

        var div_botn_pos_bajar_selecionado = 'div_botn_pos_bajar_'+posicion;
        var div_botn_pos_bajar_superior = 'div_botn_pos_bajar_'+(posicion+1);

        var input_cliente_posicion_selecionado = 'id_cliente_posicion_'+posicion
        var input_cliente_posicion_superior = 'id_cliente_posicion_'+(posicion+1)

        $('#'+div_inferior).insertBefore('#'+div_selecionado);	

        document.getElementById(div_selecionado).setAttribute("id", "tempo");
        
        document.getElementById(div_inferior).setAttribute("id", div_selecionado);
        document.getElementById("tempo").setAttribute("id", div_inferior);


      
        document.getElementById(div_botn_pos_subir_selecionado).setAttribute("onclick", "subirPosicion("+(posicion+1)+");");
        document.getElementById(div_botn_pos_subir_superior).setAttribute("onclick", "subirPosicion("+posicion+");");
        

        document.getElementById(div_botn_pos_subir_selecionado).setAttribute("id", "tempo");        
        document.getElementById(div_botn_pos_subir_superior).setAttribute("id", div_botn_pos_subir_selecionado);
        document.getElementById("tempo").setAttribute("id", div_botn_pos_subir_superior);


        document.getElementById(div_botn_pos_bajar_selecionado).setAttribute("onclick", "bajarPosicion("+(posicion+1)+");");
        document.getElementById(div_botn_pos_subir_superior).setAttribute("onclick", "bajarPosicion("+posicion+");");
        

        document.getElementById(div_botn_pos_bajar_selecionado).setAttribute("id", "tempo");        
        document.getElementById(div_botn_pos_bajar_superior).setAttribute("id", div_botn_pos_bajar_selecionado);
        document.getElementById("tempo").setAttribute("id", div_botn_pos_bajar_superior);

        
        document.getElementById(input_cliente_posicion_selecionado).value = (posicion+1)
        document.getElementById(input_cliente_posicion_superior).value = posicion


        document.getElementById(input_cliente_posicion_selecionado).setAttribute("id", "tempo");
        
        document.getElementById(input_cliente_posicion_superior).setAttribute("id", input_cliente_posicion_selecionado);
        document.getElementById("tempo").setAttribute("id", input_cliente_posicion_superior);

  }
  </script>
@endsection



