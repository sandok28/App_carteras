<div class="form-group">
    {!! Form::label('nombre', 'Nombre', ['for' => 'exampleFormControlInput1']) !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'id' => 'exampleFormControlInput1']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Carterista', ['for' => 'exampleFormControlInput1']) !!}
    {{ Form::select('usuario_id', $usuarios_empresa, null, ['class'=>'form-control']) }}
     
</div>

{{ Form::hidden('empresa_id', $empresa_id) }}




<div class="form-check ">
    {!!Form::checkbox('1','value')!!}
    <label class="form-check-label" for="inlineCheckbox1">Lunes</label>
</div>

<div class="form-check">
    {!!Form::checkbox('2','value')!!}
    <label class="form-check-label" for="inlineCheckbox1">Martes</label>
</div>

<div class="form-check">
    {!!Form::checkbox('3','value')!!}
    <label class="form-check-label" for="inlineCheckbox1">Miercoles</label>
</div>

<div class="form-check">
    {!!Form::checkbox('4','value')!!}
    <label class="form-check-label" for="inlineCheckbox1">Jueves</label>
</div>

<div class="form-check">
    {!!Form::checkbox('5','value')!!}
    <label class="form-check-label" for="inlineCheckbox1">Viernes</label>
</div>

<div class="form-check">
    {!!Form::checkbox('6','value')!!}
    <label class="form-check-label" for="inlineCheckbox1">Sabado</label>
</div>

<div class="form-check">
    {!!Form::checkbox('7','value')!!}
    <label class="form-check-label" for="inlineCheckbox1">Domingo</label>
</div>
















