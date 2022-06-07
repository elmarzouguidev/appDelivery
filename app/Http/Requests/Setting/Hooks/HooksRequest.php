<?php

namespace App\Http\Requests\Settings\Hooks;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidateDomainRule;
use Illuminate\Validation\Rule;

class HooksRequest extends FormRequest
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

            'platform' => ['required', 'string', Rule::in(config('platforms'))],
            // 'name' => 'required|string',
            'header' => 'required|string',
            'secret' => 'required|string',
            'domain' => ['required', new ValidateDomainRule()],
            'validated' => ['nullable', Rule::in(['on'])],
            'active' => ['nullable', Rule::in(['on'])],
        ];
    }
}
