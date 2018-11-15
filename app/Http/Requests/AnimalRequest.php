<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
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
        return [
            'nombre' => 'required',
            'raza' => 'required',
            'color',
            'sexo',
            'fecha_nacimiento',
            'seniales_particulares',
            'pk_id_responsables' => 'required|exists:tbl_responsables',
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
            'nombre.required' => 'El nombre del animal es requerido.',
            'raza.required' => 'La raza del animal es requerida .',
            'color.required' => 'El color del animal es requerido.',
            'sexo.required' => 'El sexo del animal es requerido',
            'fecha_nacimiento.required' => 'La fecha de nacimiento del animal es requerida.',
            'seniales_particulares.required' => 'Digite algunas señales particulares del animal.',
            'pk_id_responsables.required' => 'Debe seleccionar un responsable para el animal.',
            'pk_id_responsables.exists' => 'El responsable que selecciona no existe en nuestros registros.',
        ];
    }
}
