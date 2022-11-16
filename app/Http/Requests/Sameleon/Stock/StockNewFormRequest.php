<?php

namespace App\Http\Requests\Sameleon\Stock;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StockNewFormRequest extends FormRequest
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
            'default_stock' => ['nullable', Rule::in([1, '1', true, 'on', 'yes', 'oui', '0', 'no', 'non', false])],
            'city' => ['required', 'integer'],
            //'delivery' => ['required', 'integer'],
            'delivery' => ['nullable', 'required_if:default_stock,false', 'exists:deliveries,id'],
            'product' => ['required', 'integer'],
            'qte' => ['required', 'integer'],
            'sent_at' => ['required', 'date', 'date_format:d-m-Y'],
            'notes' => ['nullable', 'string']
        ];
    }
}
