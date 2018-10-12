<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estado'
    ];

    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'tbl_estado';

    /**
     * LLave primaria del modelo.
     *
     * @var string
     */
    protected $primaryKey = 'pk_id_estado';
}
