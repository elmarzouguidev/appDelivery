<?php

namespace App\Http\Requests\Sameleon\Delivery;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeliveryCreateFormRequest extends FormRequest
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
            'telephone' => ['required', 'phone:MA', Rule::unique('deliveries')],
            'addresse' => ['required', 'string'],
            'type' => ['required', 'string', Rule::in(['entreprise', 'particulier'])],
            'city' => ['required', 'integer'],
            'cnie' => ['nullable', 'required_if:type,particulier', 'string', Rule::unique('deliveries')],
            'email' => ['required', 'email', Rule::unique('deliveries')],
            //'password' => ['required', 'string', 'min:6'],

            'generate_password' => ['nullable', Rule::in([1, '1', true, 'on', 'yes', 'oui', '0', 'no', 'non', false])],
            'regions' => ['nullable', 'array'],
            'regions.*' => ['nullable', 'integer'],
        ];
    }
}
