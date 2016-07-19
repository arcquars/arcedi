<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreEnvironmentPostRequest extends Request
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
        $rule = "";

        if($this->get("env_id") !== ""){
            $rule = 'required|unique:environments,code,'.$this->get("env_id").",env_id";
        }else{
            $rule = 'required|unique:environments,code';
        }
        return [
            'type' => 'required',
            'type_use' => 'required',
            'code' => $rule
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Tipo de ambiente requerido',
            'type_use.required' => 'Tipo de uso requerido',
            'code.required' => 'Codigo requerido',
            'code.unique' => 'El codigo ya existe',

        ];
    }
}
