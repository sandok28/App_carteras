<div class="form-group">
    {!! Form::label('nombre', 'Nombre', ['for' => 'exampleFormControlInput1']) !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Carterista', ['for' => 'exampleFormControlInput1']) !!}
    {{ Form::select('usuario_id', $usuarios_empresa, null, ['class'=>'form-control']) }}
     
</div>

{{ Form::hidden('empresa_id', $empresa_id) }}





