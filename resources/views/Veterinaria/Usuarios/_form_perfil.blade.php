<div class="item form-group">
    {!! Form::label('name','Nombre', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('name', old('name'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required', 'data-parsley-pattern'
        => '^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$', 'data-parsley-pattern-message' => 'Por favor escriba solo letras', 'data-parsley-length' => "[1,
        50]", 'data-parsley-trigger'=>"change"] ) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('lastname','Apellido', [ 'class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}

    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('lastname', old('lastname'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required',
        'data-parsley-pattern' => '^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$', 'data-parsley-pattern-message' => 'Por favor escriba solo letras', 'data-parsley-length'
        => "[1, 50]", 'data-parsley-trigger'=>"change" ]) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('cedula','Cedula', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('cedula', old('cedula'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required', 'data-parsley-pattern'
        => '^[0-9]*$', 'data-parsley-pattern-message' => 'Por favor escriba solo numeros', 'data-parsley-length' => "[1,
        50]", 'data-parsley-trigger'=>"change"] ) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('age','Edad', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('age', old('age'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required', 'data-parsley-pattern'
        => '^[0-9]*$', 'data-parsley-pattern-message' => 'Por favor escriba solo numeros', 'data-parsley-length' => "[1,
        50]", 'data-parsley-trigger'=>"change"] ) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('address','Direccion', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('address', old('address'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required', 'data-parsley-pattern'
        => '^[a-zA-Z0-9-_\.,;:ñÑáéíóúÁÉÍÓÚ ]+$', 'data-parsley-pattern-message' => 'Por favor escriba solo letras', 'data-parsley-length' => "[1,
        50]", 'data-parsley-trigger'=>"change"] ) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('phone','Telefono', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('phone', old('phone'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required', 'data-parsley-pattern'
        => '^[0-9]*$', 'data-parsley-pattern-message' => 'Por favor escriba solo numeros', 'data-parsley-length' => "[1,
        50]", 'data-parsley-trigger'=>"change"] ) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('email','Email', [ 'class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::email('email', old('email'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12','data-parsley-pattern-message' => 'El correo debe ser institucional', 'required' =>
        'required' ] ) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('password','Contraseña', [ 'class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::password('password',[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12',
         isset($edit) ? '' : 'required' =>
        'required',
        'id' => 'password' ] ) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('password_confirmation','Repetir Contraseña', [ 'class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::password('password_confirmation',[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', isset($edit) ? '' : 'required' =>
        'required' ,
        'data-parsley-equalto'=>"#password" ,
        'id' => 'password_confimation'] ) !!}
    </div>
</div>
@hasrole('ADMINISTRADOR')
<div class="item form-group">
    {!! Form::label('roles', 'Roles', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::select('roles[]', isset($roles)?$roles:[],
        old('roles', isset($roles, $user)? $user->roles()->pluck('name', 'name') : ''),
        ['class' => 'select2_roles form-control', 'multiple' => 'multiple', 'required'
        => '', 'id'=>'select_rol']) !!}
    </div>
</div>
@endhasrole