<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EpicrisisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route()->parameter('epicrisi');
        $animal = 'unique:tbl_epicrisis,fk_id_animal';

        if ($this->method() == 'PUT') {
            $animal = Rule::unique('tbl_epicrisis', 'fk_id_animal')->ignore($id, 'pk_id_epicrisis');
        }
        return [
            'fecha_de_admision' => 'required',
            'motivo_consulta' => 'required',
            'vacunas' => 'required',
            'alergias' => 'required',
            'enfermedades_anteriores' => 'required',
            'cirugias' => 'required',
            'pulso' => 'required',
            'temperatura' => 'required',
            'peso' => 'required',
            'examenes_clinicos' => 'required',
            'diagnostico' => 'required',
            'id' => 'required|exists:users',
            'pk_id_responsables' => 'required|exists:tbl_responsables',
            'pk_id_estado' => 'required|exists:tbl_estado',
            'pk_id_animales' => 'required|exists:tbl_animales',
            'pk_id_animales' => $animal,
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'pk_id_animales.required' => 'Debe seleccionar un animal.',
            'pk_id_animales.exists' => 'El animal que selecciona no existe en nuestros registros.',
            'pk_id_animales.unique' => 'Ya existen datos relacionados al animal seleccionado.',
            'fecha_de_admision.required' => 'La fecha de admision es requerida.',
            'motivo_consulta.required' => 'El motivo de la consulta es requerida.',
            'vacunas.required' => 'Las vacunas del animal son requeridas.',
            'alergias.required' => 'Las alergias del animal son requeridas.',
            'enfermedades_anteriores.required' => 'Las enfermedades anteriores del animal son requeridas.',
            'cirugias.required' => 'Las cirugias anteriores del animal son requeridas.',
            'pulso.required' => 'El pulso del animal es requerido.',
            'temperatura.required' => 'La temperatura del animal es requerida.',
            'peso.required' => 'El peso del animal es requerido.',
            'examenes_clinicos.required' => 'Los examenes clinicos del animal son requeridos.',
            'diagnostico.required' => 'El diagnostico del animal es requerido .',

            'id.required' => 'El medico veterinario es requerido',
            'id.exists' => 'El medico veterinario que selecciona no existe en nuestros registros.',

            'pk_id_responsables.required' => 'El responsable del animal es requerido',
            'pk_id_responsables.exists' => 'El responsable que selecciona no existe en nuestros registros.',

            'pk_id_estado.required' => 'El estado del animal es requerido',
            'pk_id_estado.exists' => 'El estado que selecciona no existe en nuestros registros.',
            

        ];
    }
}
