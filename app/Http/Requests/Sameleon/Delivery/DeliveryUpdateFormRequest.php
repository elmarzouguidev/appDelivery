<?php

namespace App\Http\Requests\Sameleon\Delivery;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeliveryUpdateFormRequest extends FormRequest
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
            'telephone' => ['required', 'phone:MA', Rule::unique('deliveries')->ignore($this->route('delivery'), 'uuid')],
            'addresse' => ['required', 'string'],
            'type' => ['nullable', 'string', Rule::in(['entreprise', 'particulier'])],
            'city' => ['nullable', 'integer'],
            'cnie' => ['nullable', 'required_if:type,particulier', 'string', Rule::unique('deliveries')->ignore($this->route('delivery'), 'uuid')],
            'email' => ['required', 'email', Rule::unique('deliveries')->ignore($this->route('delivery'), 'uuid')],
            //'password' => ['required', 'string', 'min:6'],
            'company_ice' => ['nullable', 'required_if:type,entreprise', 'string', Rule::unique('deliveries')->ignore($this->route('delivery'), 'uuid')],
            'company_name' => ['nullable', 'required_if:type,entreprise', 'string', Rule::unique('deliveries')->ignore($this->route('delivery'), 'uuid')],
            'regions' => ['nullable', 'array'],
            'regions.*' => ['nullable', 'integer'],
        ];
    }
}
