<div class="form-group">
    {!! Form::label('fecha_de_admision','Fecha de Admisión', ['class'=>'control-label col-md-8 col-sm-3 col-xs-12']) !!}
    <div class="col-md-2 col-sm-7 col-xs-12">
        {!! Form::text('fecha_de_admision',
        old('fecha_de_admision', isset($epicrisis)?(string)$epicrisis->fecha_de_admision->format('d/m/Y'):''), 
        [ 
            'class' => 'form-control col-md-2 col-sm-6 col-xs-12', 
            'required' => 'required',
            'id' => 'fecha_admision'
        ] ) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('id', 'Medico Veterinario', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-7 col-sm-6 col-xs-12">
        {!! Form::select('id', $medicos, old('id',isset($epicrisis)? $epicrisis->usuario->id
        : ''), 
        ['class' => 'select2 form-control',
        'required' => '', 'id' => 'medico',
        'placeholder' => 'Seleccione un medico veterinario',
        'style' => 'width:100%'
        ])
        !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('pk_id_responsables', 'Responsable', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-7 col-sm-6 col-xs-12">
        {!! Form::select('pk_id_responsables', $responsables, old('pk_id_responsables',isset($epicrisis)? $epicrisis->responsable->pk_id_responsables
        : ''), 
        ['class' => 'select2 form-control',
        'required' => '', 'id' => 'responsable',
        'placeholder' => 'Seleccione un responsable',
        'style' => 'width:100%'
        ])
        !!}
    </div>
</div>

<div class="item form-group">
    {!! Form::label('pk_id_animales', 'Animal', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-7 col-sm-6 col-xs-12">
        {!! Form::select('pk_id_animales', isset($animales)?$animales:[], old('pk_id_animales', isset($epicrisis)? 
        $epicrisis->animal()->pluck('pk_id_animales', 'nombre'): ''), ['class' => 'select2 form-control',
        'placeholder' => 'Seleccione un animal',
        'required' => 'required',
        'id' => 'animal']) !!}
    </div>
</div>

<div class="item form-group">
    {!! Form::label('motivo_consulta','Motivo de Consulta', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-7 col-sm-6 col-xs-12">
        {!! Form::textarea('motivo_consulta', old('motivo_consulta'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required', 'data-parsley-pattern'
        => '^[a-zA-Z0-9-_\.,;:ñÑáéíóúÁÉÍÓÚ ]+$', 'data-parsley-pattern-message' => 'Por favor escriba solo letras', 'data-parsley-length' => "[1,
        50]", 'data-parsley-trigger'=>"change"] ) !!}
    </div>
</div>

<div class="item form-group">
    {!! Form::label('vacunas','Vacunas', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-3 col-sm-3 col-xs-12">
        {!! Form::textarea('vacunas', old('vacunas'),[ 'class' => 'form-control', 'required'=> 'required', 'data-parsley-pattern'=>'^[a-zA-Z\s]*$' , 
        'data-parsley-trigger'=>"change" ] ) !!}
    </div>
    {!! Form::label('alergias','Alergias', ['class'=>'control-label col-md-1 col-sm-1 col-xs-12']) !!}
    <div class="col-md-3 col-sm-3 col-xs-12">
        {!! Form::textarea('alergias', old('alergias'),[ 'class' => 'form-control',
        'data-parsley-pattern'=>'^[a-zA-Z0-9-_\.,;:ñÑáéíóúÁÉÍÓÚ ]+$' , 'data-parsley-trigger'=>"change" ] ) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('enfermedades_anteriores','Enfermedades Anteriores', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-3 col-sm-3 col-xs-12">
        {!! Form::textarea('enfermedades_anteriores', old('enfermedades_anteriores'),[ 'class' => 'form-control', 'required'
        => 'required', 'data-parsley-pattern'=>'^[a-zA-Z0-9-_\.,;:ñÑáéíóúÁÉÍÓÚ ]+$' , 
        'data-parsley-trigger'=>"change" ] ) !!}
    </div>
    {!! Form::label('cirugias','Cirugias', ['class'=>'control-label col-md-1 col-sm-1 col-xs-12']) !!}
    <div class="col-md-3 col-sm-3 col-xs-12">
        {!! Form::textarea('cirugias', old('cirugias'),[ 'class' => 'form-control',
        'data-parsley-pattern'=>'^[a-zA-Z0-9-_\.,;:ñÑáéíóúÁÉÍÓÚ ]+$' , 'data-parsley-trigger'=>"change" ] ) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('pulso','Pulso', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-2 col-sm-3 col-xs-12">
        {!! Form::text('pulso', old('pulso'),[ 'class' => 'form-control', 'required'
        => 'required', 'data-parsley-type'=>"number" , 
        'data-parsley-trigger'=>"change" ] ) !!}
    </div>
    {!! Form::label('temperatura','Temperatura', ['class'=>'control-label col-md-1 col-sm-1 col-xs-12']) !!}
    <div class="col-md-1 col-sm-3 col-xs-12">
        {!! Form::text('temperatura', old('temperatura'),[ 'class' => 'form-control',
        'data-parsley-type'=>"number" , 'data-parsley-trigger'=>"change" ] ) !!}
    </div>
    {!! Form::label('peso','Peso', ['class'=>'control-label col-md-1 col-sm-1 col-xs-12']) !!}
    <div class="col-md-2 col-sm-3 col-xs-12">
        {!! Form::text('peso', old('peso'),[ 'class' => 'form-control',
        'data-parsley-type'=>"number" , 'data-parsley-trigger'=>"change" ] ) !!}
    </div>
</div>

<div class="item form-group">
    {!! Form::label('examenes_clinicos','Examenes Clinicos', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-7 col-sm-6 col-xs-12">
        {!! Form::textarea('examenes_clinicos', old('examenes_clinicos'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required', 'data-parsley-pattern'
        => '^[a-zA-Z0-9-_\.,;:ñÑáéíóúÁÉÍÓÚ ]+$', 'data-parsley-pattern-message' => 'Por favor escriba solo letras', 'data-parsley-length' => "[1,
        50]", 'data-parsley-trigger'=>"change"] ) !!}
    </div>
</div>

<div class="item form-group">
    {!! Form::label('diagnostico','Diagnostico', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-7 col-sm-6 col-xs-12">
        {!! Form::textarea('diagnostico', old('diagnostico'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required', 'data-parsley-pattern'
        => '^[a-zA-Z0-9-_\.,;:ñÑáéíóúÁÉÍÓÚ ]+$', 'data-parsley-pattern-message' => 'Por favor escriba solo letras', 'data-parsley-length' => "[1,
        50]", 'data-parsley-trigger'=>"change"] ) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('pk_id_estado','Estado del Paciente', ['class'=>'control-label col-md-8 col-sm-3 col-xs-12']) !!}
    <div class="col-md-2 col-sm-7 col-xs-12">
        {!! Form::select('pk_id_estado', $estado, old('id',isset($epicrisis)? $epicrisis->estado->pk_id_estado
        : ''), 
        ['class' => 'select2 form-control',
        'required' => '', 'id' => 'estado',
        'placeholder' => 'Estado del paciente',
        'style' => 'width:100%'
        ])
        !!}
    </div>
</div>