<div class="item form-group">
    {!! Form::label('nombre','Nombre', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('nombre', old('nombre'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required', 'data-parsley-pattern'
        => '^[a-zA-Z\s]*$', 'data-parsley-pattern-message' => 'Por favor escriba solo letras', 'data-parsley-length' => "[1,
        50]", 'data-parsley-trigger'=>"change"] ) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('raza','Raza', [ 'class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('raza', old('raza'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required',
        'data-parsley-pattern' => '^[a-zA-Z\s]*$', 'data-parsley-pattern-message' => 'Por favor escriba solo letras', 'data-parsley-length'
        => "[1, 50]", 'data-parsley-trigger'=>"change" ]) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('color','Color', [ 'class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('color', old('color'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required',
        'data-parsley-pattern' => '^[a-zA-Z\s]*$', 'data-parsley-pattern-message' => 'Por favor escriba solo letras', 'data-parsley-length'
        => "[1, 50]", 'data-parsley-trigger'=>"change" ]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('sexo', 'Sexo', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::select('sexo', array('Macho' => 'Macho', 'Hembra' => 'Hembra'), old('sexo'), ['class' => 'select2 form-control',
        'required' => '', 'id' => 'sexo',
        'placeholder' => 'Seleccione un sexo',
        'style' => 'width:100%'
        ])
        !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('fecha_nacimiento','Fecha de Nacimiento', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('fecha_nacimiento',
        old('fecha_nacimiento', isset($animales)?(string)$animales->fecha_nacimiento->format('d/m/Y'):''), 
        [ 
            'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 
            'required' => 'required',
            'id' => 'fecha_inicio'
        ] ) !!}
    </div>
</div>

<div class="item form-group">
    {!! Form::label('seniales_particulares','Señales Particulares', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::textarea('seniales_particulares', old('seniales_particulares'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required', 'data-parsley-pattern'
        => '^[a-zA-Z0-9-_\.,;:ñÑáéíóúÁÉÍÓÚ ]+$', 'data-parsley-pattern-message' => 'Por favor escriba solo letras', 'data-parsley-length' => "[1,
        50]", 'data-parsley-trigger'=>"change"] ) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('pk_id_responsables', 'Responsable', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::select('pk_id_responsables', $responsable, old('pk_id_responsables',isset($animales)? $animales->responsable->pk_id_responsables
        : ''), 
        ['class' => 'select2 form-control',
        'required' => '', 'id' => 'responsable',
        'placeholder' => 'Seleccione un responsable',
        'style' => 'width:100%'
        ])
        !!}
    </div>
</div>
