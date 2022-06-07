<?php

namespace App\Http\Requests\Sameleon\Integration;

use Illuminate\Foundation\Http\FormRequest;

class IntegrationFormRequest extends FormRequest
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
            'name' => ['required', 'unique:integrations'],
            'description' => ['nullable', 'string'],
            'logo' => 'required|file|mimes:png,jpg,jpeg',
        ];
    }
}
