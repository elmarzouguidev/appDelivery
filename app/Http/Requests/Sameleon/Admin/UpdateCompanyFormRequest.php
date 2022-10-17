<?php

namespace App\Http\Requests\Sameleon\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyFormRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'website' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'addresse' => ['required', 'string'],
            'city' => ['required', 'string'],
            'telephone' => ['required', 'phone:MA', Rule::unique('companies')->ignore(auth()->id(), 'user_id')],
            'email' => ['required', 'email', Rule::unique('companies')->ignore(auth()->id(), 'user_id')],
            'rc' => ['nullable', 'numeric', Rule::unique('companies')->ignore(auth()->id(), 'user_id')],
            'ice' => ['required', 'numeric','digits_between:15,16', Rule::unique('companies')->ignore(auth()->id(), 'user_id')],
            'cnss' => ['nullable', 'numeric', Rule::unique('companies')->ignore(auth()->id(), 'user_id')],
            'patente' => ['nullable', 'numeric', Rule::unique('companies')->ignore(auth()->id(), 'user_id')],
            'if' => ['nullable', 'numeric', Rule::unique('companies')->ignore(auth()->id(), 'user_id')],
        ];
    }
}
