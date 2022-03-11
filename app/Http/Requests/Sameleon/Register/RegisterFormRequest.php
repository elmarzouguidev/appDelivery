<?php

namespace App\Http\Requests\Sameleon\Register;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterFormRequest extends FormRequest
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
            'nom' => ['required', 'string'],
            'prenom' => ['required', 'string'],
            'telephone' => ['required', 'phone:MA'],

            'addresse' => ['required', 'string'],
            'city' => ['required', 'string'],

            'cnie' => ['required', 'string', Rule::unique('users')],
            'rc' => ['nullable', 'numeric', Rule::unique('users')],
            'ice' => ['nullable', 'numeric', Rule::unique('users')],
            'cnss' => ['nullable', 'numeric', Rule::unique('users')],
            'patente' => ['nullable', 'numeric', Rule::unique('users')],
            'if' => ['nullable', 'numeric', Rule::unique('users')],
            
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
            'type' => ['required', 'string', Rule::in(['entreprise', 'particulier'])]
        ];
    }
}
