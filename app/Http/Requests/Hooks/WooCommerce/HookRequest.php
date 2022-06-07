<?php

namespace App\Http\Requests\Hooks\WooCommerce;

use Illuminate\Foundation\Http\FormRequest;

class HookRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'company' => 'nullable|string',
            'address_1' => 'required|string',
            'address_2' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'nullable|string',
            'postcode' => 'nullable|numeric',
            'country' => 'nullable|string',
        ];
    }
}
