<?php

namespace App\Http\Requests\Sameleon\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfilFormRequest extends FormRequest
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

            'userId' => ['required', 'uuid'],
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => ['required', 'email', 'string', Rule::unique('users')->ignore(auth()->id())],
            'telephone' => ['required', 'phone:MA', Rule::unique('users')->ignore(auth()->id())],
            'addresse' => ['required', 'string'],

            'cnie' => ['nullable', 'string', Rule::unique('users')->ignore(auth()->id())],
        ];
    }
}
