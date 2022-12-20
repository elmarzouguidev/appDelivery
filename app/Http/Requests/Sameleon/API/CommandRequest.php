<?php

namespace App\Http\Requests\Sameleon\API;

use Illuminate\Foundation\Http\FormRequest;

class CommandRequest extends FormRequest
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

            'public_key' => ['required', 'string'],
            'secret_key' => ['required', 'string'],

            'destinataire' => 'required|string',
            'telephone' => 'required|phone:MA',
            'ville' => 'required|string',
            'region' => ['nullable', 'sometimes', 'string'],
            'adresse' => 'required|string',

            'items' => 'required|array',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|integer',
            'items.*.prix_total' => 'required|numeric',
            'items.*.prix_uni' => 'nullable|numeric',
        ];
    }
}
