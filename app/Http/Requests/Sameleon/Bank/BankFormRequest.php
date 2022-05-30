<?php

namespace App\Http\Requests\Sameleon\Bank;

use Illuminate\Foundation\Http\FormRequest;

class BankFormRequest extends FormRequest
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

            'name' => ['required', 'string', 'unique:banks'],
            'code_bank' => ['nullable', 'numeric'],
            'code_swift' => ['nullable', 'string'],
            'code_rib' => ['nullable', 'numeric'],
            'logo' => ['nullable', 'file', 'mimes:png,jpg,jpeg'],
            'addresse' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],

            'email' => ['nullable', 'email'],
            'telephone' => ['nullable', 'phone:MA', 'unique:banks'],
            'siteweb' => ['nullable', 'string', 'unique:banks'],

        ];
    }
}
