<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Epicrisis extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'tbl_epicrisis';

    /**
     * LLave primaria del modelo.
     *
     * @var string
     */
    protected $primaryKey = 'pk_id_epicrisis';

    /**
     * Atributos del modelo que no pueden ser asignados en masa.
     *
     * @var array
     */
    protected $guarded = ['pk_id_epicrisis', 'created_at', 'updated_at'];
}
