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

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'fk_id_animal', 'pk_id_animales');
    }
    public function responsable()
    {
        return $this->belongsTo(Responsable::class, 'fk_id_responsable', 'pk_id_responsables');
    }
    public function estado()
    {
        return $this->belongsTo(Responsable::class, 'fk_id_estado', 'pk_id_estado');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'fk_id_medico_veterinario', 'id');
    }
}
