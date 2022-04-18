<?php

namespace App\Http\Requests\Sameleon\Command;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommandFormRequest extends FormRequest
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
            'client_name' => ['required', 'string'],
            'client_email' => ['nullable', 'email'],
            'client_phone' => ['required', 'phone:MA'],
            'client_address' => ['required', 'string'],
            
            'city' => ['required', 'integer'],

            'orderProducts' => ['required', 'array'],
            'orderProducts.*.product_id' => ['required', 'integer'],
            'orderProducts.*.designation' => ['required', 'string'],
            'orderProducts.*.description' => ['nullable', 'string'],
            'orderProducts.*.quantity' => ['required', 'numeric','digits_between:1,20'],
            'orderProducts.*.prix_unitaire' => ['required', 'numeric','digits_between:1,20'],
        ];
    }
}
