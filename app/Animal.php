<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'tbl_animales';

    /**
     * LLave primaria del modelo.
     *
     * @var string
     */
    protected $primaryKey = 'pk_id_animales';

    /**
     * Atributos del modelo que no pueden ser asignados en masa.
     *
     * @var array
     */
    protected $guarded = ['pk_id_animales', 'created_at', 'updated_at'];
}
