<?php

namespace App\Http\Requests\Hooks\WooCommerce;

use Illuminate\Foundation\Http\FormRequest;

class HookRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'billing' => ['required', 'array'],
            'billing.first_name' => 'required|string',
            'billing.last_name' => 'required|string',
            'billing.email' => 'nullable|email',
            'billing.phone' => 'required|string',
            'billing.company' => 'nullable|string',
            'billing.address_1' => 'required|string',
            'billing.address_2' => 'nullable|string',
            'billing.city' => 'required|string',
            'billing.state' => 'nullable|string',
            'billing.postcode' => 'nullable|numeric',
            'billing.country' => 'nullable|string',

            'line_items' => ['required', 'array'],
            'line_items.*.name' => 'required|string',
            'line_items.*.quantity' => 'required|integer',
            'line_items.*.total' => ['required', 'numeric'],
        ];
    }
}
