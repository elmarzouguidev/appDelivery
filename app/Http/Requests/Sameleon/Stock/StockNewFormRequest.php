<?php

namespace App\Http\Requests\Sameleon\Stock;

use Illuminate\Foundation\Http\FormRequest;

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
            'city' => ['required', 'integer'],
            'delivery' => ['required', 'integer'],
            'product' => ['required', 'integer'],
            'qte' => ['required', 'integer'],
            'sent_at' => ['required', 'date', 'date_format:d-m-Y'],
            'notes' => ['nullable', 'string']
        ];
    }
}
