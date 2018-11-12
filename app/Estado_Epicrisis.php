<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_Epicrisis extends Model
{
     /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'tbl_estados_epicrisis';

    /**
     * LLave primaria del modelo.
     *
     * @var string
     */
    protected $primaryKey = 'pk_id_estados_epicrisis';

    /**
     * Atributos del modelo que no pueden ser asignados en masa.
     *
     * @var array
     */
    protected $guarded = ['pk_id_estados_epicrisis', 'created_at', 'updated_at'];

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'fk_id_estado', 'pk_id_estado');
    }
}
