<?php

namespace App\Http\Requests\Sameleon\City;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityUpdateFormRequest extends FormRequest
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
            
            'has_profit' => ['nullable', Rule::in([1, '1', true, 'on', 'yes', 'oui', '0', 'no', 'non', false])],
            'name' => ['required', 'string', Rule::unique('cities')->ignore($this->route('city'), 'uuid')],
            'frais' => ['required', 'numeric'],
            'profit' => ['nullable', 'required_if:has_profit,true', 'numeric'],
        ];
    }
}
