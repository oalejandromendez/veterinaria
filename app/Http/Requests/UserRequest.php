<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $password = 'required|min:3';
        $id = $this->route()->parameter('usuario');
        $roles = 'required';

        if ($this->method() == 'PUT') {
            $password = '';
        }
        return [
            'email' => 'required|email|' . Rule::unique('users')->ignore($id),
            'password' => $password,
            'name' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'cedula' => 'required|numeric|max:9999999999|' . Rule::unique('users')->ignore($id),
            'roles' => $roles
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
            'cedula.unique' => 'Esta cedula ya ha sido registrada.',
            'email.unique' => 'Esta correo ya ha sido registrado.',
            'name.required' => 'El campo nombre es requerido.',
            'name.string' => 'El nombre debe ser un nombre valido.',
            'name.max' => 'El nombre debe ser de máximo 50 caracteres.',
            'lastname.required' => 'El campo apellido es requerido.',
            'lastname.string' => 'El apellido debe ser un apellido valido.',
            'lastname.max' => 'El apellido debe ser de máximo 50 caracteres.'

        ];
    }
}
