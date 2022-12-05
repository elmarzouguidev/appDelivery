<?php

namespace App\Http\Requests\Sameleon\Command;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommandUpdateFormRequest extends FormRequest
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

    public function getNewArticles()
    {
        $articles = $this->newOrderProducts ?? [];

        return collect($articles)
            ->where('prix_unitaire', '>', 0)
            ->where('product_id', '>=', 1)
            ->collect();
    }

    public function getOldArticles()
    {
        $articles = $this->orderProducts ?? [];

        return collect($articles)
            ->where('prix_unitaire', '>', 0)
            ->where('product_id', '>=', 1)
            ->collect();
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

            //'client_city' => ['required', Rule::in(['casablanca'])],

            'client_address' => ['required', 'string'],
            'city' => ['required', 'integer', 'exists:cities,id'],
            'region' => ['required', 'integer', 'exists:regions,id'],

            'orderProducts' => ['nullable', 'array'],
            'orderProducts.*.product_id' => ['nullable', 'integer'],
            'orderProducts.*.designation' => ['nullable', 'string'],
            'orderProducts.*.quantity' => ['nullable', 'integer'],
            'orderProducts.*.prix_unitaire' => ['nullable', 'numeric','digits_between:1,20'],

            'newOrderProducts' => ['nullable', 'array'],
            'newOrderProducts.*.product_id' => ['nullable', 'integer'],
            'newOrderProducts.*.designation' => ['nullable', 'string'],
            'newOrderProducts.*.quantity' => ['nullable', 'numeric','digits_between:1,20'],
            'newOrderProducts.*.prix_unitaire' => ['nullable', 'numeric','digits_between:1,20'],
        ];
    }
}
