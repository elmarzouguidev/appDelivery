<?php

namespace App\Http\Requests\Sameleon\Register;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FirstRegisterRequest extends FormRequest
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
            'telephone' => ['required', 'phone:MA', Rule::unique('users')],
            //'addresse' => ['nullable', 'string'],
            'type' => ['required', 'string', Rule::in(['entreprise', 'particulier'])],
            'city' => ['nullable', 'integer'],
            //'cnie' => ['nullable','required_if:type,particulier', 'string', Rule::unique('users')],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'string', 'min:6'],
        ];
    }
}
