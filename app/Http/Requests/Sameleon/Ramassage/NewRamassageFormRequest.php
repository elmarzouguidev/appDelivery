<?php

namespace App\Http\Requests\Sameleon\Ramassage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewRamassageFormRequest extends FormRequest
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

            'newproduct' => ['nullable', Rule::in([1, '1', true, 'on', 'yes', 'oui', '0', 'no', 'non', false])],
            'product' => ['required_if:newproduct,false', 'exists:products,id'],
            'name' => ['required_if:newproduct,true', 'string', 'max:255'],
            'price' => ['required_if:newproduct,true', 'numeric'],
            'qte' => ['required', 'integer'],
            'addresse' => 'required|string',
            'notes' => 'nullable|string',
        ];
    }
}
