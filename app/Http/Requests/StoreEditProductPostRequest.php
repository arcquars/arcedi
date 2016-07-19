<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreEditProductPostRequest extends Request
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
            'code' => 'max:250|unique:products,code,'.$this->get("product_id").",product_id",
            'name' => 'required|unique:products,name,'.$this->get("product_id").",product_id",
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
