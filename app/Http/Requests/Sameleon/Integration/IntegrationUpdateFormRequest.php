<?php

namespace App\Http\Requests\Sameleon\Integration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IntegrationUpdateFormRequest extends FormRequest
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
            'name' => ['required', 'unique:integrations', Rule::unique('integrations')->ignore($this->route('integration'), 'uuid')],
            'description' => ['nullable', 'string'],
            'logo' => 'required|file|mimes:png,jpg,jpeg',
        ];
    }
}
