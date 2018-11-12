<div class="form-group">
    {!! Form::label('id_estado', 'Año', ['class' => 'control-label col-md-4 col-sm-3 col-xs-12']) !!}
    <div class="col-md-5 col-sm-9 col-xs-9">
        {!! Form::select('id_estado', $anios, old('id_estado'), ['class' => 'select2 form-control',
        'required' => '', 'id' => 'estado',
        'style' => 'width:100%',
        'placeholder' => 'Seleccione un año', 
        ])
        !!}
    </div>
</div>