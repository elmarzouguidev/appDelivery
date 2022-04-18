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

            'name' => ['required', 'string', Rule::unique('cities')->ignore($this->route('city'), 'uuid')],
            'frais' => ['required', 'numeric'],
            'code' => ['required', 'string',  Rule::unique('cities')->ignore($this->route('city'), 'uuid')],
        ];
    }
}
