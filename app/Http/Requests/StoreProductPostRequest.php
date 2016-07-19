<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreProductPostRequest extends Request
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
            'code' => 'unique:products,code|max:250',
            'name' => 'required|unique:products,name',
        ];
    }

    public function messages()
    {
        return [
            'code.max' => 'Codigo max 250 caracteres',
            'code.unique' => 'El codigo ya existe',
            'name.required' => 'Nombre requerido',
            'name.unique' => 'El nombre ya existe',

        ];
    }
}
