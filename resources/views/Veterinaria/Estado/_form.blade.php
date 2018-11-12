<div class="form-group">
    {!! Form::label('pk_id_estado', 'Estado', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::select('pk_id_estado', $estado, old('pk_id_estado', isset($epicrisis)? $epicrisis->fk_id_estado: ''), ['class' => 'select2 form-control',
        'id' => 'estado',
        'style' => 'width:100%',
        'placeholder' => 'Seleccione un estado', 
        'required' => 'required', 
        ])
        !!}
    </div>
</div>