<?php

namespace App\Http\Requests\Sameleon\Stock;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StockNewDeliveryFormRequest extends FormRequest
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

            'city' => ['required', 'integer', 'exists:cities,id'],
            //'delivery' => ['required', 'integer'],
            'delivery' => ['required', 'uuid', 'exists:deliveries,uuid'],
            'product' => ['required', 'uuid', 'exists:products,uuid'],
            'qte' => ['required', 'integer'],
            'sent_at' => ['required', 'date', 'date_format:d-m-Y'],
            'notes' => ['nullable', 'string']
        ];
    }
}
