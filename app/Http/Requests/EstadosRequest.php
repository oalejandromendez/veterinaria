<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstadosRequest extends FormRequest
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
            'pk_id_estado' => 'required|exists:tbl_estado',
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
            'pk_id_estado.required' => 'Debe seleccionar un estado para el animal.',
            'pk_id_estado.exists' => 'El estado que selecciona no existe en nuestros registros.',
        ];
    }
}
