<div class="form-group">
    {!! Form::label('nombre', 'Nombre', ['for' => 'exampleFormControlInput1']) !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1']) !!}
</div>

<div class="form-group">
    {!! Form::label('descripcion', 'Descripcion', ['for' => 'exampleFormControlInput1']) !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1', 'rows' => '3']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Carterista', ['for' => 'exampleFormControlInput1']) !!}
    {{ Form::select('usuario_id', $usuarios_empresa, null, array('class'=>'form-control', 'placeholder'=>'Seleccione...')) }}
     
</div>
{{ Form::hidden('empresa_id', $empresa_id) }}





