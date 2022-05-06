<?php

namespace App\Http\Requests\Sameleon\Region;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRegionFormRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('regions')->ignore($this->route('region'), 'uuid')],
            'city' => ['nullable', 'integer'],

            'frais' => ['nullable', 'numeric'],
            'code' => ['nullable', 'string',  Rule::unique('regions')->ignore($this->route('region'), 'uuid')],
        ];
    }
}
