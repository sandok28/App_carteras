<div class="form-group">
    {!! Form::label('nombre', 'Nombre de la empresa', ['for' => 'exampleFormControlInput1']) !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1']) !!}
</div>

<div class="form-group">
    {!! Form::label('descripcion', 'Descripcion', ['for' => 'exampleFormControlInput1']) !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1', 'rows' => '3']) !!}
</div>

<div class="form-group">
    {!! Form::label('telefono', 'Telefono', ['for' => 'exampleFormControlInput1']) !!}
    {!! Form::number('telefono', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1']) !!}
</div>
 
