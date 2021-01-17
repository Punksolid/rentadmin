<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LesseeRequest extends FormRequest
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
            'apellido_paterno_fiador' => 'required',
            'apellido_materno_fiador' => 'required',
            'calle_fiador' => 'required',
            'colonia_fiador' => 'required',
            'numero_ext_fiador' => 'required',
            'estado_fiador' => 'required',
            'ciudad_fiador' => 'required',
            'codigo_postal_fiador' => 'required',
            'colonia_fiador_trabajo' => 'required',
            'estado_fiador_trabajo' => 'required',
            'ciudad_fiador_trabajo' => 'required',
            'codigo_postal_fiador_trabajo' => 'required'
        ];
    }
}
