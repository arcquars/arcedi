<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdatePersonPost extends Request
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
            'names' => 'required|max:250',
            'last_name_f' => 'required|max:250',
            'last_name_m' => 'max:250',
            'career' => 'max:250',
            'phone' => 'digits_between:7,10',
            'phone_cel' => 'digits_between:7,10',
            'address' => 'max:250',
            'email' => 'email'
        ];
    }

    public function messages()
    {
        return [
            'names.required' => 'Nombres no puede estar vacio',
            'names.max' => 'Nombres no puede tener mas de 250 caracteres',
            'last_name_f.required' => 'Apellido Paterno no puede estar vacio',
            'last_name_f.max' => 'Apellido Paterno no puede tener mas de 250 caracteres',
            'last_name_m.max' => 'Apellido Materno no puede tener mas de 250 caracteres',
            'career' => 'Profesion no puede tener mas de 250 caracteres',
            'phone.digits_between' => 'Telefono no puede tener mas de 15 caracteres',
            'phone_cel.digits_between' => 'Telefono celular no puede tener mas de 25 caracteres',
            'address.max' => 'Direccion no puede tener mas de 250 caracteres',
            'email.email' => 'Correo electronico no tiene el formato correcto'
        ];
    }
}
