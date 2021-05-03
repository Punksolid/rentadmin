<?php

namespace App\Http\Requests;

use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'lessor_id' => 'required',
            'recibo' => [
                'required',
                Rule::in([
                    Property::RECIBO_STRING_NO_FISCAL_VALUE,
                    Property::RECIBO_STRING_FISCAL_VALUE
                ])
            ],
        ];
    }
}
