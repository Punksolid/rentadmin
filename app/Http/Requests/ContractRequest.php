<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContractRequest extends FormRequest
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
            'id_arrendador' => 'required',
            'id_arrendatario' => 'required',
            'id_finca' => 'required',
            'duracion_contrato' => 'required', // @todo Change to Years
            'periods' => [
                'array',
                'size:'.$this->duracion_contrato,
            ],
            'periods.*.fecha_inicio' => Rule::requiredIf(function (){
                return $this->duracion_contrato > 0;
            }),
            'periods.*.fecha_fin' => Rule::requiredIf(function (){
                return $this->duracion_contrato > 0;
            }),
            'periods.*.cantidad' => Rule::requiredIf(function (){
                return $this->duracion_contrato > 0;
            }),
        ];
    }
}
