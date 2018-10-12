<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'tbl_responsables';

    /**
     * LLave primaria del modelo.
     *
     * @var string
     */
    protected $primaryKey = 'pk_id_responsables';

    /**
     * Atributos del modelo que no pueden ser asignados en masa.
     *
     * @var array
     */
    protected $guarded = ['pk_id_responsables', 'created_at', 'updated_at'];

}
